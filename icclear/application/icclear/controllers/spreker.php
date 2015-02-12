<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Spreker extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['user']  = $this->authex->getUserInfo();        
        $data['title'] = 'IC Clear - Sprekers'; 
        $data['active'] = 'spreker';
        
        $this->load->model('gebruiker_model');
        $data['sprekers'] = $this->gebruiker_model->getSprekersActieve();
                
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'spreker/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data); 
    }
    public function voorstel() {
        
        $data['user']  = $this->authex->getUserInfo();        
        $data['title'] = 'IC Clear - Sprekers'; 
        $data['active'] = 'spreker';       
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'spreker/voorstel', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data); 
        
    }
    
    public function indienen()
    {
        $this->load->model('conferentie_model');
        
        $sessie = new stdClass();
        $sessie->conferentiedagId = $this->input->post('conferentiedagId');
        $sessie->onderwerp = $this->input->post('onderwerp');
        $sessie->omschrijving = $this->input->post('omschrijving');
        $sessie->isGoedgekeurd = $this->input->post('0');
        $sessie->gebruikerIdSpreker = $this->input->post($this->authex->getUserInfo());
        $sessie->conferentieId = $this->input->post($this->conferentie_model->getActieveConferentie());       

        $this->load->model('sessies_model');
        $this->gebruiker_model->insert($sessie);
        
        redirect('home');
    }
  
    
}

?>