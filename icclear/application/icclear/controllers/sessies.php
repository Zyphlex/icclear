<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sessies extends CI_Controller {
    
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
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - Beheer';        
        $data['active'] = 'admin';        
                
        $this->load->model('sessies_model');
        $data['sessies'] = $this->sessies_model->getAll();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sessies/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    

    
    
    // TEST
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
