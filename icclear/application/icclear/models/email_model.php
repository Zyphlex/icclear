<?php

class Email_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function check_email_availablity($email) {        
        $email = strtolower($email);        
        $this->db->where('LOWER(emailadres)', $email);
        $query = $this->db->get('gebruiker');
        
        if ($query->num_rows() > 0){
            return false;
        }            
        else{
            return true;
        }
            
    }

}

?>