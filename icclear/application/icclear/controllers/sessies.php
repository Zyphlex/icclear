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
        $this->load->library('email');
    }
    
    public function index() {
         $user  = $this->authex->getUserInfo();
        $data['user'] = $user;
        $data['conferentieId'] = $this->session->userdata('conferentieId');        
        $this->load->model('inschrijving_model');
        $data['inschrijving'] = $this->inschrijving_model->getInschijvingByGebruiker($user->id);
        
        $data['title'] = 'IC Clear - Beheer';        
        $data['active'] = 'admin';        
                
        $this->load->model('sessies_model');
        $data['sessies'] = $this->sessies_model->getAll($data['conferentieId']);
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sessies/overzicht', 'footer' => 'main_footer');
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
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sessies/wijzigen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function toevoegen() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - Beheer';        
        $data['active'] = 'admin';        
                
        $this->load->model('sessies_model');
        $data['sessies'] = $this->sessies_model->getAll();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sessies/toevoegen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function verwijderen() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - Beheer';        
        $data['active'] = 'admin';        
                
        $this->load->model('sessies_model');
        $data['sessies'] = $this->sessies_model->getAll();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sessies/beheer', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function keuren() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - Beheer';        
        $data['active'] = 'admin';  
        
        $this->load->model('sessies_model');
        $data['sessies'] = $this->sessies_model->getAllOngekeurdeMetSpreker();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sessies/keur_overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function toonDetails($sessieId) {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - Beheer';        
        $data['active'] = 'admin';
        
        $this->load->model('sessies_model');
        $data['sessie'] = $this->sessies_model->get($sessieId);
        
        $this->load->view('admin/sessies/keur_detail', $data);
    }
    
    public function goedkeuren($sessieId){
        $data['user']  = $this->authex->getUserInfo();
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - Beheer';        
        $data['active'] = 'admin';
        
        $this->load->model('sessies_model');
        $this->load->model('gebruiker_model');
        
        $sessie = $this->sessies_model->get($sessieId);
        
        $sessie->isGoedgekeurd = 1;
        $sessie->spreker->typeId = 2;
        
        $this->sessies_model->update($sessie);
        
        $generatedKey = sha1(mt_rand(10000, 99999) . time() . $sessie->spreker->emailadres);
        $this->sendmail($sessie->spreker->emailadres, $sessie->spreker->id, $generatedKey);
        
        $sessie->spreker->generatedKey = $generatedKey;
        $this->gebruiker_model->update($sessie->spreker);
        
        $data['sessies'] = $this->sessies_model->getAllOngekeurdeMetSpreker();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sessies/keur_overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    private function sendmail($to, $id, $generatedKey) {
        $this->email->from('donotreply@thomasmore.be');
        $this->email->to($to);
        $this->email->subject('Sessievoorstel goedgekeurd');
        $this->email->message('Het sessievoorstel dat u heeft ingediend is goedgekeurd. De precieze planning wordt later bekend gemaakt. '
                . 'Volg alstublieft deze link om uw profiel te vervolledigen. ' . "\n" . "\n " . site_url("spreker/biografie/$id/$generatedKey"));
        $this->email->send();         
    }
    
    public function overzicht() {        
        $this->load->model('sessies_model');
        $data['sessies'] = $this->sessies_model->getAll($this->session->userdata('conferentieId'));

        $this->load->view('admin/sessies/lijst', $data);
    }
    
    public function detail() {        
            $id = $this->input->get('id');
                        
            $this->load->model('sessies_model');
            $sessie = $this->sessies_model->get($id);
            
            echo json_encode($sessie); 
    }
    
    public function update() {   
        $sessie->id = $this->input->post('id');
        $sessie->onderwerp = $this->input->post('onderwerp');
        $sessie->omschrijving = $this->input->post('omschrijving');
        
        $this->load->model('sessies_model');     
        $this->sessies_model->update($sessie);
        
        
        echo $id;
    }
    
    public function delete() {       
        $id = $this->input->post('id');
        
        $this->load->model('sessies_model');
        $deleted = $this->sessies_model->delete($id);
        
        echo $deleted;
    }
    
    
    // TEST
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
