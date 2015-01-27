<?php

class Aankondiging_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function getAll()
    {        
        $query = $this->db->get('aankondiging');        
        $aankondigingen = $query->result();        
        $this->load->model('gebruiker_model');        
        foreach ($aankondigingen as $aankondiging){
            $aankondiging->poster = $this->gebruiker_model->get($aankondiging->gepostDoor);
        }                
        return $aankondigingen;
    }
    
    
}

?>