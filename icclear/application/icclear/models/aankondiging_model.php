<?php

class Aankondiging_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function getAankondiging($id)
    {        
        $this->db->where('id', $id);
        $query = $this->db->get('aankondiging');        
        $aankondiging = $query->row();
        
        $this->load->model('gebruiker_model');  
        $aankondiging->admin = $this->gebruiker_model->get($aankondiging->gepostDoor);
            
        return $aankondiging;
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
    
    function getAankondigingenActieve(){
        $this->load->model('conferentie_model');
        $actieveConferentie = $this->conferentie_model->getActieveConferentie();
        
       $this->db->where('conferentieId',$actieveConferentie->id);
        $query = $this->db->get('aankondiging');        
       return $query->result();              
    }
    
    function update($aankondiging) {
        //Html entities en extra spaties verwijderen
        $aankondiging = escape_html($aankondiging);
        
        $this->db->where('id', $aankondiging->id);
        $this->db->update('aankondiging', $aankondiging);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('aankondiging');
    }
    
    function insert($aankondiging)
    {
        //Html entities en extra spaties verwijderen
        $aankondiging = escape_html($aankondiging);
        
        $this->db->insert('aankondiging', $aankondiging);
        return $this->db->insert_id();
    }
    
    
}

?>