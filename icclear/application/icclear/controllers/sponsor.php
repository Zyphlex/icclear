<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sponsor extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['user']  = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Sponsors'; 
        $data['active'] = 'sponsors';        
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $this->load->model('sponsor_model');
        $data['sponsors'] = $this->sponsor_model->getAll();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'sponsor/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function overzicht() {
        $data['user']  = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Sponsors'; 
        $data['active'] = 'admin';
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $this->load->model('sponsor_model');
        $data['sponsors'] = $this->sponsor_model->getAll();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sponsor/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    
}