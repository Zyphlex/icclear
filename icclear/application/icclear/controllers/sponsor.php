<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sponsor extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['user']  = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Sponsors'; 
        $data['active'] = 'sponsors';        
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $this->load->model('sponsor_model');
        $data['sponsors'] = $this->sponsor_model->getAll();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'sponsor/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function overzicht() {
        $data['user']  = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Sponsors'; 
        $data['active'] = 'admin';
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $this->load->model('sponsor_model');
        $data['sponsors'] = $this->sponsor_model->getAll();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sponsor/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function wijzigen($id){
        $data['user']  = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Sponsors'; 
        $data['active'] = 'admin';
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $this->load->model('sponsor_model');
        $data['sponsor'] = $this->sponsor_model->get($id);
        
        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sponsor/wijzigen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function verwijderen($id){
        
    }
    
    public function update() {
        $data['user']  = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Sponsors'; 
        $data['active'] = 'admin';
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
        $this->load->model('sponsor_model');
        
        $sponsor->id = $this->input->post('id');
        $sponsor->naam = $this->input->post('naam');
        $sponsor->landId = $this->input->post('land');
        $sponsor->gemeente = $this->input->post('gemeente');
        $sponsor->postcode = $this->input->post('postcode');
        $sponsor->straat = $this->input->post('straat');
        $sponsor->nummer = $this->input->post('nummer');
        $sponsor->type = $this->input->post('type');
        
        $this->sponsor_model->update($sponsor);
        
        redirect('sponsor/overzicht');
    }

    
}