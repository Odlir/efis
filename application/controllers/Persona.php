<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->Library('Layouts');
		$this->load->model('PersonaModel');
		$this->load->model('MaestroModel');
		$this->load->library('pagination');
		if(!is_logged_in())
		{
			redirect('login');
		}
	}
	
	public function index()
	{
		$persona = new PersonaModel;
		$maestro = new MaestroModel;
		$data['data'] = $persona->get_personas();

		$data['comboDocumento'] = $maestro->get_Tipo_Documento();
		$data['comboEstadoCivil'] = $maestro->get_Estado_Civil();
		$data['comboGenero'] = $maestro->get_Genero();
		$data['comboGrupo'] = $maestro->get_Grupos_Activos();
		
		$this->layouts->set_title('Personas');
		$this->layouts->set_module_name('Mantenimiento de personas');
		$this->layouts->add_include('files/custom/persona.js');
		$this->layouts->view('persona/persona_inicio', $data);
	}

	public function persona_create()
	{
		$persona = new PersonaModel;
		$val_tipoDocumento = $this->input->post('tipoDocumento');
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('nombres','Nombres', 'required|max_length[50]');
		$this->form_validation->set_rules('apellidoPaterno','Apellido paterno', 'required|max_length[100]');
		$this->form_validation->set_rules('apellidoMaterno','Apellido materno', 'required|max_length[100]');
		$this->form_validation->set_rules('genero','Género', 'required');
		$this->form_validation->set_rules('email','Email', 'trim|required|valid_email|max_length[50]');
		$this->form_validation->set_rules('celular','Celular', 'required|numeric|min_length[9]|max_length[9]');
		$this->form_validation->set_rules('grupo','Grupo', 'required');

		if ($val_tipoDocumento != ""){
			$this->form_validation->set_rules('nroDocumento','Número de documento', 'required|numeric');
		}else{
			$this->form_validation->set_rules('nroDocumento','Número de documento', 'numeric');
		}
		
		$this->form_validation->set_rules('lugarNacimiento','Lugar de nacimiento', 'max_length[100]');
		

		if ($this->form_validation->run() == FALSE) {
			$data = validation_errors();
			$data_r = str_replace(".", ". </br>", $data);
			echo $data_r;
		} 
		else {
			$idPersona = $this->input->post('idPersona');
			$nombres = $this->input->post('nombres');
			$apellidoPaterno = $this->input->post('apellidoPaterno');
			$apellidoMaterno = $this->input->post('apellidoMaterno');
			$tipoDocumento = $this->input->post('tipoDocumento');
			$nroDocumento = $this->input->post('nroDocumento');
			$estadoCivil = $this->input->post('estadoCivil');
			$fechaNacimiento = $this->input->post('fechaNacimiento');
			$lugarNacimiento = $this->input->post('lugarNacimiento');
			$genero = $this->input->post('genero');
			$email = $this->input->post('email');
			$telefono = $this->input->post('telefono');
			$celular = $this->input->post('celular');
			$grupo = $this->input->post('grupo');
			$state = $this->input->post('state');

			if($state == "on"){
				$state = "2";
			}else{
				$state = "1";
			}

			$data = array(
				'persona_nombre' => $nombres,
				'persona_apellido_paterno' => $apellidoPaterno,
				'persona_apellido_materno' => $apellidoMaterno,
				'persona_genero_id' => $genero,
				'persona_email' => $email,
				'persona_celular' => $celular,
				'grupo_id' => $grupo,
				'persona_estado_id' => $state
			);

			if ($tipoDocumento != ""){
				$data["persona_tipo_documento_id"] = $tipoDocumento;
			}

			if ($nroDocumento != ""){
				$data["persona_numero_documento"] = $nroDocumento;
			}

			if ($estadoCivil != ""){
				$data["persona_estado_civil_id"] = $estadoCivil;
			}

			if ($fechaNacimiento != ""){
				$data["persona_fecha_nacimiento"] = $fechaNacimiento;
			}

			if ($lugarNacimiento != ""){
				$data["persona_lugar_nacimiento"] = $lugarNacimiento;
			}

			if ($telefono != ""){
				$data["persona_telefono"] = $telefono;
			}
			
			//Actualizar
			if($idPersona != 0){
				$respuesta = $persona->persona_actualizar($idPersona, $data);
			}else{//Insertar
				$respuesta = $persona->persona_insertar($data);
			}
			
			echo $respuesta;
		}
		
	}

	public function persona_get($idPersona = null){
		$persona = new PersonaModel;
		$data['data'] = $persona->get_persona($idPersona);

		//add the header here
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function persona_eliminar($idPersona){
		$persona = new PersonaModel;
		$respuesta = $persona->persona_eliminar($idPersona);

		//add the header here
		header('Content-Type: application/json');
		echo json_encode($respuesta);
	}
}
