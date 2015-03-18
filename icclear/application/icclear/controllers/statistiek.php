<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Statistiek extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['user']  = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Statistieken'; 
        $data['active'] = 'admin';        
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $this->load->model('sponsor_model');
        $data['sponsors'] = $this->sponsor_model->getAll();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'admin/statistiek/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
       
}