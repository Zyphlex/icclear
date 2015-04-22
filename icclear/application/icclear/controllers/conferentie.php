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

        $this->load->model('land_model');        
        $data['landen'] = $this->land_model->getAll();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/conferentie/wijzigen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    

     public function toevoegen() {
        $data['user']  = $this->authex->getUserInfo();    
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - ';         
        $data['active'] = 'admin'; 
        
        $this->load->model('land_model');        
        $data['landen'] = $this->land_model->getAll();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/conferentie/toevoegen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function nieuwopslaan() {       
        $conferentie->stad = $this->input->post('stad');
        $conferentie->landId = $this->input->post('land');
        $conferentie->naam = $this->input->post('naam');
        $conferentie->beschrijving = $this->input->post('beschrijving');
        $conferentie->seminarieDag = $this->input->post('seminariedag');
        $conferentie->maxInschrijvingen = $this->input->post('maxinschrijvingen');
        $conferentie->beginDatum = $this->input->post('begindatum');
        $conferentie->eindDatum = $this->input->post('einddatum');
        $conferentie->statusId = 3;
        
        $this->load->model('conferentie_model');     
        $id = $this->conferentie_model->insert($conferentie);  
              
        
        redirect('admin/dashboard/' . $id);
    }
    
    public function opslaan() {        
        $conferentie->id = $this->input->post('id');
        $conferentie->stad = $this->input->post('stad');
        $conferentie->landId = $this->input->post('land');
        $conferentie->naam = $this->input->post('naam');
        $conferentie->beschrijving = $this->input->post('beschrijving');
        $conferentie->seminarieDag = $this->input->post('seminariedag');
        //$conferentie->statusId = $this->input->post('id');
        $conferentie->maxInschrijvingen = $this->input->post('maxinschrijvingen');
        
        $this->load->model('conferentie_model');     
        $this->conferentie_model->update($conferentie);  
        echo $id;        
        
        redirect('admin/dashboard/' . $conferentie->id);
    }
    
    public function overzicht() {        
        $this->load->model('conferentie_onderdeel_model');
        $data['onderdelen'] = $this->conferentie_onderdeel_model->getAllConferentie($this->session->userdata('conferentieId'));
        
        $this->load->view('admin/conferentie/lijst', $data);
    }
    
    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('conferentie_onderdeel_model');
        $onderdeel = $this->conferentie_onderdeel_model->get($id);

        echo json_encode($onderdeel);
    }
    
    public function delete($id){
        $id = $this->input->post('id');

        $this->load->model('conferentie_onderdeel_model');
        $deleted = $this->conferentie_onderdeel_model->delete($id);

        echo $deleted;
    }
    
    public function update() {        
        $onderdeel->id = htmlentities($this->input->post('id'));
        $onderdeel->conferentieId = $this->session->userdata('conferentieId');
        $onderdeel->omschrijving = htmlentities($this->input->post('onderdeel'));
        $onderdeel->prijs = htmlentities($this->input->post('prijs'));
        $onderdeel->korting = htmlentities($this->input->post('korting'));
        
        $this->load->model('conferentie_onderdeel_model');
        if ($onderdeel->id == 0) {
            $id = $this->conferentie_onderdeel_model->insert($onderdeel);
        } else {
            $this->conferentie_onderdeel_model->update($onderdeel);
        }
        
        echo $id;
    }
    
}
