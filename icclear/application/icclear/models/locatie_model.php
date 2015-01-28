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
        
        $conferentie = $this->conferentie_model->getActieveConferentie();
        
        $this->db->where('conferentieId', $conferentie->id);
        $query = $this->db->get('hotelConferentie');
        $hotelConferenties = $query->result();
        
        foreach ($hotelConferenties as $hotelConferentie)
        {
            //$hotelConferentie->conferentie = $this->conferentie_model->get($hotelConferentie->conferentieId);
            $hotelConferentie->hotel = $this->getHotel($hotelConferentie->hotelId);
        }
        
        return $hotelConferenties;
    }
    
    function getRoutesConferentie()
    {
        $this->load->model('conferentie_model');        
        $conferentie = $this->conferentie_model->getActieveConferentie();
        
        $this->db->where('conferentieId', $conferentie->id);
        $query = $this->db->get('route');        
                        
        return $query->result();
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
        
        foreach ($sessies as $sessie) {
            $sessie->gebouw = $this->getGebouw($sessie->zaal->gebouwId);
        }
        
        return $sessies;
    }
    
}

?>