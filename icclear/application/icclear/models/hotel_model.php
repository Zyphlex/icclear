<?php

class Hotel_model extends CI_Model {

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
    
    function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('hotel');
        return $query->row();
    }
    
    function getAll()
    {        
        $query = $this->db->get('hotel');
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
            $hotelConferentie->hotel = $this->get($hotelConferentie->hotelId);
        }
        
        return $hotelConferenties;
    }
    
    function update($hotel) {
        $this->db->where('id', $hotel->id);
        $this->db->update('hotel', $hotel);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('hotel');
    }
    
    function insert($hotel)
    {
        $this->db->insert('hotel', $hotel);
        return $this->db->insert_id();
    }
    
}

?>