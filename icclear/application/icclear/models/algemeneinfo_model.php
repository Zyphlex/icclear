<?php

class Aankondiging_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function get()
    {           
        $this->load->model('conferentie_model');
        $actieveConferentie = $this->conferentie_model->getActieveConferentie();
        
        $this->db->where('conferentieId',$actieveConferentie->id);
        $query = $this->db->get('algemeneinfo');        
        return $query->row();        
    }
    
    
}

?>