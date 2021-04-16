<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->Library('Layouts');
		$this->load->model('CategoriaModel');

		if(!is_logged_in())
		{
			redirect('login');
		}
	}

	public function index()
	{
		$grupo = new CategoriaModel;
		$data['data'] = $grupo->get_grupos();

		$this->layouts->set_title('Categorias');
		$this->layouts->set_module_name('Mantenimiento de categorias');
		$this->layouts->add_include('files/custom/categoria.js');
		$this->layouts->view('categoria/categoria_inicio', $data);
	}

	public function grupo_create()
	{
		$grupo = new CategoriaModel;

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
				'categoria_nombre' => $nombreGrupo,
				'categoria_estado_id' => $state
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
		$grupo = new CategoriaModel;
		$data['data'] = $grupo->get_grupo($idGrupo);

		//add the header here
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function grupo_eliminar($idGrupo){
		$grupo = new CategoriaModel;
		$respuesta = $grupo->grupo_eliminar($idGrupo);

		//add the header here
		header('Content-Type: application/json');
		echo json_encode($respuesta);
	}
}
