<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gebouw extends CI_Controller {

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
        $data['user'] = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Gebouw';
        $data['active'] = 'Admin';        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $this->load->model('gebouw_model');
        $data['gebouwen'] = $this->gebouw_model->getGebouwen();
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebouw/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function wijzig($id){
        $data['user'] = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Gebouw wijzigen';
        $data['active'] = 'Admin';        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $this->load->model('gebouw_model');
        $data['gebouw'] = $this->gebouw_model->getGebouw($id);
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebouw/wijzigen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function toevoegen(){
        $data['user'] = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Gebouw toevoegen';
        $data['active'] = 'Admin';        
        $data['conferentieId'] = $this->session->userdata('conferentieId');        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebouw/toevoegen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function opslaan(){
        $gebouw->id = $this->input->post('id');
        $gebouw->naam =  $this->input->post('naam');
        $gebouw->postcode = $this->input->post('postcode');
        $gebouw->gemeente = $this->input->post('gemeente');
        $gebouw->straat = $this->input->post('straat');
        $gebouw->nummer = $this->input->post('nummer');
        $this->load->model('gebouw_model');
        $this->gebouw_model->update($gebouw);
        
    }

}

/* End of file gebouw.php */
/* Location: ./application/controllers/gebouw.php */
