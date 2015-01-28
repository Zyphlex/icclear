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
  
    
}

?>