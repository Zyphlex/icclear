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

    function getAllInschijvingByConferentie() {
        $query = $this->db->get('inschrijving');
        $inschrijvingen = $query->result();

        $this->load->model('gebruiker_model');
        $this->load->model('betaling_model');


        foreach ($inschrijvingen as $inschrijving) {
            $inschrijving->gebruiker = $this->gebruiker_model->get($inschrijving->gebruikerId);
            $inschrijving->betaling = $this->betaling_model->get($inschrijving->betalingId);
        }
        return $inschrijvingen;
    }

}

?>