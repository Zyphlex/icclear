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

    function get($id) {  
        $this->db->where('id', $id);
        $query = $this->db->get('gebruikerActiviteit');
        return $query->row();
    }
    
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
    
    function getPrijsByConfGebruiker($id,$confId)
    {        
        $geld = 0;
                
        $this->db->where('gebruikerId', $id);
        $query = $this->db->get('gebruikerActiviteit');
        $activiteitenGeb = $query->result();
        
        $this->load->model('activiteit_model');      
        foreach ($activiteitenGeb as $a){
            $a->activiteit = $this->activiteit_model->get($a->activiteitId);              
            if ($a->activiteit->conferentieId == $confId)
            {
                $g->activiteit = $this->activiteit_model->get($a->activiteitId);
                $geld += ($a->activiteit->prijs * $a->aantalPersonen);
            }
        }        
        return $geld;
    }
        
    function insert($activiteit) {
        //Html entities en extra spaties verwijderen
        $activiteit = escape_html($activiteit);
        
        $this->db->insert('gebruikerActiviteit', $activiteit);
        return $this->db->insert_id();
    }
    
}

?>
