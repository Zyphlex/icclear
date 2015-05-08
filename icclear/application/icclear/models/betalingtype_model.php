<?php

class Betalingtype_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    // Een betalingtype ophalen
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('betalingtype');
        return $query->row();
    }
            
    // Alle betalingtypes ophalen
    function getAll()
    {        
        $this->db->order_by('omschrijving');
        $query = $this->db->get('betalingtype');
        return $query->result();
    }    
    
}

?>