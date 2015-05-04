<?php

class Zaal_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('zaal');
        return $query->row();
    }
    
    function getGebouw() {
        $query = $this->db->get('zaal');
        $zalen = $query->result();

        $this->load->model('gebouw_model');


        foreach ($zalen as $zaal) {
            $zaal->gebouw = $this->gebouw_model->get($zaal->gebouwId);            
        }
        return $zalen;
    }
    
    function getAll() {
        $query = $this->db->get('zaal');
        return $query->result();
    }
    
    function getAllPerGebouw($id) {
        $this->db->where('gebouwId', $id);
        $query = $this->db->get('zaal');
        return $query->result();
    }
    
    function update($zaal)
    {
        //Html entities en extra spaties verwijderen
        $zaal = escape_html($zaal);
        
        $this->db->where('id', $zaal->id);
        $this->db->update('zaal', $zaal);
    }
    
    function insert($zaal)
    {
        //Html entities en extra spaties verwijderen
        $zaal = escape_html($zaal);
        
        $this->db->insert('zaal', $zaal);
        return $this->db->insert_id();
    }
    
     function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('zaal');
    }

}
?>
