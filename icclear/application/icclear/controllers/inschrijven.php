<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inschrijven extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->helper('form');
    }

    public function index() {
        $data['user']  = $this->authex->getUserInfo();        
        $data['title'] = 'IC Clear - Inschrijven'; 
        $data['active'] = 'inschrijven';
        
        $this->load->model('onderdeel_model');
        $data['conferentieOnderdelen'] = $this->onderdeel_model->getOnderdelenPerConferentie();
        
        $this->load->model('activiteit_model');
        $data['activiteiten'] = $this->activiteit_model->getActiviteitenPerConferentie();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'inschrijving/inschrijving', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data); 
    }
    
    public function inschrijven() {
        
        $data['user']  = $this->authex->getUserInfo();        
        $data['title'] = 'IC Clear - Inschrijven'; 
        $data['active'] = 'inschrijven';
        
        $inschrijving = new stdClass();
        
        print_r($this->post('methode'));
        
        $inschrijving->gebruikerId = $this->authex->getUserInfo('user_id');
        $inschrijving->conferentieId = $this->post('conferentieId');
        $inschrijving->conferentieOnderdeelId = $this->post('conferentieonderdeelId');
        $inschrijving->betalingId = $this->input->post('methode');
        $inschrijving->datum = $this->input->post('datum');
        
        $this->load->model('inschrijving_model');
        $inschrijvingId = $this->inschrijving_model->insert($inschrijving);
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'home/home', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data); 
    }
    
    public function opvolgen(){
        
        $data['user']  = $this->authex->getUserInfo();        
        $data['title'] = 'IC Clear - Beheer'; 
        $data['active'] = 'admin';
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');

        $this->load->model('inschrijving_model');
        $data['inschrijvingen'] = $this->inschrijving_model->getAllInschijvingByConferentie($data['conferentieId']);       
        
        $this->load->model('gebruiker_activiteit_model');
        $data['gebactiviteiten'] = $this->gebruiker_activiteit_model->getActiviteitPrijs(); 

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/inschrijving/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
  
    
}

?>