<?php

class Inschrijving_model extends CI_Model {

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

    function __construct() {
        parent::__construct();
    }

    function getAllInschijvingByConferentie($id) {
        $this->db->where('conferentieId', $id);
        $query = $this->db->get('inschrijving');
        $inschrijvingen = $query->result();

        $this->load->model('gebruiker_model');
        $this->load->model('betaling_model');
        $this->load->model('conferentie_onderdeel_model');


        foreach ($inschrijvingen as $inschrijving) {
            $inschrijving->gebruiker = $this->gebruiker_model->get($inschrijving->gebruikerId);
            $inschrijving->betaling = $this->betaling_model->get($inschrijving->betalingId);
            $inschrijving->confonderdeel = $this->conferentie_onderdeel_model->get($inschrijving->conferentieOnderdeelId);
            
        }
        return $inschrijvingen;
    }
    
    function getInschijvingByConferentie($id) {
        $this->db->where('gebruikerId',$id);
        $query = $this->db->get('inschrijving');
        $inschrijving = $query->row();
        
        $this->load->model('betaling_model');
        $this->load->model('conferentie_onderdeel_model');
                
        $inschrijving->betaling = $this->betaling_model->get($id);
        $inschrijving->confonderdeel = $this->conferentie_onderdeel_model->get($inschrijving->conferentieOnderdeelId);
                    
        return $inschrijving;
    }
    

}

?>