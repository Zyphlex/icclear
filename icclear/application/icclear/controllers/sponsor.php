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
    
    public function overzichtAdmin() {
        $data['user']  = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Sponsors'; 
        $data['active'] = 'sponsors';        
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $this->load->model('sponsor_model');
        $data['sponsors'] = $this->sponsor_model->getAll();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'admin/sponsor/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('sponsor_model');
        $sponsor = $this->sponsor_model->get($id);

        echo json_encode($sponsor);
    }
    
    public function delete($id){
        $id = $this->input->post('id');

        $this->load->model('gebruiker_model');
        $deleted = $this->gebruiker_model->delete($id);

        echo $deleted;
    }
    
    public function update() {        
        $sponsor->id = $this->input->post('id');
        $sponsor->naam = $this->input->post('naam');
        $sponsor->landId = $this->input->post('land');
        $sponsor->gemeente = $this->input->post('gemeente');
        $sponsor->postcode = $this->input->post('postcode');
        $sponsor->straat = $this->input->post('straat');
        $sponsor->nummer = $this->input->post('nummer');
        $sponsor->type = $this->input->post('type');
        
        $this->load->model('sponsor_model');
        if ($sponsor->id == 0) {
            $id = $this->sponsor_model->insert($sponsor);
        } else {
            $this->sponsor_model->update($sponsor);
        }
        
        echo $id;
    }

    
}