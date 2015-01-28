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
    
    function getHotel($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('hotel');
        return $query->row();
    }
    
    function getRoutes()
    {        
        $query = $this->db->get('route');
        return $query->result();
    }
    
    function getHotelsConferentie()
    {
        $this->load->model('conferentie_model');
        
        $id = $this->conferentie_model->getActieveConferentie();
        
        $this->db->where('conferentieId', $id);
        $query = $this->db->get('hotelConferentie');
        $hotelConferenties = $query->result();
        
        foreach ($hotelConferenties as $hotelConferentie)
        {
            $hotelConferentie->conferentie = $this->conferentie_model->get($hotelConferentie->conferentieId);
            $hotelConferentie->hotel = $this->getHotel($hotelConferentie->hotelId);
        }
        
        return $hotelConferenties;
    }
    

    
}

?>