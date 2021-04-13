<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {

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
		$this->layouts->set_title('Reportes');
		$this->layouts->set_module_name('Reporte de micro hábitos');
		$this->layouts->add_include('files/custom/reporte.js');
		$data["data"] = [];
		$this->layouts->view('reporte/reporte_inicio', $data);
	}

}
