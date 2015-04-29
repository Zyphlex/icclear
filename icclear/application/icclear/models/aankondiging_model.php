<?php

class Aankondiging_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function getAllPerConferentie($id)
    {        
        $this->db->where('conferentieId',$id);
        $query = $this->db->get('aankondiging');        
        $aankondigingen = $query->result();        
        $this->load->model('gebruiker_model');        
        foreach ($aankondigingen as $aankondiging){
            $aankondiging->poster = $this->gebruiker_model->get($aankondiging->gepostDoor);
        }                
        return $aankondigingen;
    }
    
    function insert($titel, $inhoud, $gepostDoor, $conferentieId){
        $aankondiging->titel = $titel;
        $aankondiging->inhoud = $inhoud;
        $aankondiging->gepostDoor = $gepostDoor;
        $aankondiging->conferentieId = $conferentieId;
        //Html entities en extra spaties verwijderen
        $aankondiging = escape_html($aankondiging);
        $this->db->insert('aankondiging', $aankondiging);
        return $this->db->insert_id();
    }
    
    function getAankondigingenActieve(){
        $this->load->model('conferentie_model');
        $actieveConferentie = $this->conferentie_model->getActieveConferentie();
        
       $this->db->where('conferentieId',$actieveConferentie->id);
        $query = $this->db->get('aankondiging');        
       return $query->result();              
    }
    
    
}

?>