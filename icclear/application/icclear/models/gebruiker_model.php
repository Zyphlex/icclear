<?php

class Gebruiker_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function check_username_availablity() {
        $username = trim($this->input->post('username'));        

        $query = $this->db->query('SELECT * FROM gebruiker where gebruikersnaam="' . $username . '"');

        if ($query->num_rows() > 0)
            return false;
        else
            return true;
    }
    
     function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('gebruiker');
        return $query->row();
    }

    function getAll() {
        $this->db->where('typeId', 1);
        $this->db->and('typeId', 2);
        $this->db->order_by('familienaam', 'asc');
        $query = $this->db->get('gebruiker');
        return $query->result();
    }
    
    function getAllAdmins() {
        $this->db->where('typeId', 3);
        $this->db->order_by('familienaam', 'asc');
        $query = $this->db->get('gebruiker');
        return $query->result();
    }
    
    function getSprekersActieve(){
        $this->db->where('typeId', 2);
        $query = $this->db->get('gebruiker');
        $sprekers = $query->result();    
        
        $this->load->model('sessies_model');
        foreach ($sprekers as $spreker) {
            $spreker->sessie = $this->sessies_model->getSessiesVanSpreker($spreker->id);
        }
        
        return $sprekers;
    }
    
    function getSpreker($sprekerId){
        $this->db->where('id', $sprekerId);
        $query = $this->db->get('gebruiker');
        return $query->row();                
    }
    
    function insert($gebruiker)
    {
        $this->db->insert('gebruiker', $gebruiker);
        return $this->db->insert_id();
    }
    
    function update($gebruiker)
    {
        $this->db->where('id', $gebruiker->id);
        $this->db->update('gebruiker', $gebruiker);
    }
    
    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('gebruiker');
    }
    

}

?>
