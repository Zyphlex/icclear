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
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
        //Kijken of user reeds is ingeschreven, als dit zo is, knop verbergen op view
        $this->load->model('inschrijving_model');
        if ($user == null) {
            $data['inschrijving'] = null;
        } else {
            $inschrijving = $this->inschrijving_model->IsGebruikerIngeschreven($user->id);
            if ($inschrijving == null) {
                $data['inschrijving'] = null;
            } else {
                $data['inschrijving'] = $inschrijving;
            }
        }

        $data['title'] = 'IC Clear - Beheer';
        $data['active'] = 'admin';

        $this->load->model('sessies_model');
        $data['sessies'] = $this->sessies_model->getAll($data['conferentieId']);

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sessies/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    //hier kan een sessie gekeurd worden om in het programma opgenomen te worden
    public function keuren() {
         $user = $this->authex->getUserInfo();
        $data['user'] = $user;
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
        //Kijken of user reeds is ingeschreven, als dit zo is, knop verbergen op view
        $this->load->model('inschrijving_model');
        if ($user == null) {
            $data['inschrijving'] = null;
        } else {
            $inschrijving = $this->inschrijving_model->IsGebruikerIngeschreven($user->id);
            if ($inschrijving == null) {
                $data['inschrijving'] = null;
            } else {
                $data['inschrijving'] = $inschrijving;
            }
        }
        
        $data['title'] = 'IC Clear - Beheer';
        $data['active'] = 'admin';
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sessies/keur_overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
      
    //lijst van alle ongekeurde sessies
    public function lijst() {
        $this->load->model('sessies_model');
        $data['sessies'] = $this->sessies_model->getAllOngekeurdeMetSpreker();
        $this->load->view('admin/sessies/lijst_voorstellen', $data);
    }

    
    //details per sessie
    public function toonDetails($sessieId) {
        $data['user'] = $this->authex->getUserInfo();

        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - Beheer';
        $data['active'] = 'admin';

        $this->load->model('sessies_model');
        $data['sessie'] = $this->sessies_model->get($sessieId);

        $this->load->view('admin/sessies/keur_detail', $data);
    }
    
    //sessies goedkeuren
    public function goedkeuren() {
        $id = $this->input->post('id');
        $data['user'] = $this->authex->getUserInfo();

        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - Beheer';
        $data['active'] = 'admin';

        $this->load->model('sessies_model');
        $this->load->model('gebruiker_model');

        $sessie = $this->sessies_model->get($id);

        // Sessie goedkeuren
        $sessie->isGoedgekeurd = 1;      

        $this->sessies_model->update($sessie);

        $generatedKey = sha1(mt_rand(10000, 99999) . time() . $sessie->spreker->emailadres);
        $this->sendmail($sessie->spreker->emailadres, $sessie->spreker->id, $generatedKey);

        // Gebruiker veranderen naar type 2 (spreker)
        $gebruiker->generatedKey = $generatedKey;
        $gebruiker->id = $sessie->spreker->id;
        $gebruiker->typeId = 2;
        
        $this->gebruiker_model->update($gebruiker);

        redirect('sessies/keuren');
    }
    
    //sessies afkeuren
    public function afkeuren() {
        $id = $this->input->post('id');
        $this->load->model('sessies_model');
        $deleted = $this->sessies_model->delete($id);
        echo $deleted;
    }

    // Mail sturen naar de spreker na het goedkeuren van een sessievoorstel
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
    
    //details per sessie
    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('sessies_model');
        $sessie = $this->sessies_model->get($id);

        echo json_encode($sessie);
    }

    //sessie wijzigen
    public function update() {
        $sessie->id = $this->input->post('id');
        $sessie->onderwerp = $this->input->post('onderwerp');
        $sessie->omschrijving = $this->input->post('omschrijving');

        $this->load->model('sessies_model');
        $this->sessies_model->update($sessie);


        echo $id;
    }

    //sessie verwijderen
    public function delete() {
        $id = $this->input->post('id');

        $this->load->model('sessies_model');
        $deleted = $this->sessies_model->delete($id);

        echo $deleted;
    }
    
}

 
 
