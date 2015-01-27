<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inschrijven extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->helper('form');
    }

    public function index() {
        if (! $this->authex->loggedIn())
        {
            redirect('logon/login');
        } else {
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
    }
    
    public function inschrijven() {
        
        $data['user']  = $this->authex->getUserInfo();        
        $data['title'] = 'IC Clear - Inschrijven'; 
        $data['active'] = 'inschrijven';
        
        $betaling = new stdClass();
        
        $betaling->gebruikerId = $this->authex->getUserInfo();
        $betaling->methode = $this->input-get('methode');
        
        $this->load->model('betaling_model');
        $betalingId = $this->betaling_model->insert('$betaling');
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'inschrijving/inschrijving', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data); 
    }
    
  
    
}

?>