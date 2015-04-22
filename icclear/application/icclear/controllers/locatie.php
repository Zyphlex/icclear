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
        
        $this->load->model('gebouw_model');
        $data['gebouwen'] = $this->gebouw_model->getGebouwenConferentie();  
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'locatie/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function hotel() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - Hotels';         
        $data['active'] = 'hotel';
        
        $this->load->model('hotel_model');        
        $data['hotels'] = $this->hotel_model->getHotelsConferentie();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'locatie/hotels', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function route() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - Routes';         
        $data['active'] = '';
        
        $this->load->model('routes_model');        
        $data['routes'] = $this->routes_model->getRoutesConferentie();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'locatie/routes', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function overzichtRoutes() {        
            $gebouwId = $this->input->get('gebouwId');
            
            $this->load->model('routes_model');
            $data['routes'] = $this->routes_model->getRoutesGebouw($gebouwId);

            $this->load->view('locatie/overzichtroutes', $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
