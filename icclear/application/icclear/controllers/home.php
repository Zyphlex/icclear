<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['user']  = $this->authex->getUserInfo();
        $this->load->model('aankondiging_model');
        $data['title'] = 'IC Clear - Home'; 
        $data['active'] = 'home';        
        $data['aankondigingen'] = $this->aankondiging_model-> getAankondigingenActieve();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'home/aankondigingen', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }       

    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
