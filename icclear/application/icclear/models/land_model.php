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

    // Alle landen ophalen
    function getAll()
    {        
        $this->db->order_by('naam');
        $query = $this->db->get('land');
        return $query->result();
    }
    
    // Een land ophalen
    function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('land');
        return $query->row();
    }
    
    // Een land updaten
    function update($land) {
        //Html entities en extra spaties verwijderen
        $land = escape_html($land);
        
        $this->db->where('id', $land->id);
        $this->db->update('land', $land);
    }

    // Een nieuw land toevoegen
    function insert($land) {
        //Html entities en extra spaties verwijderen
        $land = escape_html($land);
        
        $this->db->insert('land', $land);
        return $this->db->insert_id();
    }

    // Een land verwijderen uit de database
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('land');
    }


    
}

?>