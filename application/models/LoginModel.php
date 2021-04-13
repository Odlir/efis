<?php
class LoginModel extends CI_model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function login($nombre, $password)
    {
        $query = $this->db->get_where('usuario', array('usuario_nombre' => $nombre));
        
        if($query->num_rows() == 1)
        {
            $row=$query->row();
            if($password == $row->usuario_contrasena)
            {
                $data=array('user_data'=>array('usuario_nombre' => $row->usuario_nombre));
                $this->session->set_userdata($data);
                return true;
            }
        }
        $this->session->unset_userdata('user_data');
        return false;
    }
}