<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conferentie extends CI_Controller {
    
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
        $data['conferentie'] = $this->conferentie_model->get($this->session->userdata('conferentieId'));

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/conferentie/wijzigen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    

     public function toevoegen() {
        $data['user']  = $this->authex->getUserInfo();    
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - ';         
        $data['active'] = 'admin'; 
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/conferentie/toevoegen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function opslaan() {        
        $conferentie->id = $this->input->post('id');
        $conferentie->eindDatum = $this->input->post('einddatum');
        $conferentie->stad = $this->input->post('stad');
        $conferentie->landId = $this->input->post('land');
        $conferentie->beginDatum = $this->input->post('begindatum');
        $conferentie->naam = $this->input->post('naam');
        $conferentie->beschrijving = $this->input->post('beschrijving');
        $conferentie->seminarieDag = $this->input->post('seminariedag');
        //$conferentie->statusId = $this->input->post('id');
        $conferentie->maxInschrijvingen = $this->input->post('maxinschrijvingen');
        
        $this->load->model('conferentie_model');     
        $this->conferentie_model->update($conferentie);  
        echo $id;        
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/conferentie/wijzigen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
