<?php

class Faq_model extends CI_Model {

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

    function getAll() {
        $query = $this->db->get('faq');
        return $query->result();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('faq');
        return $query->row();
    }

    function update($faq) {
        $this->db->where('id', $faq->id);
        $this->db->update('faq', $faq);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('faq');
    }
    
    function insert($faq)
    {
        $this->db->insert('faq', $faq);
        return $this->db->insert_id();
    }

}

?>