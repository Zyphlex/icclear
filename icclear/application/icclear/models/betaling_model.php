<?php

class Betaling_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('betaling');
        return $query->row();
    }
    
    
    function insert($betaling)
    {
        $this->db->insert('betaling', $betaling);
        return $this->db->insert_id();
    }
    
    
}

?>