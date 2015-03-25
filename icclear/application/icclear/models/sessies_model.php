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
    
    function getSessiesVanSpreker($id) {
        $this->db->where('gebruikerIdSpreker', $id);
        $query = $this->db->get('sessie');
        return $query->row();
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
       
    function getAllOngekeurdeMetSpreker() {        
        $this->load->model('conferentie_model');
        $actieveConferentie = $this->conferentie_model->getActieveConferentie();
        
        $this->db->order_by('conferentiedagId');
        $this->db->where('isGoedgekeurd', '0');
        $this->db->where('conferentieId', $actieveConferentie->id);
        $query = $this->db->get('sessie');
        $sessies = $query->result();
        
        $this->load->model('gebruiker_model');
        
        foreach ($sessies as $sessie) {
            $sessie->spreker = 
                 $this->gebruiker_model->getSpreker($sessie->gebruikerIdSpreker);
        }
        
        return $sessies;
    }
    
    function countOngekeurde() {        
        $this->load->model('conferentie_model');
        $actieveConferentie = $this->conferentie_model->getActieveConferentie();                
        $this->db->where('isGoedgekeurd', '0');
        $this->db->where('conferentieId', $actieveConferentie->id);
        $query = $this->db->get('sessie');
        $rowcount = $query->num_rows();           
        return $rowcount;
    }
    
    function planningenPerStatus($sessieId){
        $this->db->where('id', $sessieId);
        $query = $this->db->get('sessie');
        return $query->row();            
    }
    
    function update($sessie)
    {
        $this->db->where('id', $sessie->id);
        $this->db->update('sessie', $sessie);
    }
    
    function insert($sessie)
    {
        $this->db->insert('sessie', $sessie);
        return $this->db->insert_id();
    }
}
?>
