<?php

class Onderdeel_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('conferentieOnderdeel');
        return $query->result();
        
    }
     
    
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
    
    function getOnderdelenActieve() {
        $this->load->model('conferentie_model');
        $confId = $this->conferentie_model->getActieveConferentie();
        
        $this->db->where('conferentieId', $confId->id);
        $query = $this->db->get('conferentieOnderdeel');
        return $query->result();
    }
    
    
    
}

?>