<?php

class Email_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function check_email_availablity() {
        $email = trim($this->input->post('email'));
        $email = strtolower($email);

        $query = $this->db->query('SELECT * FROM gebruiker where emailadres="' . $email . '"');

        if ($query->num_rows() > 0){
            return false;
        }            
        else{
            return true;
        }
            
    }

}

?>