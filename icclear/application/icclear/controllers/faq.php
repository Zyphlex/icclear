<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - F.A.Q.';         
        $data['active'] = '';
        
        $this->load->model('faq_model');
        $data['vragen'] = $this->faq_model->getFaq();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'faq/faq', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    // TEST
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
