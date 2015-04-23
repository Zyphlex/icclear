<?php

class Betalingtype_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('betalingtype');
        return $query->row();
    }
            
    function getAll()
    {        
        $this->db->order_by('omschrijving');
        $query = $this->db->get('betalingtype');
        return $query->result();
    }    
    
}

?>