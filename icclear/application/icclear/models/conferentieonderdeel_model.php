<?php

class Conferentieonderdeel_model extends CI_Model {

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
    
    
    function getOnderdelenPerConferentie($id)
    {
        $query = $this->db->get('conferentieOnderdeel');
        $conferentieOnderdelen = $query->result();
        
        $this->load->model('conferentie_model');
         foreach ($conferentieOnderdelen as $conferentieOnderdeel){
             $conferentieOnderdeel->conferentie = $this->conferentie_model->getActieveConferentie($conferentieOnderdeel->conferentieId);
         }
         
         return $conferentieOnderdelen;
    }
    
    /*function getOnderdelenPerConferentie($id){
        $this->db->where('conferentieId', $id);
        $query = $this->db->get('conferentieOnderdeel');
        return $query->result();
    }*/
    
}

?>