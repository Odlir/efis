<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriaModel extends CI_Model{
    
    public function __construct()
    {
        $this->load->database();
    }

    public function get_grupos(){

        $estados = array('1', '2');
        $this->db->select('g.categoria_id,
        g.categoria_nombre,       
        g.categoria_estado_id,
        g.categoria_fecha_creacion,
        g.categoria_fecha_modificacion');
        $this->db->from('categoria g');
        $this->db->where_in('g.categoria_estado_id', $estados);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    public function get_grupo($id){
        $this->db->select('*');
        $this->db->from('categoria');
        $this->db->where('categoria_id', $id);
        $query = $this->db->get();
        $data = $query->result();
        
        return $data;
    }

    public function grupo_actualizar($id, $data){
        
        $this->db->set('categoria_fecha_modificacion', 'NOW()', FALSE);
        $this->db->where('categoria_id', $id);
        $this->db->update('categoria', $data);
        return true;
    }

    public function grupo_insertar($data){
        $this->db->set('categoria_fecha_creacion', 'NOW()', FALSE);
        $this->db->insert('categoria', $data);
        return true;
    }

    public function grupo_eliminar($id){
        
        $this->db->set('categoria_estado_id', 0);
        $this->db->set('categoria_fecha_modificacion', 'NOW()', FALSE);
        $this->db->where('categoria_id', $id);
        $this->db->update('categoria');
        return true;
    }
}
?>
