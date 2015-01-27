<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Locatie extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - Programma';         
        $data['active'] = 'locatie';
        
        $this->load->model('locatie_model');
        $data['gebouwen'] = $this->locatie_model->getGebouwen();
        $data['hotels'] = $this->locatie_model->getHotels();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'locatie/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    // TEST
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
