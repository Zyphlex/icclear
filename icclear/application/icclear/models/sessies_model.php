<?php

class Sessies_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('sessie');
        return $query->row();
    }

    function getAll() {
        $this->db->where('isGoedgekeurd', '1');
        $query = $this->db->get('sessie');
        $sessies = $query->result();
        
        $this->load->model('planning_model');
        
        foreach ($sessies as $sessie) {
            $sessie->planning = 
                 $this->planning_model->getSessie($sessie->id);
        }
        
        return $sessies;
    }
    

}
?>
