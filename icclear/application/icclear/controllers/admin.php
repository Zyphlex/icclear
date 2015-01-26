<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        if (!$this->authex->loggedIn()) {
            redirect('logon/aanmelden');
            //voorlopig
        } else {
            $user = $this->authex->getUserInfo();
            if ($user->typeId < 3) {
                redirect('logon/aanmelden');
                //voorlopig
            }
        }
    }
    
    public function index() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - Beheer';        
        $data['active'] = 'admin';
        
        $this->load->model('faq_model');
        $data['vragen'] = $this->faq_model->getFaq();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'admin/beheer', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function algemeen() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - Algemeen';        
        $data['active'] = 'admin';
        
        $this->load->model('faq_model');
        $data['vragen'] = $this->faq_model->getFaq();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'admin/algemeen/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function conferentie() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - Conferentie';         
        $data['active'] = 'admin';
        
        $this->load->model('faq_model');
        $data['vragen'] = $this->faq_model->getFaq();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'admin/conferentie/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    // TEST
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
