<?php

class Sessies_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    //Get 1 sessie met spreker
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('sessie');
        $sessie = $query->row();
        
        $this->load->model('gebruiker_model');   
        $sessie->spreker = $this->gebruiker_model->getSpreker($sessie->gebruikerIdSpreker);
        
        return $sessie;
    }
    
    //Alle sessies ophalen
    function getAlleSessies() {
        $query = $this->db->get('sessie');
        return $query->result();
    }
    
    //Alle sessies van 1 spreker ophalen
    function getSessiesVanSpreker($id) {
        $this->db->where('gebruikerIdSpreker', $id);
        $query = $this->db->get('sessie');
        return $query->row();
    }
    
    //Alle sessies van 1 conferentie ophalen, die zijn goedgekeurd + de planning erbij nemen
    function getAll($id) {
        $this->db->where('conferentieId',$id);
        $this->db->where('isGoedgekeurd', '1');
        $query = $this->db->get('sessie');
        $sessies = $query->result();
        
        $this->load->model('planning_model');
        $this->load->model('gebruiker_model'); 
        $this->load->model('conferentiedag_model');         
        foreach ($sessies as $sessie) {
            $sessie->planning = $this->planning_model->getSessie($sessie->id);
            if ($sessie->planning != null) {
                $sessie->dag = $this->conferentiedag_model->get($sessie->planning->conferentiedagId);    
            }
            $sessie->spreker = $this->gebruiker_model->get($sessie->gebruikerIdSpreker);
        }
        
        return $sessies;
    }
    
    //Alle sessies ophalen van de actieve conferentie die zijn goedgekeurd met hun spreker en planningmoment
    function getAllMetSpreker() {        
        $this->load->model('conferentie_model');
        $actieveConferentie = $this->conferentie_model->getActieveConferentie();
        
        $this->db->where('isGoedgekeurd', '1');
        $this->db->where('conferentieId', $actieveConferentie->id);
        $query = $this->db->get('sessie');
        $sessies = $query->result();
                        
        $this->load->model('planning_model');
       
        foreach ($sessies as $sessie) {
            $sessie->planning = 
                 $this->planning_model->getSessie($sessie->id);
        }        
        
        $this->load->model('gebruiker_model');
        
        foreach ($sessies as $sessie) {
            $sessie->spreker = 
                 $this->gebruiker_model->getSpreker($sessie->gebruikerIdSpreker);
        }
        
        return $sessies;
    }
       
    //Alle sessies ophalen die nog NIET zijn goedgekeurd
    function getAllOngekeurdeMetSpreker() {        
        $this->load->model('conferentie_model');
        $conferentieId = $this->session->userdata('conferentieId');
        
        $this->db->where('isGoedgekeurd', '0');
        $this->db->where('conferentieId', $conferentieId);
        $query = $this->db->get('sessie');
        $sessies = $query->result();
        
        $this->load->model('gebruiker_model');
        
        foreach ($sessies as $sessie) {
            $sessie->spreker = 
                 $this->gebruiker_model->getSpreker($sessie->gebruikerIdSpreker);
        }
        
        return $sessies;
    }
    
    //Tellen hoeveel ongekeurde sessies er zijn
    function countOngekeurde($id) {        
        $this->load->model('conferentie_model');                      
        $this->db->where('isGoedgekeurd', '0');
        $this->db->where('conferentieId', $id);
        $query = $this->db->get('sessie');        
        return $query->num_rows();
    }
    
    //Tellen hoeveel gekeurde sessies er zijn
    function countGekeurde($id) {        
        $this->load->model('conferentie_model');                      
        $this->db->where('isGoedgekeurd', '1');
        $this->db->where('conferentieId', $id);
        $query = $this->db->get('sessie');        
        return $query->num_rows();
    }
    
    //1 sessie ophalen
//    function planningenPerStatus($sessieId){
//        $this->db->where('id', $sessieId);
//        $query = $this->db->get('sessie');
//        return $query->row();            
//    }
    
    function update($sessie)
    {
        //Html entities en extra spaties verwijderen
        $sessie = escape_html($sessie);
        
        $this->db->where('id', $sessie->id);
        $this->db->update('sessie', $sessie);
    }
    
    function insert($sessie)
    {
        //Html entities en extra spaties verwijderen
        $sessie = escape_html($sessie);
        
        $this->db->insert('sessie', $sessie);
        return $this->db->insert_id();
    }
    
    //Alle sessies opvragen van de gekozen conferentie
    function getAllPlanConf($id) {        
        $this->db->where('isGoedgekeurd', '1');
        $this->db->where('conferentieId', $id);
        $query = $this->db->get('sessie');
        return $query->result();
        
    }
    
    function getNietPlenaireActief($conferentieId){        
        $this->db->where('isPlenair', 0);
        $this->db->where('conferentieId', $conferentieId);
        $query = $this->db->get('sessie');
        $sessies = $query->result();
        $this->load->model('gebruiker_model');        
        foreach ($sessies as $s){
            $s->spreker = $this->gebruiker_model->get($s->gebruikerIdSpreker);
        }
        return $sessies;
    }
    
      function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('sessie');
    }
    
    
}
?>
