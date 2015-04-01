<?php

class Sponsor_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('sponsor');
        $sponsor = $query->row();
        
        $this->load->model('land_model');
        $sponsor->land = $this->land_model->get($sponsor->landId);
        
        return $sponsor;
    }
    
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
    
    function update($sponsor)
    {
        $this->db->where('id', $sponsor->id);
        $this->db->update('sponsor', $sponsor);
    }
    
    function insert($sponsor)
    {
        $this->db->insert('sponsor', $sponsor);
        return $this->db->insert_id();
    }
    
    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('sponsor', $sponsor);
    }
}
?> 
