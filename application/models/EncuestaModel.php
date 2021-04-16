<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EncuestaModel extends CI_Model{
    
    public function __construct()
    {
        $this->load->database();
    }

    public function get_encuestas(){

        $estados = array('1', '2');
        $this->db->select('e2.encuesta_id,
        e2.encuesta_nombre,
        e2.encuesta_tiempo_alerta_horas,
        cm.codigo_maestro_descripcion as encuesta_estado_str,
        e2.encuesta_estado_id,
        e2.encuesta_fecha_creacion,
        e2.encuesta_fecha_modificacion,
        e2.encuesta_fecha_notificacion');
        $this->db->from('encuesta e2');
        $this->db->join('codigo_maestro cm', 'e2.encuesta_estado_id = cm.codigo_maestro_valor', 'inner');
        $this->db->where('cm.codigo_maestro_tipo_id', 1);
        $this->db->where_in('e2.encuesta_estado_id', $estados);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    /*Lista Modificacion*/
    public function get_encuesta($id){
        $this->db->select('*');
        $this->db->from('encuesta');
        $this->db->where('encuesta_id', $id);
        $query = $this->db->get();
        $data = $query->result();
        
        return $data;
    }

    public function get_encuesta_grupo($id){
        
        $this->db->select('eg.encuesta_grupo_id,
        eg.encuesta_id,
        eg.grupo_id,
        g2.grupo_nombre,
        eg.encuesta_grupo_estado_id,
        cm.codigo_maestro_descripcion as encuesta_grupo_estado_str,
        eg.encuesta_grupo_fecha_creacion,
        eg.encuesta_grupo_fecha_modificacion');
        $this->db->from('encuesta_grupo eg');
        $this->db->join('codigo_maestro cm', 'eg.encuesta_grupo_estado_id = cm.codigo_maestro_valor', 'inner');
        $this->db->join('grupo g2', 'eg.grupo_id = g2.grupo_id', 'inner');
        $this->db->where('cm.codigo_maestro_tipo_id', 1);
        $this->db->where('eg.encuesta_id', $id);
        $this->db->where('eg.encuesta_grupo_estado_id', 2);
        $query = $this->db->get();
        $data = $query->result();
        
        return $data;
    }

    public function get_encuesta_pregunta($id, $activos = false){
        $estados = array('1', '2');
        $this->db->select('ep.encuesta_pregunta_id,
        ep.encuesta_id,
        ep.encuesta_pregunta_nombre,
        ep.encuesta_pregunta_valores,
        ep.encuesta_pregunta_tipo_id,
        cm2.codigo_maestro_descripcion as encuesta_pregunta_tipo_str,
        ep.encuesta_pregunta_estado_id,
        cm.codigo_maestro_descripcion as encuesta_pregunta_estado_str,
        ep.encuesta_pregunta_fecha_creacion,
        ep.encuesta_pregunta_fecha_modificacion');
        $this->db->from('encuesta_pregunta ep');
        $this->db->join('codigo_maestro cm', 'ep.encuesta_pregunta_estado_id = cm.codigo_maestro_valor', 'inner');
        $this->db->join('codigo_maestro cm2', 'ep.encuesta_pregunta_tipo_id = cm2.codigo_maestro_valor', 'inner');
        $this->db->where('cm.codigo_maestro_tipo_id', 1);
        $this->db->where('cm2.codigo_maestro_tipo_id', 7);
        $this->db->where('ep.encuesta_id', $id);

        if($activos){
            $this->db->where('ep.encuesta_pregunta_estado_id', 2);
        }else{
            $this->db->where_in('ep.encuesta_pregunta_estado_id', $estados);
        }
        
        
        $query = $this->db->get();
        $data = $query->result();
        
        return $data;
    }

    public function get_encuesta_pregunta_respuesta($id, $activos = false){
        $estados = array('1', '2');
        $this->db->select('IFNULL(eprp.encuesta_pregunta_respuesta_persona_id, 0) encuesta_pregunta_respuesta_persona_id,
        epr.encuesta_pregunta_respuesta_id,
        epr.encuesta_pregunta_id,
        epr.encuesta_pregunta_respuesta_nombre,
        epr.encuesta_pregunta_respuesta_estado_id,
        cm.codigo_maestro_descripcion as encuesta_pregunta_respuesta_estado_str,
        epr.encuesta_pregunta_respuesta_fecha_creacion,
        epr.encuesta_pregunta_respuesta_fecha_modificacion');
        $this->db->from('encuesta_pregunta_respuesta epr');
        $this->db->join('codigo_maestro cm', 'epr.encuesta_pregunta_respuesta_estado_id = cm.codigo_maestro_valor', 'inner');
        $this->db->join('encuesta_pregunta_respuesta_persona eprp', 'epr.encuesta_pregunta_respuesta_id = eprp.encuesta_pregunta_respuesta_id and eprp.encuesta_pregunta_respuesta_persona_estado_id = 2', 'left');
        $this->db->where('cm.codigo_maestro_tipo_id', 1);
        $this->db->where('epr.encuesta_pregunta_id', $id);
        $this->db->order_by('epr.encuesta_pregunta_respuesta_id', 'ASC');

        if($activos){
            $this->db->where('epr.encuesta_pregunta_respuesta_estado_id', 2);
        }else{
            $this->db->where_in('epr.encuesta_pregunta_respuesta_estado_id', $estados);
        }
        
        
        $query = $this->db->get();
        $data = $query->result();
        
        return $data;
    }

    /*Registro*/
    public function encuesta_insertar($data){
        
        $this->db->set('encuesta_fecha_creacion', 'NOW()', FALSE);
        $this->db->insert('encuesta', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function encuesta_grupo_insertar($data){
        
        $this->db->set('encuesta_grupo_fecha_creacion', 'NOW()', FALSE);
        $this->db->insert('encuesta_grupo', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function encuesta_pregunta_insertar($data){
        
        //$this->db->set('grupo_fecha_creacion', 'NOW()', FALSE);
        $this->db->insert('encuesta_pregunta', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function encuesta_pregunta_respuesta_insertar($data){
        
        //$this->db->set('grupo_fecha_creacion', 'NOW()', FALSE);
        $this->db->insert('encuesta_pregunta_respuesta', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    /*Modificacion*/
    public function encuesta_actualizar($id, $data){
        
        $this->db->set('encuesta_fecha_modificacion', 'NOW()', FALSE);
        $this->db->where('encuesta_id', $id);
        $this->db->update('encuesta', $data);
        return true;
    }

    public function encuesta_pregunta_actualizar($id, $data){
        
        $this->db->where('encuesta_pregunta_id', $id);
        $this->db->update('encuesta_pregunta', $data);
        return true;
    }

    public function encuesta_pregunta_respuesta_actualizar($id, $data){
        
        $this->db->where('encuesta_pregunta_respuesta_id', $id);
        $this->db->update('encuesta_pregunta_respuesta', $data);
        return true;
    }

    /*Eliminado*/
    public function encuesta_eliminar($id){
        
        $this->db->set('encuesta_estado_id', 0);
        $this->db->set('encuesta_fecha_modificacion', 'NOW()', FALSE);
        $this->db->where('encuesta_id', $id);
        $this->db->update('encuesta');
        return true;
    }

    public function encuesta_pregunta_eliminar($id){
        
        $this->db->set('encuesta_pregunta_estado_id', 0);
        $this->db->set('encuesta_pregunta_fecha_modificacion', 'NOW()', FALSE);
        $this->db->where('encuesta_pregunta_id', $id);
        $this->db->update('encuesta_pregunta');
        return true;
    }

    public function encuesta_pregunta_respuesta_eliminar($id){
        
        $this->db->set('encuesta_pregunta_respuesta_estado_id', 0);
        $this->db->set('encuesta_pregunta_respuesta_fecha_modificacion', 'NOW()', FALSE);
        $this->db->where('encuesta_pregunta_respuesta_id', $id);
        $this->db->update('encuesta_pregunta_respuesta');
        return true;
    }

    public function encuesta_grupo_eliminar($id){
        
        $this->db->set('encuesta_grupo_estado_id', 0);
        $this->db->set('encuesta_grupo_fecha_modificacion', 'NOW()', FALSE);
        $this->db->where('encuesta_grupo_id', $id);
        $this->db->update('encuesta_grupo');
        return true;
    }

    //Encuesta persona
    public function get_encuesta_persona_byId($id){
        
        $this->db->select('e.encuesta_id,
        p.persona_id,
        p.persona_email,
        p.persona_apellido_paterno,
        p.persona_apellido_materno,
        p.persona_nombre,
        p.persona_celular,
        e.encuesta_nombre,
        e.encuesta_tipo_alerta_id');
        $this->db->from('persona p');
        $this->db->join('encuesta_grupo eg', 'eg.grupo_id = p.grupo_id', 'inner');
        $this->db->join('encuesta e', 'e.encuesta_id = eg.encuesta_id', 'inner');
        $this->db->join('encuesta_persona ep', 'ep.persona_id = p.persona_id and ep.encuesta_id = e.encuesta_id', 'left');
        $this->db->where('IFNULL(ep.encuesta_persona_id, 0) = 0', null, false);
        $this->db->where('e.encuesta_estado_id = 2', null, false);
        $this->db->where('p.persona_estado_id = 2', null, false);
        $this->db->where('e.encuesta_id', $id);
        $this->db->where('DATE_FORMAT(NOW(),"%Y-%m-%d") between e.encuesta_fecha_inicio_alerta and e.encuesta_fecha_fin_alerta', null, false);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    public function get_encuesta_persona(){
        
        $this->db->select('e.encuesta_id,
        p.persona_id,
        p.persona_email,
        p.persona_apellido_paterno,
        p.persona_apellido_materno,
        p.persona_nombre,
        p.persona_celular,
        e.encuesta_nombre,
        e.encuesta_tipo_alerta_id,
        e.encuesta_json_dias_alerta');
        $this->db->from('persona p');
        $this->db->join('encuesta_grupo eg', 'eg.grupo_id = p.grupo_id', 'inner');
        $this->db->join('encuesta e', 'e.encuesta_id = eg.encuesta_id', 'inner');
        $this->db->join('encuesta_persona ep', 'ep.persona_id = p.persona_id and ep.encuesta_id = e.encuesta_id', 'left');
        $this->db->where('IFNULL(ep.encuesta_persona_id, 0) = 0', null, false);
        $this->db->where('e.encuesta_estado_id = 2', null, false);
        $this->db->where('p.persona_estado_id = 2', null, false);
        $this->db->where('DATE_FORMAT(NOW(),"%Y-%m-%d") between e.encuesta_fecha_inicio_alerta and e.encuesta_fecha_fin_alerta', null, false);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    //Encuesta persona
    public function get_encuesta_persona_byCodigo($codigo){
        
        $this->db->select('p2.persona_apellido_paterno,
        p2.persona_apellido_materno,
        p2.persona_nombre,
        ep.encuesta_id,
        ep.encuesta_persona_id');
        $this->db->from('encuesta_persona ep');
        $this->db->join('persona p2', 'ep.persona_id = p2.persona_id', 'inner');
        $this->db->where('ep.encuesta_persona_codigo', $codigo);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    public function encuesta_persona_insertar($data){
        
        $this->db->set('encuesta_persona_fecha_creacion', 'NOW()', FALSE);
        $this->db->set('encuesta_persona_estado_id', 1, FALSE);
        $this->db->insert('encuesta_persona', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function encuesta_persona_respuesta_insertar($data){

        $this->db->set('encuesta_pregunta_respuesta_persona_fecha_creacion', 'NOW()', FALSE);
        $this->db->insert('encuesta_pregunta_respuesta_persona', $data);
        
        return true;
    }

    public function encuesta_persona_respuesta_actualizar($id){

        $this->db->set('encuesta_pregunta_respuesta_persona_estado_id', 0);
        $this->db->set('encuesta_pregunta_respuesta_persona_fecha_modificacion', 'NOW()', FALSE);
        $this->db->where('encuesta_pregunta_respuesta_persona_id', $id);
        $this->db->update('encuesta_pregunta_respuesta_persona');
       
        return true;
    }
}
?>
