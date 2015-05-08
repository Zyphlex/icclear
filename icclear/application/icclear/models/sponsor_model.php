<?php

class Sponsor_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    // Een sponsor met het bijbehorende land ophalen
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('sponsor');
        $sponsor = $query->row();
        
        $this->load->model('land_model');
        $sponsor->land = $this->land_model->get($sponsor->landId);
        
        return $sponsor;
    }
    
    // Alle sponsors met het bijbehorende land ophalen
    function getAll() {
        $query = $this->db->get('sponsor');
        $sponsors = $query->result();
        
        $this->load->model('land_model');
        
        foreach ($sponsors as $sponsor)
        {
            $sponsor->land = $this->land_model->get($sponsor->landId);
        }
        
        return $sponsors;
    }
    
    // Een sponsor updaten
    function update($sponsor)
    {
        $this->db->where('id', $sponsor->id);
        $this->db->update('sponsor', $sponsor);
    }
    
    // Een nieuwe sponsor toevoegen
    function insert($sponsor)
    {
        //Html entities en extra spaties verwijderen
        $sponsor = escape_html($sponsor);
        
        $this->db->insert('sponsor', $sponsor);
        return $this->db->insert_id();
    }
    
    // Een sponsor verwijderen
    function delete($id)
    {
        //Html entities en extra spaties verwijderen
        $sponsor = escape_html($sponsor);
        
        $this->db->where('id', $id);
        $this->db->delete('sponsor', $sponsor);
    }
}
?> 
