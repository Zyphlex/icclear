<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profiel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        if (!$this->authex->loggedIn()) {
            redirect('logon/aanmelden');
        }
    }

    public function wijzig($id) {

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

        $this->load->model('gebruiker_model');
        $data['gebruiker'] = $this->gebruiker_model->get($id);

        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebruiker/wijzigen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function update() {
        $gebruiker = new stdClass();

        $gebruiker->id = $this->input->post('id');
        $gebruiker->voornaam = $this->input->post('voornaam');
        $gebruiker->familienaam = $this->input->post('familienaam');
        $gebruiker->geboortedatum = $this->input->post('geboortedatum');
//        $gebruiker->emailadres = $this->input->post('emailadres');
        $gebruiker->geslacht = $this->input->post('geslacht');
//        $gebruiker->typeId = $this->input->post('type');
        $gebruiker->landId = $this->input->post('land');
        $gebruiker->gemeente = $this->input->post('gemeente');
        $gebruiker->postcode = $this->input->post('postcode');
        $gebruiker->straat = $this->input->post('straat');
        $gebruiker->nummer = $this->input->post('huisnummer');

        $this->load->model('gebruiker_model');

        $this->gebruiker_model->update($gebruiker);

        redirect('profiel/instellingen');
    }

    public function instellingen() {
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;

        $data['title'] = 'IC Clear - Profielinstellingen';
        $data['active'] = '';

        $this->load->model('gebruiker_model');
        $data['gebruiker'] = $this->gebruiker_model->get($user->id);

        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();

        //Kijken of user reeds is ingeschreven, als dit zo is, knop verbergen op view
        $this->load->model('inschrijving_model');
        if ($user == null) {
            $data['inschrijving'] = null;
        } else {
            $data['inschrijvingen'] = $this->inschrijving_model->getInschijvingByGebruiker($user->id);
            $inschrijving = $this->inschrijving_model->IsGebruikerIngeschreven($user->id);
            if ($inschrijving == null) {
                $data['inschrijving'] = null;
            } else {
                $data['inschrijving'] = $inschrijving;
            }
        }

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $this->load->model('gebruiker_activiteit_model');
        foreach ($data['inschrijvingen'] as $i) {
            $confId = $i->confonderdeel->conferentieId;
            $diff = (abs(strtotime($i->conferentie->beginDatum) - strtotime($i->datum))) / 86400;
            if ($diff >= 30) {
                $confprijs = $i->confonderdeel->prijs - (($i->confonderdeel->prijs / 100) * $i->confonderdeel->korting);
            } else {
                $confprijs = $i->confonderdeel->prijs;
            }

            $i->geld += $this->gebruiker_activiteit_model->getPrijsByConfGebruiker($user->id, $confId) + $confprijs;
        }


        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'gebruiker/wijzigen', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('inschrijving_model');
        $inschrijving = $this->inschrijving_model->getInschrijving($id);

        echo json_encode($inschrijving);
    }
        
    public function overzicht() {
        $id = $this->input->get('id');
        
        $this->load->model('inschrijving_model');
        $inschrijving = $this->inschrijving_model->get($id);
        
        $this->load->model('activiteit_model');
        $data['act'] = $this->activiteit_model->getAllActGebruikerConf($inschrijving->gebruikerId,$inschrijving->conferentieId);

        $this->load->view('gebruiker/lijst', $data);
    }
    
    public function wijzigWachtwoord() {        
        $user = $this->authex->getUserInfo();
        $pass = $this->input->post('bevestigwwN');
        $this->load->model('logon_model');
        $this->logon_model->changePassUser($pass,$user->id);
        
        redirect('instellingen');
    }
    

}

 
 
