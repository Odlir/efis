<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PersonaModel extends CI_Model{
    
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_personas(){
        $estados = array('1', '2');
        $this->db->select('p2.persona_id,
        CONCAT(p2.persona_apellido_paterno, " ", p2.persona_apellido_materno, ", ", p2.persona_nombre) as persona_nombre_completo,
        p2.persona_email,
        g.grupo_nombre,
        cm.codigo_maestro_descripcion as persona_estado_str,
        p2.persona_estado_id,
        p2.persona_fecha_creacion,
        p2.persona_fecha_modificacion');
        $this->db->from('persona p2');
        $this->db->join('codigo_maestro cm', 'p2.persona_estado_id = cm.codigo_maestro_valor', 'inner');
        $this->db->join('grupo g', 'p2.grupo_id = g.grupo_id', 'inner');
        $this->db->where('cm.codigo_maestro_tipo_id', 1);
        $this->db->where_in('p2.persona_estado_id', $estados);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    public function get_persona($id){
        $this->db->select('*');
        $this->db->from('persona');
        $this->db->where('persona_id', $id);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    public function persona_actualizar($id, $data){
        
        $this->db->set('persona_fecha_modificacion', 'NOW()', FALSE);
        $this->db->where('persona_id', $id);
        $this->db->update('persona', $data);
        return true;
    }

    public function persona_insertar($data){
        
        $this->db->set('persona_fecha_creacion', 'NOW()', FALSE);
        $this->db->set('persona_tiene_encuesta', 0);
        $this->db->insert('persona', $data);
        return true;
    }

    public function persona_eliminar($id){
        
        $this->db->set('persona_estado_id', 0);
        $this->db->set('persona_fecha_modificacion', 'NOW()', FALSE);
        $this->db->where('persona_id', $id);
        $this->db->update('persona');
        return true;
    }

}
?>