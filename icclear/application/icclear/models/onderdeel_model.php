<?php

class Onderdeel_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    // Een conferentie onderdeel ophalen
    function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('conferentieOnderdeel');
        return $query->result();
        
    }
     
    // Alle conferentie onderdelen ophalen, met de conferentie waar ze bij horen
    function getOnderdelenPerConferentie()
    {
        $query = $this->db->get('conferentieOnderdeel');
        $conferentieOnderdelen = $query->result();
        
        $this->load->model('conferentie_model');
         foreach ($conferentieOnderdelen as $conferentieOnderdeel){
             $conferentieOnderdeel->conferentie = $this->conferentie_model->get($conferentieOnderdeel->conferentieId);
         }
         
         return $conferentieOnderdelen;
    }
    
    // Alle conferentie onderdelen van de actieve conferentie ophalen
    function getOnderdelenActieve() {
        $this->load->model('conferentie_model');
        $confId = $this->conferentie_model->getActieveConferentie();
        
        $this->db->where('conferentieId', $confId->id);
        $query = $this->db->get('conferentieOnderdeel');
        return $query->result();
    }
    
    
    
}

?>