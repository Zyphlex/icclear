<?php

class Conferentie_onderdeel_model extends CI_Model {

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

    function __construct() {
        parent::__construct();
    }


    function getAllConferentie($id) {
        $this->db->where('conferentieId', $id);
        $query = $this->db->get('conferentieOnderdeel');
        return $query->result();
    }
    
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('conferentieOnderdeel');
        return $query->row();
    }
       
    function update($onderdeel) {
        $this->db->where('id', $onderdeel->id);
        $this->db->update('conferentieOnderdeel', $onderdeel);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('conferentieOnderdeel');
    }
    
    function insert($onderdeel)
    {
        $this->db->insert('conferentieOnderdeel', $onderdeel);
        return $this->db->insert_id();
    }
}

?>