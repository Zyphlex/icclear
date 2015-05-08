<?php

class Aankondiging_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    // Een aankondiging ophalen
    function getAankondiging($id)
    {        
        $this->db->where('id', $id);
        $query = $this->db->get('aankondiging');        
        return $query->row();
        
    }
    
    // alle aankondigingen van eenzelfde conferentie ophalen, samen met info van de persoon die deze plaatste
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
    
    // Alle aankondigingen van de actieve conferentie ophalen
    function getAankondigingenActieve(){
        $this->load->model('conferentie_model');
        $actieveConferentie = $this->conferentie_model->getActieveConferentie();
        
        $this->db->where('conferentieId',$actieveConferentie->id);
        $query = $this->db->get('aankondiging');        
       return $query->result();              
    }
    
    // De drie meest recente aankondigingen van de actieve conferentie ophalen
    function getNieuwsteAankondigingenActieve(){
        $this->load->model('conferentie_model');
        $actieveConferentie = $this->conferentie_model->getActieveConferentie();
        
        $this->db->where('conferentieId',$actieveConferentie->id);
        $this->db->order_by('id','DESC');
        $this->db->limit('3');
        $query = $this->db->get('aankondiging');        
       return $query->result();              
    }
    
    // Een aankondiging updaten
    function update($aankondiging) {
        //Html entities en extra spaties verwijderen
        $aankondiging = escape_html($aankondiging);
        
        $this->db->where('id', $aankondiging->id);
        $this->db->update('aankondiging', $aankondiging);
    }

    // Een aankondiging verwijderen
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('aankondiging');
    }
    
    // Een aankondiging toevoegen
    function insert($aankondiging)
    {
        //Html entities en extra spaties verwijderen
        $aankondiging = escape_html($aankondiging);
        
        $this->db->insert('aankondiging', $aankondiging);
        return $this->db->insert_id();
    }
    
    
}

?>