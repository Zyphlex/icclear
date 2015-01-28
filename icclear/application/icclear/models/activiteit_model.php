<?php

class Activiteit_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function getActiviteitenPerConferentie()
    {
        $query = $this->db->get('activiteit');
        $activiteiten = $query->result();
        
        $this->load->model('conferentie_model');
         foreach ($activiteiten as $activiteit){
             $activiteit->conferentie = $this->conferentie_model->get($activiteit->conferentieId);
         }
         
         return $activiteiten;
    }
    
    function getActiviteitenActieve() {
        $this->load->model('conferentie_model');
        $actieveConferentie = $this->conferentie_model->getActieveConferentie();
        
        $this->db->where('conferentieId',$actieveConferentie->id);
        $query = $this->db->get('activiteit');
        return $query->result();
    }
    
}

?>