<?php

class Algemeneinfo_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function get()
    {           
        $query = $this->db->get('algemeneInfo');        
        return $query->row();        
    }
    
    
}

?>