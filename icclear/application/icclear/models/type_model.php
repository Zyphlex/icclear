<?php

class Type_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Een type ophalen
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('type');
        return $query->row();
    }

    // Alle types ophalen
    function getAll() {
        $query = $this->db->get('type');
        return $query->result();
    }

}

?>