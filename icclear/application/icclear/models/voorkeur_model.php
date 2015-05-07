<?php

class Voorkeur_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
            
    function insert($voorkeur)
    {
        //Html entities en extra spaties verwijderen
        $voorkeur = escape_html($voorkeur);        
        $this->db->insert('voorkeur', $voorkeur);
        return $this->db->insert_id();
    }
        
    
    
}
?>
