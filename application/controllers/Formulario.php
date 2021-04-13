<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formulario extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('EncuestaModel');
	}
	
	public function index($codigo_encuesta = null)
	{
		$eData = $this->get_microhabito_json($codigo_encuesta);
		if($eData != null){
			$this->load->view('formulario', $eData);
		}else{
			$this->load->view('formulario_error');
		}
	}

	public function get_microhabito($codigo_encuesta = null)
	{
		$eData = $this->get_microhabito_json($codigo_encuesta);
		if($eData != null){
			$this->load->view('formulario', $eData);
		}else{
			$this->load->view('formulario_error');
		}
	}

	public function guardar_microhabito(){
		$encuesta = new EncuestaModel;
		$input_data = json_decode(trim(file_get_contents('php://input')), true);
		$encuesta_persona_id = $input_data["encuesta"]["encuesta_persona"];
		
		foreach($input_data["pregunta"] as $data){

			$json_id_respuesta_persona = $data["id_respuesta_persona"];
			$json_id_respuesta = $data["id_respuesta"];
			$json_estado = ($data["estado"]) ? 2 : 0;
			//Insertar nuevos con valor true
			if($json_id_respuesta_persona == 0 && $json_estado == 2){
				$dataInsert = array(
					'encuesta_persona_id' => $encuesta_persona_id,
					'encuesta_pregunta_respuesta_id' => $json_id_respuesta,
					'encuesta_pregunta_respuesta_persona_estado_id' => $json_estado
				);
				$encuesta->encuesta_persona_respuesta_insertar($dataInsert);
			}

			//Actualizar existentes
			if($json_id_respuesta_persona != 0 && $json_estado != 2){
				$encuesta->encuesta_persona_respuesta_actualizar($json_id_respuesta_persona);
			}
		}

		$arr = array('error' => false);

		header('Content-Type: application/json');
		echo json_encode($arr);
	}

	public function get_microhabito_json($idTest)
	{
		//$idTest = "31e64ad19aa24c90bce86e45082ca68c";

		$encuesta = new EncuestaModel;
		
		$dataEncuesta = $encuesta->get_encuesta_persona_byCodigo($idTest);

		if(sizeof($dataEncuesta) <= 0){
			return null;
		}else{
			$dataEncuesta = $dataEncuesta[0];
		}

		$idEncuesta = $dataEncuesta->encuesta_id;
		$data['persona'] = $dataEncuesta;

		$data['encuesta'] = $encuesta->get_encuesta($idEncuesta)[0];
		$lista_preguntas = $encuesta->get_encuesta_pregunta($idEncuesta, true);
		
		$indexPregunta = 0;
		foreach ($lista_preguntas as $pregunta) {
			$lista_preguntas[$indexPregunta]->respuestas = $encuesta->get_encuesta_pregunta_respuesta($pregunta->encuesta_pregunta_id, true);
			$indexPregunta++;
		}

		$data['preguntas'] = $lista_preguntas;
		
		
		//add the header here
		//header('Content-Type: application/json');
		//echo json_encode($data);
		return $data;
	}

	public function job_microhabito_create()
	{
		$this->load->library('uuid');
		$encuesta = new EncuestaModel;
		$data = $encuesta->get_encuesta_persona();

		foreach ($data as $datos) {

			$jsonDias = $datos->encuesta_json_dias_alerta;
			$valido = $this->validarDia($jsonDias);

			if($valido){


				$id_codigo = $this->uuid->v4();
				$id_codigo = str_replace('-', '', $id_codigo);

				$dataEncuesta = array(
					'encuesta_persona_codigo'=> $id_codigo,
					'encuesta_id' => $datos->encuesta_id,
					'persona_id' => $datos->persona_id
				);
	
				$nombre_completo = $datos->persona_apellido_paterno." ".$datos->persona_apellido_materno.", ".$datos->persona_nombre;
				$encuestaNombre = $datos->encuesta_nombre;
				$correo = $datos->persona_email;
				$celular = $datos->persona_celular;
				
				$encuesta->encuesta_persona_insertar($dataEncuesta);
	
				if($datos->encuesta_tipo_alerta_id == 1){
					//Enviar correo
					$this->job_envia_correo($id_codigo, $correo, $nombre_completo,$encuestaNombre);
				}else if($datos->encuesta_tipo_alerta_id == 2){
					//Enviar sms
					$this->job_envia_sms($celular, $nombre_completo);
				}
			}
		}
		//add the header here
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function validarDia($jsonDias)
	{
		$jsonDecode = json_decode($jsonDias, true);
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
		if ($jsonDecode[$dias[date("w")]] == 1){
			return true;
		}
		else{
			return false;
		}
	}
	public function job_envia_correo($codig, $email, $nombre,$encuestaNombre){
		
		try {
			$this->load->config('email');
			$this->load->library('email');
			
			$from = $this->config->item('smtp_user');
			$subject = $encuestaNombre; //$this->input->post('subject');
			
			$this->email->set_newline("\r\n");
			$this->email->from($from);
			$this->email->to($email);
			$this->email->subject($subject);

			$data["nombre"] = $nombre;
			$data["codigo"] = $codig;

			$body = $this->load->view('email/plantilla', $data, true);

			$this->email->message($body);

			if ($this->email->send()) {
				return true;
			} else {
				return false;
			}
		} catch (Exception $e) {
			return false;
		}
	}

	public function job_envia_sms($celular, $nombre){
		
		try {

			$this->load->config('sms');
			require './Twilio/autoload.php';

			// Your Account SID and Auth Token from twilio.com/console
			$sid = $this->config->item('twilio_sid');
			$token = $this->config->item('twilio_token');
			$client = new Twilio\Rest\Client($sid, $token);
			
			$from = $this->config->item('twilio_from');
			$celular = "+51".$celular;
			$mensaje = "Estimado ".$nombre.", tienes una encuesta pendiente.";

			$client->messages->create(
				$celular,
				array(
					'from' => $from,
					'body' => $mensaje
				)
			);
			//cho "sms enviado </br>";
			return true;
		} catch (Exception $e) {
			//echo "sms error </br>";
			return false;
			
		}
	}

	public function test_envia_correo(){

		$this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $subject = "Prueba"; //$this->input->post('subject');
        
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to("jrrivasdiaz@gmail.com");
        $this->email->subject("Test");

		$data["nombre"] = "Javier";
		$data["codigo"] = "prueba_codigo";

		$body = $this->load->view('email/plantilla', $data, true);

        $this->email->message($body);

        if ($this->email->send()) {
			//return true;
            echo 'Your Email has successfully been sent.';
        } else {
			//return false;
            show_error($this->email->print_debugger());
        }
	}

	public function test_envia_sms(){

		$this->load->config('sms');
		require './Twilio/autoload.php';

		// Your Account SID and Auth Token from twilio.com/console
		$sid = $this->config->item('twilio_sid');
		$token = $this->config->item('twilio_token');
		$client = new Twilio\Rest\Client($sid, $token);
		
		$from = $this->config->item('twilio_from');
		$nombre = "Javier Rivas";
		$celular = "+51917439583";
		$mensaje = "Estimado ".$nombre.", tienes una encuesta pendiente.";

		$client->messages->create(
			$celular,
			array(
				'from' => $from,
				'body' => $mensaje
			)
		);

		echo "sms";
	}

}
