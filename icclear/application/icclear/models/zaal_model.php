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
    
    function getAll() {
        $query = $this->db->get('zaal');
        return $query->result();
    }

}
?>
