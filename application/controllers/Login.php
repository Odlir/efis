<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('LoginModel');
	}
	
	public function index()
	{
        if(is_logged_in())
		{
			$data = $this->session->all_userdata();
            foreach($data as $row => $rows_value)
            {
                $this->session->unset_userdata($row);
            }
		}
		$this->load->view('login');
	}

    function validation()
    {
        $this->form_validation->set_rules('user_nombre', 'Usuario', 'required|trim');
        $this->form_validation->set_rules('user_password', 'Contraseña', 'required');
        
        if($this->form_validation->run()) {
            
            $login = new LoginModel;
            $result = $login->login($this->input->post('user_nombre'), $this->input->post('user_password'));
            
            if($result) {
                
                redirect('Grupo');
            }
            else {
                $this->session->set_flashdata('message', 'Usuario o contraseña incorrectos');
                redirect('Login');
            }
        }
        else {
            $this->index();
        }
    }

    function logout()
    {
        $data = $this->session->all_userdata();
        foreach($data as $row => $rows_value)
        {
            $this->session->unset_userdata($row);
        }
        redirect('login');
    }
}
