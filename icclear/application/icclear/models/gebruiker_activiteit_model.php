<?php

class Gebruiker_activiteit_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

//        veranderen naar email
//    function check_username_availablity() {
//        $username = trim($this->input->post('username'));
//
//        $query = $this->db->query('SELECT * FROM gebruiker where gebruikersnaam="' . $username . '"');
//
//        if ($query->num_rows() > 0)
//            return false;
//        else
//            return true;
//    }

    // Een gebruiker-activiteit ophalen
    function get($id) {  
        $this->db->where('id', $id);
        $query = $this->db->get('gebruikerActiviteit');
        return $query->row();
    }
    
    // Elke gebruiker-activiteit ophalen met info over de betaling en activiteit
    function getActiviteitPrijs() {
        $query = $this->db->get('gebruikerActiviteit');
        $gebActiviteiten = $query->result();

        $this->load->model('betaling_model');
        $this->load->model('activiteit_model');


        foreach ($gebActiviteiten as $gebActiviteit) {
            $gebActiviteit->betaling = $this->betaling_model->get($gebActiviteit->gebruikerId);
            $gebActiviteit->activiteit = $this->activiteit_model->get($gebActiviteit->activiteitId);
        }
        return $gebActiviteiten;
    }
        
//    function getByGebruiker($id)
//    {
//        $this->load->model('activiteit_model');        
//        $this->db->where('gebruikerId', $id);
//        $query = $this->db->get('gebruikerActiviteit');
//        $geb_act = $query->result();
//        foreach ($geb_act as $g){
//            $g->activiteit = $this->activiteit_model->get($g->activiteitId);
//        }        
//        return $geb_act;
//    }
    
    // Elke activiteit waarvoor een gebruiker is ingeschreven opzoeken en de totaalplrijs berekenen
    function getPrijsByGebruiker($id)
    {
        $geld = 0;
        $this->load->model('activiteit_model');
        $this->db->where('gebruikerId', $id);
        $query = $this->db->get('gebruikerActiviteit');
        $geb_act = $query->result();
        
        foreach ($geb_act as $g){
            $g->activiteit = $this->activiteit_model->get($g->activiteitId);
            $geld += ($g->activiteit->prijs * $g->aantalPersonen);
        }        
        return $geld;
    }
    
    // Alle activiteiten ophalen van een conferentie waarvoor de gebruiker is ingeschreven en de prijs ervan berekenen
    function getPrijsByConfGebruiker($id,$confId)
    {        
        $geld = 0;
                
        $this->db->where('gebruikerId', $id);
        $query = $this->db->get('gebruikerActiviteit');
        $activiteitenGeb = $query->result();
        
        $this->load->model('activiteit_model');      
        foreach ($activiteitenGeb as $a){
            $a->activiteit = $this->activiteit_model->get($a->activiteitId);  
            // Controleren of de activiteit wel bij de juiste conferentie hoort
            if ($a->activiteit->conferentieId == $confId)
            {
                $g->activiteit = $this->activiteit_model->get($a->activiteitId);
                $geld += ($a->activiteit->prijs * $a->aantalPersonen);
            }
        }        
        return $geld;
    }
    
    // Een gebruiker-activiteit updaten
    function update($activiteit) {
        $activiteit = escape_html($activiteit);
        
        $this->db->where('id', $activiteit->id);
        $this->db->update('gebruikerActiviteit', $activiteit);
    }
      
    // Gebruiker-activiteit toevoegen
    function insert($activiteit) {
        //Html entities en extra spaties verwijderen
        $activiteit = escape_html($activiteit);
        
        $this->db->insert('gebruikerActiviteit', $activiteit);
        return $this->db->insert_id();
    }
    
    // een gebruiker-activiteit berekenen
    function delete($id) {
        $this->db->where('gebruikerId', $id);
        $this->db->delete('gebruikerActiviteit');
    }
    
}

?>
