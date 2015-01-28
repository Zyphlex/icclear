<?php

class Inschrijving_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllWithGebruiker() {
        $this->db->order_by('gebruikerId', 'asc');
        $query = $this->db->get('inschrijving');
        $inschrijvingen = $query->result();

        $this->load->model('gebruiker_model');

        foreach ($inschrijvingen as $inschrijving) {
            $inschrijving->gebruiker = $this->gebruiker_model->get($inschrijving->gebruikerId);
        }
        
        return $inschrijvingen;
    }

}

?>