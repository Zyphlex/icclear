<?php

class Betaling_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function insert($betaling)
    {
        $this->db->insert('betaling', $betaling);
        return $this->db->insert_id();
    }
    
    
}

?>