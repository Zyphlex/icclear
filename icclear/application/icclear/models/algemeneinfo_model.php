<?php

class Algemeneinfo_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function get()
    {           
        $this->load->model('conferentie_model');
        $actieveConferentie = $this->conferentie_model->getActieveConferentie();
        
        $this->db->where('id',$actieveConferentie->id);
        $query = $this->db->get('algemeneInfo');        
        return $query->row();        
    }
    
    
}

?>