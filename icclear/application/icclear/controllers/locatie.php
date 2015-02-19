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
        $data['active'] = '';
        
        $this->load->model('locatie_model');
        $data['gebouwen'] = $this->gebouw_model->getGebouwenConferentie();                

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'locatie/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function hotel() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - Hotels';         
        $data['active'] = 'hotel';
        
        $this->load->model('locatie_model');        
        $data['hotels'] = $this->hotel_model->getHotelsConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'locatie/hotels', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function route() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - Routes';         
        $data['active'] = '';
        
        $this->load->model('locatie_model');        
        $data['routes'] = $this->routes_model->getRoutesConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'locatie/routes', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
