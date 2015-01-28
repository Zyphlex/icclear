<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['user']  = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Home'; 
        $data['active'] = 'home';        
        
        $this->load->model('algemeneinfo_model');
        $data['algemeneinfo'] = $this->algemeneinfo_model-> get();
        
        $this->load->model('aankondiging_model');
        $data['aankondigingen'] = $this->aankondiging_model-> getAankondigingenActieve();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'home/home', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }       

    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
