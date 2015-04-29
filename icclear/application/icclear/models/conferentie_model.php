<?php

class Conferentie_model extends CI_Model {

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
        $this->db->order_by('beginDatum');
        $query = $this->db->get('conferentie');
        return $query->result();
    }
    
    function getById(){
        $query = $this->db->get('conferentie');
        return $query->result();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('conferentie');
        $conferentie = $query->row();
        
        $this->load->model('land_model');
        $conferentie->land = $this->land_model->get($conferentie->landId);
        
        return $conferentie;
    }

    function getActieveConferentie()
    {
        $this->db->where('statusId', '2');
        $query = $this->db->get('conferentie');
        return $query->row();
    }
    
    function getVerledenConferentie()
    {
        $this->db->where('statusId', '1');
        $query = $this->db->get('conferentie');
        return $query->result();
    }
    
    function getToekomstConferentie()
    {
        $this->db->where('statusId', '3');
        $query = $this->db->get('conferentie');
        return $query->result();
    }

    function update($conferentie)
    {
        //Html entities en extra spaties verwijderen
        $conferentie = escape_html($conferentie);
        
        $this->db->where('id', $conferentie->id);
        $this->db->update('conferentie', $conferentie);
    }
    
    function insert($conferentie)
    {
        //Html entities en extra spaties verwijderen
        $conferentie = escape_html($conferentie);
        
        $this->db->insert('conferentie', $conferentie);
        return $this->db->insert_id();
    }
}

?>