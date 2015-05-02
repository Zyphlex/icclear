<?php

class Planning_model extends CI_Model {

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

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('planning');
        return $query->row();
    }

    function getAll() {
        $query = $this->db->get('planning');
        return $query->result();
    }
    
    function getAllPlanning($id) {
        $this->db->order_by('conferentiedagId, beginuur');    
        $this->db->where('conferentiedagId', $id);
        $query = $this->db->get('planning');
        return $query->result();
    }
    
    function getSessie($id) {
        $this->db->where('sessieId', $id);
        $query = $this->db->get('planning');
        return $query->row();
    }

    function getVanDag($id) {
        $this->db->where('conferentiedagId', $id);
        $query = $this->db->get('planning');
        $planningen = $query->result();

        $this->load->model('sessies_model');
        $this->load->model('zaal_model');
        $this->load->model('gebouw_model');
        $this->load->model('land_model');
        
        foreach ($planningen as $planning) {
            $planning->sessie = $this->sessies_model->planningenPerStatus($planning->sessieId);
            $planning->zaal = $this->zaal_model->get($planning->zaalId);
            $planning->gebouw = $this->gebouw_model->get($planning->zaal->gebouwId);
            $planning->land = $this->land_model->get($planning->gebouw->landId);
        }

        return $planningen;
    }

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

    function getAllPlanningen() {
        $this->db->order_by('conferentiedagId, beginuur');
        $query = $this->db->get('planning');
        $planningen = $query->result();

        $this->load->model('sessies_model');
        foreach ($planningen as $planning) {
            $planning->sessie = $this->sessies_model->planningenPerStatus($planning->sessieId);
        }
        $this->load->model('conferentiedag_model');
        foreach ($planningen as $planning) {
            $planning->conferentiedag = $this->conferentiedag_model->get($planning->conferentiedagId);
        }

        $this->load->model('gebruiker_model');

        foreach ($planningen as $planning) {
            $planning->spreker = $this->gebruiker_model->getSpreker($planning->sessie->gebruikerIdSpreker);
        }

        $this->load->model('zaal_model');

        foreach ($planningen as $planning) {
            $planning->zaal = $this->zaal_model->get($planning->zaalId);
        }

        return $planningen;
    }
    
    function getOverzichtActieve() {           
        $this->load->model('conferentie_model');
        $confId = $this->conferentie_model->getActieveConferentie();
        $this->db->where('conferentieId', $confId->id);
        $query = $this->db->get('conferentiedag');
        $dagen = $query->result();
         
        $this->load->model('sessies_model');
        $this->load->model('zaal_model');
        foreach ($dagen as $d) {
            $d->programma = $this->getAllPlanning($d->id);
            foreach ($d->programma as $p) {
                $p->zaal = $this->zaal_model->get($p->zaalId);
                $p->sessie = $this->sessies_model->get($p->sessieId);
            }
        }     
        return $dagen;
    }
    

    function update($planning) {
        //Html entities en extra spaties verwijderen
        $planning = escape_html($planning);
        
        $this->db->where('id', $planning->id);
        $this->db->update('planning', $planning);
    }

    function insert($planning) {
        //Html entities en extra spaties verwijderen
        $planning = escape_html($planning);
        
        $this->db->insert('planning', $planning);
        return $this->db->insert_id();
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('planning');
    }

}

?>