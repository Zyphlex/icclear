<?php

class Status_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    // Een status ophalen
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('status');
        return $query->row();
    }
    
    // Elke status ophalen
    function getAll() {
        $query = $this->db->get('status');
        return $query->result();
    }

}
?>
