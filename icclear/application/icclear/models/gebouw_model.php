<?php

class Locatie_model extends CI_Model {

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

       
    function getGebouwen()
    {        
        $query = $this->db->get('gebouw');
        return $query->result();
    }
    
    function getGebouw($id)
    {        
        $this->db->where('id', $id);
        $query = $this->db->get('gebouw');
        return $query->row();
    }
        
    function getGebouwenConferentie()
    {
        $this->load->model('conferentie_model');        
        $conferentie = $this->conferentie_model->getActieveConferentie();
        
        $this->db->where('conferentieId', $conferentie->id);
        $query = $this->db->get('sessie');   
        $sessies = $query->result();
        
        $this->load->model('zaal_model');        
        foreach ($sessies as $sessie)
        {
            $sessie->zaal = $this->zaal_model->get($sessie->zaalId);
        }  
        
        $this->load->model('gebouw_model');    
        foreach ($sessies as $sessie) {
            $sessie->gebouw = $this->gebouw_model->getGebouw($sessie->zaal->gebouwId);
        }
        
        return $sessies;
    }
    
}

?>