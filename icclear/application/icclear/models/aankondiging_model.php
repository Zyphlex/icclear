<?php

class Aankondiging_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function getPerConferentie()
    {
        $this->db->where('id',$id);
        $this->db->get('aankondiging');
        
        $aankondigingen = $query->result();
        
        $this->load->model('conferentie_model');
         foreach ($aankondigingen as $aankondiging){
             $aankondiging->conferentie = $this->conferentie_model->get($activiteit->conferentieId);
         }
         
         return $aankondigingen;
    }
    
    
}

?>