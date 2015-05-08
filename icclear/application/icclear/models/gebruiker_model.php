<?php

class Gebruiker_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

//      veranderen in email
//    function check_username_availablity() {
//        $username = strtoupper(trim($this->input->post('username')));                
//        $this->db->where('UPPER(gebruikersnaam)', $username);
//        $query = $this->db->get('gebruiker');
//                
//        if ($query->num_rows() > 0)
//            return false;
//        else
//            return true;
//    }
    
    // Een gebruiker ophalen
     function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('gebruiker');
        return $query->row();
    }
    
    // een gebruiker ophalen met zijn type
    function getAllWithType() {
        $this->db->order_by('voornaam', 'asc');
        $query = $this->db->get('gebruiker');
        $gebruikers = $query->result();
        
        foreach ($gebruikers as $gebruiker) {
            $this->load->model('type_model');
           $gebruiker->type = $this->type_model->get($gebruiker->typeId);
        }
        
        return $gebruikers;
    }

    // Alle gebruikers ophalen, maar geen admins (typeId = 3)
    function getAll() {
        $this->db->where('typeId !=', 3);
        $this->db->order_by('activatie', 'desc');
        $query = $this->db->get('gebruiker');
        return $query->result();
    }
    
    // Alle admins ophalen (typeId = 3)
    function getAllAdmins() {
        $this->db->where('typeId', 3);
        $this->db->order_by('familienaam', 'asc');
        $query = $this->db->get('gebruiker');
        return $query->result();
    }
    
    // Alle gebruikers ophalen die spreker zijn op de actieve conferentie
    function getSprekersActieve(){
        $this->load->model('conferentie_model');
        $confId = $this->conferentie_model->getActieveConferentie();
        
        $this->db->where('conferentieId', $confId->id);
        // Alle goedgekeurde sessie voor de conferentie ophalen
        $this->db->where('isGoedgekeurd', 1);
        $this->db->group_by('gebruikerIdSpreker');
        $query = $this->db->get('sessie');
        $sessies = $query->result();    
        
        // Voor elke sessie de gegevens van de spreker ophalen
        foreach ($sessies as $s) {
            $s->spreker = $this->get($s->gebruikerIdSpreker);
        }
        
        return $sessies;
    }
    
    // Een spreker ophalen
    function getSpreker($sprekerId){
        $this->db->where('id', $sprekerId);
        $query = $this->db->get('gebruiker');
        return $query->row();                
    }
    
    // Een nieuwe gebruiker toevoegen
    function insert($gebruiker)
    {
        //Html entities en extra spaties verwijderen
        $gebruiker = escape_html($gebruiker);
        
        $this->db->insert('gebruiker', $gebruiker);
        return $this->db->insert_id();
    }
    
    // Een gebruiker updaten
    function update($gebruiker)
    {
        //Html entities en extra spaties verwijderen
        $gebruiker = escape_html($gebruiker);
        
        $this->db->where('id', $gebruiker->id);
        $this->db->update('gebruiker', $gebruiker);
    }
    
    // Een gebruiker verwijderen
    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('gebruiker');
    }
    

}

?>
