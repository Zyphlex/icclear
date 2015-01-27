<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Programma extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - Programma';         
        $data['active'] = 'programma';
        
        $this->load->model('planning_model');
        $data['sessies'] = $this->sessies_model->getAll();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'planning/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    // TEST
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
