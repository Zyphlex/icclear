<?php

class Algemeneinfo_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function getAll()
    {           
        $query = $this->db->get('type');        
        return $query->result();        
    }
    
    
}

?>