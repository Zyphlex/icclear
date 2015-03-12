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
    
    function update($zaal)
    {
        $this->db->where('id', $zaal->id);
        $this->db->update('zaal', $zaal);
    }
    
    function insert($zaal)
    {
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
