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
        
    function getByGebruiker($id)
    {
        $this->load->model('activiteit_model');        
        $this->db->where('gebruikerId', $id);
        $query = $this->db->get('gebruikerActiviteit');
        $geb_act = $query->result();
        foreach ($geb_act as $g){
            $g->activiteit = $this->activiteit_model->get($g->activiteitId);
        }        
        return $geb_act;
    }

}

?>
