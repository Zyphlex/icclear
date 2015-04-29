<?php

class Land_model extends CI_Model {

    // +----------------------------------------------------------
    // | Beershop - product_model
    // +----------------------------------------------------------
    // | Thomas More Kempen - 2 TI - 201x-201x
    // +----------------------------------------------------------
    // | Product model
    // |
    // +----------------------------------------------------------
    // | K. Vangeel
    // +----------------------------------------------------------

    function __construct()
    {
        parent::__construct();
    }

       
    function getAll()
    {        
        $this->db->order_by('naam');
        $query = $this->db->get('land');
        return $query->result();
    }
    
    function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('land');
        return $query->row();
    }
    
    function update($land) {
        //Html entities en extra spaties verwijderen
        $land = escape_html($land);
        
        $this->db->where('id', $land->id);
        $this->db->update('land', $land);
    }

    function insert($land) {
        //Html entities en extra spaties verwijderen
        $land = escape_html($land);
        
        $this->db->insert('land', $land);
        return $this->db->insert_id();
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('land');
    }


    
}

?>