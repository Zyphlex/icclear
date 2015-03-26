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

    function __construct()
    {
        parent::__construct();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('planning');
        return $query->row();
    }
    
    function getAll()
    {        
        $query = $this->db->get('planning');
        return $query->result();
    }
    
    function getSessie($id) {
        $this->db->where('sessieId', $id);
        $query = $this->db->get('planning');
        return $query->row();
    }
    
    function getAllByDag($id) { 
        $this->db->order_by('conferentiedagId');
        $this->db->where('conferentiedagId', $id);       
        $query = $this->db->get('planning');
        $planningen = $query->result();
        
        $this->load->model('sessies_model');        
        foreach ($planningen as $planning) {
            $planning->sessie = 
                 $this->sessies_model->planningenPerStatus($planning->sessieId);
        }                        
        $this->load->model('conferentiedag_model');        
        foreach ($planningen as $planning) {
            $planning->conferentiedag = 
                 $this->conferentiedag_model->get($planning->conferentiedagId);
        }
        
        $this->load->model('gebruiker_model');
        
        foreach ($planningen as $planning) {
            $planning->spreker = 
                 $this->gebruiker_model->getSpreker($planning->sessie->gebruikerIdSpreker);
        }
        
        $this->load->model('zaal_model');
        
        foreach ($planningen as $planning) {
            $planning->zaal = 
                 $this->zaal_model->get($planning->zaalId);
        }
        
        return $planningen;
    }
    
    function getAllPlanningen() {        
        $this->db->order_by('conferentiedagId, beginuur');       
        $query = $this->db->get('planning');
        $planningen = $query->result();
        
        $this->load->model('sessies_model');        
        foreach ($planningen as $planning) {
            $planning->sessie = 
                 $this->sessies_model->planningenPerStatus($planning->sessieId);
        }                        
        $this->load->model('conferentiedag_model');        
        foreach ($planningen as $planning) {
            $planning->conferentiedag = 
                 $this->conferentiedag_model->get($planning->conferentiedagId);
        }
        
        $this->load->model('gebruiker_model');
        
        foreach ($planningen as $planning) {
            $planning->spreker = 
                 $this->gebruiker_model->getSpreker($planning->sessie->gebruikerIdSpreker);
        }
        
        $this->load->model('zaal_model');
        
        foreach ($planningen as $planning) {
            $planning->zaal = 
                 $this->zaal_model->get($planning->zaalId);
        }
        
        return $planningen;
    }
    
    function update($planning) {
        $this->db->where('id', $planning->id);
        $this->db->update('planning', $planning);
    }

    function insert($planning) {
        $this->db->insert('planning', $planning);
        return $this->db->insert_id();
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('planning');
    }

    
}

?>