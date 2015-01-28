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
    
    function getHotels()
    {        
        $query = $this->db->get('hotel');
        return $query->result();
    }
    
    function getRoutes()
    {        
        $query = $this->db->get('route');
        return $query->result();
    }
    
    function getHotelsConferentie()
    {
        $query = $this->db->get('hotel');
        $hotels = $query->result();
        
        $this->load->model('conferentie_model');
        
        foreach ($hotels as $hotel)
        {
            $hotel->conferentie = $this->conferentie_model->get($hotel->conferentieId);
        }
        
        return $hotels;
    }
    

    
}

?>