<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MaestroModel extends CI_Model{
    
    public function __construct()
    {
        $this->load->database();
    }

    public function get_Estados(){
        $estados = array('1', '2');
        $this->db->select('codigo_maestro_valor as valor, codigo_maestro_descripcion as texto');
        $this->db->from('codigo_maestro');
        $this->db->where('codigo_maestro_tipo_id', 1);
        $this->db->where_in('codigo_maestro_valor', $estados);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    public function get_Grupos_Activos($flagEditar = false){
        $this->db->select('grupo_id as valor, grupo_nombre as texto');
        $this->db->from('grupo');

        if ($flagEditar){
            $this->db->where('grupo_estado_id', 2);
        }

        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    public function get_Estado_Civil(){
        $this->db->select('codigo_maestro_valor as valor, codigo_maestro_descripcion as texto');
        $this->db->from('codigo_maestro');
        $this->db->where('codigo_maestro_tipo_id', 3);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    public function get_Genero(){
        $this->db->select('codigo_maestro_valor as valor, codigo_maestro_descripcion as texto');
        $this->db->from('codigo_maestro');
        $this->db->where('codigo_maestro_tipo_id', 4);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    public function get_Tipo_Documento(){
        $this->db->select('codigo_maestro_valor as valor, codigo_maestro_descripcion as texto');
        $this->db->from('codigo_maestro');
        $this->db->where('codigo_maestro_tipo_id', 2);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    public function get_Tipo_Respuesta(){
        $this->db->select('codigo_maestro_valor as valor, codigo_maestro_descripcion as texto');
        $this->db->from('codigo_maestro');
        $this->db->where('codigo_maestro_tipo_id', 7);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    public function get_Tipo_Programacion(){
        $this->db->select('codigo_maestro_valor as valor, codigo_maestro_descripcion as texto');
        $this->db->from('codigo_maestro');
        $this->db->where('codigo_maestro_tipo_id', 8);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

}
?>