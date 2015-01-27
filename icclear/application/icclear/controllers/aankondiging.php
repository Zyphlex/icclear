<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aankondiging extends CI_Controller {
    
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
//        $data['conferentie'] = $this->session->userdata('conferentie');
        
        $this->load->model('aankondiging_model');
        $data['aankondigingen'] = $this->aankondiging_model->getAllPerConferentie($this->session->userdata('conferentieId'));
        
        $data['title'] = 'IC Clear - aankondigingen';         
        $data['active'] = 'admin';                
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/aankondiging/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function wijzigen($id) {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - Beheer';        
        $data['active'] = 'admin'; 
                
        $this->load->model('sessies_model');
        $data['sessie'] = $this->sessies_model->get($id);
        
        $this->load->model('zaal_model');
        $data['zalen'] = $this->zaal_model->getAll();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sessies/wijzigen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function toevoegen() {
        $data['user']  = $this->authex->getUserInfo();        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
        $data['title'] = 'IC Clear - Aankondiging toevoegen';        
        $data['active'] = 'admin';        
                        

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/aankondiging/toevoegen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function verwijderen() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - Beheer';        
        $data['active'] = 'admin';        
                
        $this->load->model('sessies_model');
        $data['sessies'] = $this->sessies_model->getAll();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sessies/beheer', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    

    
    
    // TEST
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
