<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupo extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->Library('Layouts');
		$this->load->model('GrupoModel');

		if(!is_logged_in())
		{
			redirect('login');
		}
	}
	
	public function index()
	{
		$grupo = new GrupoModel;
		$data['data'] = $grupo->get_grupos();
		
		$this->layouts->set_title('Grupos');
		$this->layouts->set_module_name('Mantenimiento de grupos');
		$this->layouts->add_include('files/custom/grupo.js');
		$this->layouts->view('grupo/grupo_inicio', $data);
	}

	public function grupo_create()
	{
		$grupo = new GrupoModel;
		
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('nombreGrupo','Nombre', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data = validation_errors();
			$data_r = str_replace(".", ". </br>", $data);
			echo $data_r;
		} 
		else {
			$idGrupo = $this->input->post('idGrupo');
			$nombreGrupo = $this->input->post('nombreGrupo');
			$state = $this->input->post('state');

			if($state == "on"){
				$state = "2";
			}else{
				$state = "1";
			}

			$data = array(
				'grupo_nombre' => $nombreGrupo,
				'grupo_estado_id' => $state
			);

			//Actualizar
			if($idGrupo != 0){
				$respuesta = $grupo->grupo_actualizar($idGrupo, $data);
			}else{//Insertar
				$respuesta = $grupo->grupo_insertar($data);
			}

			echo $respuesta;
		}
		
	}

	public function grupo_get($idGrupo = null){
		$grupo = new GrupoModel;
		$data['data'] = $grupo->get_grupo($idGrupo);

		//add the header here
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function grupo_eliminar($idGrupo){
		$grupo = new GrupoModel;
		$respuesta = $grupo->grupo_eliminar($idGrupo);

		//add the header here
		header('Content-Type: application/json');
		echo json_encode($respuesta);
	}
}
