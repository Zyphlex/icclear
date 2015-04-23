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
        $this->load->model('betalingtype_model');
        $this->load->model('conferentie_model');


        foreach ($inschrijvingen as $inschrijving) {
            $inschrijving->gebruiker = $this->gebruiker_model->get($inschrijving->gebruikerId);
            $inschrijving->betaling = $this->betaling_model->get($inschrijving->betalingId);
            $inschrijving->confonderdeel = $this->conferentie_onderdeel_model->get($inschrijving->conferentieOnderdeelId);
            $inschrijving->conferentie = $this->conferentie_model->get($inschrijving->conferentieId);
        }
        return $inschrijvingen;
    }

    function getInschijvingByConferentie($id) {
        $this->db->where('gebruikerId', $id);
        $query = $this->db->get('inschrijving');
        if ($query->num_rows() == 1) {
            $inschrijving = $query->row();
            $this->load->model('betaling_model');
            $this->load->model('conferentie_onderdeel_model');
            $this->load->model('conferentie_model');
            $this->load->model('betalingtype_model');
            $this->load->model('gebruiker_activiteit_model');
            
            
            $inschrijving->betaling = $this->betaling_model->get($inschrijving->betalingId);
            $inschrijving->confonderdeel = $this->conferentie_onderdeel_model->get($inschrijving->conferentieOnderdeelId);
            $inschrijving->conferentie = $this->conferentie_model->get($inschrijving->conferentieId);            
            $inschrijving->type = $this->betalingtype_model->get($inschrijving->methodeId);
            
        } else {
            $inschrijving = null;
        }
        return $inschrijving;
    }

    function getCountByConferentie($id) {
        $this->db->where('conferentieId', $id);
        $query = $this->db->get('inschrijving');
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function insert($inschrijving) {
        $this->db->insert('inschrijving', $inschrijving);
        return $this->db->insert_id();
    }

}

?>