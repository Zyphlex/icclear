<?php

class Conferentiedag_model extends CI_Model {

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
        $this->db->order_by('datum');
        $query = $this->db->get('conferentiedag');
        return $query->result();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('conferentiedag');
        return $query->row();
    }
    
    function getFromConferentie($conferentieId) {
        $this->db->where('conferentieId', $conferentieId);
        $query = $this->db->get('conferentiedag');
        return $query->result();
    }
    
    function getGebouwenByDag(){
        $query = $this->db->get('conferentiedag');
        $dagen = $query->result();

        $this->load->model('gebouw_model');
        
        foreach ($dagen as $dag) {
            $dag->gebouw = $this->gebouw_model->get($dag->gebouwId);
        }

        return $dagen;
    }
    
    function insert($conferentiedag)
    {
        $this->db->insert('conferentiedag', $conferentiedag);
        return $this->db->insert_id();
    }

}

?>