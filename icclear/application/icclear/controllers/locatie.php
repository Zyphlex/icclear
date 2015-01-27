<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Locatie extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - Venues';         
        $data['active'] = 'locatie';
        
        $this->load->model('locatie_model');
        $data['gebouwen'] = $this->locatie_model->getGebouwen();                

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'locatie/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function hotel() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - Hotels';         
        $data['active'] = 'hotel';
        
        $this->load->model('locatie_model');        
        $data['hotels'] = $this->locatie_model->getHotels();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'locatie/hotels', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function route() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - Routes';         
        $data['active'] = 'route';
        
        $this->load->model('locatie_model');        
        $data['routes'] = $this->locatie_model->getRoutes();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'locatie/routes', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
