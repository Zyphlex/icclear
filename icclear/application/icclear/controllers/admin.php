<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'notation'));
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
        $data['actieve'] = $this->conferentie_model->getActieveConferentie();
        $data['verleden'] = $this->conferentie_model->getVerledenConferentie();
        $data['toekomenden'] = $this->conferentie_model->getToekomstConferentie();
        $data['conferentieId'] = 0;

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/beheer', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    

     public function dashboard($id) {
        $this->session->set_userdata('conferentieId', $id);  
        
        $data['user']  = $this->authex->getUserInfo();    
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - Dashboard';         
        $data['active'] = 'admin';                
        
        $this->load->model('conferentie_model');
        $conferentie = $this->conferentie_model->get($id);
        $data['dataConferentie'] = $conferentie;
        
        $this->load->model('status_model');
        $data['status'] = $this->status_model->get($conferentie->statusId);
        
        $this->load->model('inschrijving_model');
        $data['aantalInschrijvingen'] = $this->inschrijving_model->getCountByConferentie($id);
        
        $this->load->model('sessies_model');
        $data['ongekeurdeSessies'] = $this->sessies_model->countOngekeurde($id);
        $data['gekeurdeSessies'] = $this->sessies_model->countGekeurde($id);
        
        $this->load->model('activiteit_model');
        $data['activiteiten'] = $this->activiteit_model->countActiviteiten($id);
        
        $this->session->set_userdata('conferentie',$conferentie->naam);  
        $data['conferentie'] = $this->session->userdata('conferentie');
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/dashboard', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
   
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
