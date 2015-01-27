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
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - Beheer';        
        $data['active'] = 'admin';        
                
        $this->load->model('conferentie_model');
        $data['conferenties'] = $this->conferentie_model->getAll();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/beheer', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    

     public function dashboard($id) {
        $this->session->set_userdata('conferentieId', $id);  
        
        $data['user']  = $this->authex->getUserInfo();    
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - ';         
        $data['active'] = 'admin';                
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->get($id);
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/dashboard', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function overzichtGebruikers() {
        
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - Beheer';        
        $data['active'] = 'admin';        
                
        $this->load->model('gebruiker_model');
        $data['gebruikers'] = $this->gebruiker_model->getAll();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebruiker/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
        
        
    }
    
    
    // TEST
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
