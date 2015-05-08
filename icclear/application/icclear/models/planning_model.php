<?php

class Planning_model extends CI_Model {


    function __construct() {
        parent::__construct();
    }

    // Een gepland item ophalen
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('planning');
        return $query->row();
    }

    // Alle geplande items ophalen
    function getAll() {
        $query = $this->db->get('planning');
        return $query->result();
    }
    
    // Alle geplande items van een conferentiedag ophalen
    function getAllPlanning($id) {
        $this->db->order_by('conferentiedagId, beginuur');    
        $this->db->where('conferentiedagId', $id);
        $query = $this->db->get('planning');
        return $query->result();
    }
    
    // De planning van een bepaalde sessie ophalen
    function getSessie($id) {
        $this->db->where('sessieId', $id);
        $query = $this->db->get('planning');
        return $query->row();
    }

    // Alle items van een conferentiedag ophalen, samen met info over de sessie, de zaal, het gebouw en het land
    function getVanDag($id) {
        $this->db->where('conferentiedagId', $id);
        $query = $this->db->get('planning');
        $planningen = $query->result();

        $this->load->model('sessies_model');
        $this->load->model('zaal_model');
        $this->load->model('gebouw_model');
        $this->load->model('land_model');
        
        foreach ($planningen as $planning) {
            $planning->sessie = $this->sessies_model->get($planning->sessieId);
            $planning->zaal = $this->zaal_model->get($planning->zaalId);
            $planning->gebouw = $this->gebouw_model->get($planning->zaal->gebouwId);
            $planning->land = $this->land_model->get($planning->gebouw->landId);
        }

        return $planningen;
    }

    // Alle conferentiedagen ophalen en deze opvullen met de planning van die dag
    function getAllByDag($id) {

        $this->db->where('conferentieId', $id);
        $this->db->order_by('id');
        $query = $this->db->get('conferentiedag');
        $dagen = $query->result();

        foreach ($dagen as $dag) {
            $dag->planning = $this->getVanDag($dag->id);
        }

        return $dagen;
    }
    
    // De planning van elke conferentiedag van de actieve conferentie ophalen
    function getOverzichtActieve() {           
        $this->load->model('conferentie_model');
        $confId = $this->conferentie_model->getActieveConferentie();
        $this->db->where('conferentieId', $confId->id);
        $query = $this->db->get('conferentiedag');
        $dagen = $query->result();
         
        $this->load->model('sessies_model');
        $this->load->model('zaal_model');
        // Alle geplande items van een dag ophalen
        foreach ($dagen as $d) {
            $d->programma = $this->getAllPlanning($d->id);
            // Meer info over elk ingepland item ophalen
            foreach ($d->programma as $p) {
                $p->zaal = $this->zaal_model->get($p->zaalId);
                $p->sessie = $this->sessies_model->get($p->sessieId);
            }
        }     
        return $dagen;
    }
    
    // Een gepland item updaten
    function update($planning) {
        //Html entities en extra spaties verwijderen
        $planning = escape_html($planning);
        
        $this->db->where('id', $planning->id);
        $this->db->update('planning', $planning);
    }

    // Een nieuw gepland item toevoegen
    function insert($planning) {
        //Html entities en extra spaties verwijderen
        $planning = escape_html($planning);
        
        $this->db->insert('planning', $planning);
        return $this->db->insert_id();
    }

    // Een gepland item verwijderen
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('planning');
    }
    
    // Alle niet-plenaire geplande items ophalen van een conferentiedag
    // EDIT: Controle plenair/niet-plenair gebeurt in view
    function getAllPlanningNietPlenair($id) {
        $this->db->order_by('conferentiedagId, beginuur');    
        $this->db->where('conferentiedagId', $id);
        $query = $this->db->get('planning');
        return $query->result();
    }
    
    // Alle niet-plenaire geplande items ophalen van elke dag van de actieve conferentie
    // EDIT: Controle plenair/niet-plenair gebeurt in view
    function getOverzichtActieveNietPlenaire() {           
        $this->load->model('conferentie_model');
        $confId = $this->conferentie_model->getActieveConferentie();
        $this->db->where('conferentieId', $confId->id);
        $query = $this->db->get('conferentiedag');
        $dagen = $query->result();
         
        $this->load->model('sessies_model'); 
        // Alle niet-plenaire geplande items per dag ophalen
        // EDIT: Controle plenair/niet-plenair gebeurt in view
        foreach ($dagen as $d) {
            $d->programma = $this->getAllPlanningNietPlenair($d->id);
            foreach ($d->programma as $p) { 
                // De gegevens van de ingeplande sessie ophalen
                $p->sessie = $this->sessies_model->get($p->sessieId);
            }
        }     
        return $dagen;
    }

}

?>