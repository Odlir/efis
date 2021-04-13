<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GrupoModel extends CI_Model{
    
    public function __construct()
    {
        $this->load->database();
    }

    public function get_grupos(){

        $estados = array('1', '2');
        $this->db->select('g.grupo_id,
        g.grupo_nombre,
        cm.codigo_maestro_descripcion as grupo_estado_str,
        g.grupo_estado_id,
        g.grupo_fecha_creacion,
        g.grupo_fecha_modificacion');
        $this->db->from('grupo g');
        $this->db->join('codigo_maestro cm', 'g.grupo_estado_id = cm.codigo_maestro_valor', 'inner');
        $this->db->where('cm.codigo_maestro_tipo_id', 1);
        $this->db->where_in('g.grupo_estado_id', $estados);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    public function get_grupo($id){
        $this->db->select('*');
        $this->db->from('grupo');
        $this->db->where('grupo_id', $id);
        $query = $this->db->get();
        $data = $query->result();
        
        return $data;
    }

    public function grupo_actualizar($id, $data){
        
        $this->db->set('grupo_fecha_modificacion', 'NOW()', FALSE);
        $this->db->where('grupo_id', $id);
        $this->db->update('grupo', $data);
        return true;
    }

    public function grupo_insertar($data){
        
        $this->db->set('grupo_fecha_creacion', 'NOW()', FALSE);
        $this->db->insert('grupo', $data);
        return true;
    }

    public function grupo_eliminar($id){
        
        $this->db->set('grupo_estado_id', 0);
        $this->db->set('grupo_fecha_modificacion', 'NOW()', FALSE);
        $this->db->where('grupo_id', $id);
        $this->db->update('grupo');
        return true;
    }
}
?>