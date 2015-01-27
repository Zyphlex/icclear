<?php

class Planning_model extends CI_Model {

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
        $query = $this->db->get('planning');
        return $query->result();
    }
    
    function getSessie($id) {
        $this->db->where('sessieId', $id);
        $query = $this->db->get('planning');
        return $query->row();
    }

    
}

?>