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
        $this->db->order_by('familienaam', 'asc');
        $query = $this->db->get('gebruiker');
        return $query->result();
    }
    
    function getSprekers(){
        $this->db->where('typeId', 2);
        $query = $this->db->get('gebruiker');
        return $query->result();                
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
