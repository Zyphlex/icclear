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

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => '', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }       

    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
