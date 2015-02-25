<?php

class Sessies_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('sessie');
        $sessie = $query->row();
        
        $this->load->model('gebruiker_model');   
        $sessie->spreker = $this->gebruiker_model->getSpreker($sessie->gebruikerIdSpreker);
        
        return $sessie;
    }
    
    function getAll($id) {
        $this->db->where('conferentieId',$id);
        $this->db->where('isGoedgekeurd', '1');
        $query = $this->db->get('sessie');
        $sessies = $query->result();
        
        $this->load->model('planning_model');        
        foreach ($sessies as $sessie) {
            $sessie->planning = 
                 $this->planning_model->getSessie($sessie->id);
        }
        
        $this->load->model('zaal_model');        
        foreach ($sessies as $sessie) {
            $sessie->zaal = 
                 $this->zaal_model->get($sessie->zaalId);
        }
        
        $this->load->model('conferentiedag_model');        
        foreach ($sessies as $sessie) {
            $sessie->conferentiedag = 
                 $this->conferentiedag_model->get($sessie->conferentiedagId);
        }
        
        return $sessies;
    }
    
    function getAllMetSpreker() {        
        $this->load->model('conferentie_model');
        $actieveConferentie = $this->conferentie_model->getActieveConferentie();
        
        $this->db->order_by('conferentiedagId');
        $this->db->where('isGoedgekeurd', '1');
        $this->db->where('conferentieId', $actieveConferentie->id);
        $query = $this->db->get('sessie');
        $sessies = $query->result();
                        
        $this->load->model('planning_model');
       
        foreach ($sessies as $sessie) {
            $sessie->planning = 
                 $this->planning_model->getSessie($sessie->id);
        }
        
        $this->load->model('zaal_model');
        
        foreach ($sessies as $sessie) {
            $sessie->zaal = 
                 $this->zaal_model->get($sessie->zaalId);
        }
        
        $this->load->model('gebruiker_model');
        
        foreach ($sessies as $sessie) {
            $sessie->spreker = 
                 $this->gebruiker_model->getSpreker($sessie->gebruikerIdSpreker);
        }
        
        return $sessies;
    }
    
    function update($sponsor)
    {
        $this->db->where('id', $sponsor->id);
        $this->db->update('sponsor', $sponsor);
    }
    
    function insert($sponsor)
    {
        $this->db->insert('sponsor', $sponsor);
        return $this->db->insert_id();
    }
}
?>
