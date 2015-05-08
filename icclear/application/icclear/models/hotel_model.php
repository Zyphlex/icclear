<?php

class Hotel_model extends CI_Model {


    function __construct()
    {
        parent::__construct();
    }

    // Een hotel ophalen
    function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('hotel');
        return $query->row();
    }
    
    // Alle hotels ophalen
    function getAll()
    {        
        $query = $this->db->get('hotel');
        return $query->result();
    }
       
    // Alle hotels die bij een conferentie passen ophalen
    function getHotelsConferentie()
    {
        $this->load->model('conferentie_model');
        
        $conferentie = $this->conferentie_model->getActieveConferentie();
        
        $this->db->where('conferentieId', $conferentie->id);
        $query = $this->db->get('hotelConferentie');
        $hotelConferenties = $query->result();
        
        // De gegevens van elk gevonden hotel ophalen
        foreach ($hotelConferenties as $hotelConferentie)
        {
            //$hotelConferentie->conferentie = $this->conferentie_model->get($hotelConferentie->conferentieId);
            $hotelConferentie->hotel = $this->get($hotelConferentie->hotelId);
        }
        
        return $hotelConferenties;
    }
    
    // Een hotel updaten
    function update($hotel) {
        //Html entities en extra spaties verwijderen
        $hotel = escape_html($hotel);
        
        $this->db->where('id', $hotel->id);
        $this->db->update('hotel', $hotel);
    }

    // Een hotel verwijderen
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('hotel');
    }
    
    // Nieuw hotel toevoegen
    function insert($hotel)
    {
        //Html entities en extra spaties verwijderen
        $hotel = escape_html($hotel);
        
        $this->db->insert('hotel', $hotel);
        return $this->db->insert_id();
    }
    
}

?>