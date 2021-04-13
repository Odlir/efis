<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encuesta extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->Library('Layouts');
		$this->load->model('EncuestaModel');
		$this->load->model('MaestroModel');
		$this->load->library('pagination');
		/*if(!is_logged_in())
		{
			redirect('login');
		}*/
	}
	
	public function index()
	{
		$encuesta = new EncuestaModel;
		$maestro = new MaestroModel;
		$data['data'] = $encuesta->get_encuestas();

		$data['comboRespuesta'] = $maestro->get_Tipo_Respuesta();
		$data['comboProgramacion'] = $maestro->get_Tipo_Programacion();
		$data['comboGrupo'] = $maestro->get_Grupos_Activos(true);
		
		$this->layouts->set_title('Micro hábitos');
		$this->layouts->set_module_name('Mantenimiento de micro hábitos');
		$this->layouts->add_include('files/custom/encuesta.js');
		$this->layouts->view('encuesta/encuesta_inicio', $data);
	}

	public function encuesta_get($idEncuesta = null){
		$encuesta = new EncuestaModel;
		$data['encuesta'] = $encuesta->get_encuesta($idEncuesta)[0];
		$lista_preguntas = $encuesta->get_encuesta_pregunta($idEncuesta);
		
		$indexPregunta = 0;
		foreach ($lista_preguntas as $pregunta) {
			$lista_preguntas[$indexPregunta]->respuestas = $encuesta->get_encuesta_pregunta_respuesta($pregunta->encuesta_pregunta_id);
			$indexPregunta++;
		}

		$data['preguntas'] = $lista_preguntas;
		$data['grupos'] = $encuesta->get_encuesta_grupo($idEncuesta);

		//add the header here
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function encuesta_create(){

		$encuesta = new EncuestaModel;

		//$data["persona_tipo_documento_id"] = $tipoDocumento;
		//Parametros Json
		$input_data = json_decode(trim(file_get_contents('php://input')), true);

		$es_insert = false;
		
		$tipo_alerta = $input_data["encuesta"]["tipoProgramacion"];
		//Encuesta
		$dataEncuesta = array(
			'encuesta_nombre' => $input_data["encuesta"]["nombreEncuesta"],
			'encuesta_tiempo_alerta_horas' => $input_data["encuesta"]["alertaHoras"],
			'encuesta_estado_id' => $input_data["encuesta"]["estadoEncuesta"],
			'encuesta_fecha_inicio_alerta' => $input_data["encuesta"]["fechaInicio"],
			'encuesta_fecha_fin_alerta' => $input_data["encuesta"]["fechaFin"],
			'encuesta_tipo_alerta_id' => $tipo_alerta,
			'encuesta_json_dias_alerta' => json_encode($input_data["encuesta"]["jsonDiasProgramacion"])
		);

		$iEncuestaID = $input_data["encuesta"]["idEncuesta"];

		if($iEncuestaID == "0"){
			$iEncuestaID = $encuesta->encuesta_insertar($dataEncuesta); //retorno del itentity
			$es_insert = true;
		}else{
			
			$encuesta->encuesta_actualizar($iEncuestaID, $dataEncuesta);
		}
		

		$indexPregunta = 0;
		foreach($input_data["pregunta"] as $key=>$value){

			$iEncuestaPreguntaID = $input_data["pregunta"][$indexPregunta]["idEncuestaPregunta"];
			$es_pregunta_eliminada = $input_data["pregunta"][$indexPregunta]["flagEliminado"] == "1";
			
			if($es_pregunta_eliminada){
				$encuesta->encuesta_pregunta_eliminar($iEncuestaPreguntaID);
			}else{

				$dataPregunta = array(
					'encuesta_id' => $iEncuestaID,
					'encuesta_pregunta_nombre' => $input_data["pregunta"][$indexPregunta]["nombrePregunta"],
					'encuesta_pregunta_tipo_id' => $input_data["pregunta"][$indexPregunta]["tipoPreguntaId"],
					'encuesta_pregunta_estado_id' => $input_data["pregunta"][$indexPregunta]["estadoPreguntaId"],
					'encuesta_pregunta_fecha_creacion' => $input_data["pregunta"][$indexPregunta]["fechaCreaStr"],
					'encuesta_pregunta_fecha_modificacion' => $input_data["pregunta"][$indexPregunta]["fechaModStr"]
				);

				if($iEncuestaPreguntaID == "0"){
					$iEncuestaPreguntaID = $encuesta->encuesta_pregunta_insertar($dataPregunta); //retorno del itentity
				}else{
					$encuesta->encuesta_pregunta_actualizar($iEncuestaPreguntaID, $dataPregunta);
				}
				
				$indexRespuesta = 0;
				foreach($input_data["pregunta"][$indexPregunta]["aRespuestas"] as $key=>$value){


					$iPreguntaRespuestaID = $input_data["pregunta"][$indexPregunta]["aRespuestas"][$indexRespuesta]["idPreguntaRespuesta"];
					$es_respuesta_eliminada = $input_data["pregunta"][$indexPregunta]["aRespuestas"][$indexRespuesta]["flagEliminado"] == "1";
	
					if($es_respuesta_eliminada){
						$encuesta->encuesta_pregunta_respuesta_eliminar($iPreguntaRespuestaID);
					}else{
						
						$dataRespuesta = array(
							'encuesta_pregunta_id' => $iEncuestaPreguntaID,
							'encuesta_pregunta_respuesta_nombre' => $input_data["pregunta"][$indexPregunta]["aRespuestas"][$indexRespuesta]["nombreRespuesta"],
							'encuesta_pregunta_respuesta_estado_id' => $input_data["pregunta"][$indexPregunta]["aRespuestas"][$indexRespuesta]["estadoRespuestaId"],
							'encuesta_pregunta_respuesta_fecha_creacion' => $input_data["pregunta"][$indexPregunta]["aRespuestas"][$indexRespuesta]["fechaCreaStr"],
							'encuesta_pregunta_respuesta_fecha_modificacion' => $input_data["pregunta"][$indexPregunta]["aRespuestas"][$indexRespuesta]["fechaModStr"]
						);
	
						if($iPreguntaRespuestaID == "0"){
							$encuesta->encuesta_pregunta_respuesta_insertar($dataRespuesta);
						}else{
							
							$encuesta->encuesta_pregunta_respuesta_actualizar($iPreguntaRespuestaID, $dataRespuesta);
						}
					}
					$indexRespuesta++;
				}
			}
			
			$indexPregunta++;
		}


		$indexGrupo = 0;
		foreach($input_data["grupo"] as $key=>$value){

			$iEncuestaGrupoID = $input_data["grupo"][$indexGrupo]["idEncuestaGrupo"];
			$es_grupo_eliminada = $input_data["grupo"][$indexGrupo]["flagEliminado"] == "1";
			
			if($es_grupo_eliminada){
				$encuesta->encuesta_grupo_eliminar($iEncuestaGrupoID);
			}else{

				$dataGrupo = array(
					'encuesta_id' => $iEncuestaID,
					'grupo_id' => $input_data["grupo"][$indexGrupo]["GrupoID"],
					'encuesta_grupo_estado_id' => 2
				);

				if($iEncuestaGrupoID == "0"){
					$encuesta->encuesta_grupo_insertar($dataGrupo);
				}
				
			}

			$indexGrupo++;
		}

		$arr = array('error' => false, 'encuesta_id' => $iEncuestaID);

		if($es_insert){
			$this->job_microhabito_create($iEncuestaID, $tipo_alerta);
		}
		header('Content-Type: application/json');
		echo json_encode($arr);
		
	}

	public function encuesta_eliminar($idEncuesta){
		$encuesta = new EncuestaModel;
		$respuesta = $encuesta->encuesta_eliminar($idEncuesta);

		//add the header here
		header('Content-Type: application/json');
		echo json_encode($respuesta);
	}

	public function job_microhabito_create($id, $tipo_alerta)
	{
		$this->load->library('uuid');
		
		$encuesta = new EncuestaModel;
		$data = $encuesta->get_encuesta_persona_byId($id);
		
		foreach ($data as $datos) {
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
			
			if($tipo_alerta == 1){//Email
				//Enviar correo
				$this->job_envia_correo($id_codigo, $correo, $nombre_completo, $encuestaNombre);
			}else if ($tipo_alerta == 2){ // SMS
				//Enviar sms
				$this->job_envia_sms($celular, $nombre_completo);
			}
		}
		
		
		
		return true;
	}

	public function job_envia_correo($codig, $email, $nombre, $encuestaNombre){
		
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
			$mensaje = "Estimado ".$nombre.", tienes una encuesta pendiente.";

			$celular = "+51".$celular;
			
			$client->messages->create(
				$celular,
				array(
					'from' => $from,
					'body' => $mensaje
				)
			);
			
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
}
