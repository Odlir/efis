<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->Library('Layouts');
		$this->load->model('PersonaModel');
		$this->load->library('pagination');

	}
	
	public function index()
	{
		$persona = new PersonaModel;
		$data['data'] = $persona->get_personas();
		
		$this->layouts->set_title('Welcome!');
		$this->layouts->add_include('files/custom/persona.js');
		$this->layouts->view('welcome_message', $data);
	}
}
