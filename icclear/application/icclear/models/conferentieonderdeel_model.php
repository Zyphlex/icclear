<?php

class Conferentieonderdeel_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
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
    
    
    
}

?>