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
    
    function getSprekers(){
        $this->db->where('typeId', 2);
        $query = $this->db->get('gebruiker');
        return $query->result();                
    }

}

?>