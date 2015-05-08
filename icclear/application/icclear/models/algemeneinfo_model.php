<?php

class Algemeneinfo_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    // Een item van algemene info ophalen
    function get()
    {           
        $query = $this->db->get('algemeneInfo');        
        return $query->row();        
    }
    
    
}

?>