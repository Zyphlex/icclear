<?php

class Sessies_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('sponsor');
        $sponsor = $query->row();
        
        return $sponsor;
    }
    
    function getAll() {
        $query = $this->db->get('sponsor');
        $sponsors = $query->result();
        
        return $sponsors;
    }
    
    function update($sponsor)
    {
        $this->db->where('id', $sponsor->id);
        $this->db->update('sponsor', $sponsor);
    }
    
    function insert($sponsor)
    {
        $this->db->insert('sponsor', $sponsor);
        return $this->db->insert_id();
    }
}
?>
