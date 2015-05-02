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
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;
        
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
        $data['verleden'] = $this->conferentie_model->getVerledenConferentie();
        $data['toekomenden'] = $this->conferentie_model->getToekomstConferentie();
        $data['conferentieId'] = null;

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/beheer', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function dashboard($id) {
        $this->session->set_userdata('conferentieId', $id);

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

        $data['title'] = 'IC Clear - Dashboard';
        $data['active'] = 'admin';

        $this->load->model('conferentie_model');
        $conferentie = $this->conferentie_model->get($id);
        $data['conferentie'] = $conferentie;
        $data['actieveconf'] = $this->conferentie_model->getActieveConferentie();
        
        $this->load->model('status_model');
        $data['status'] = $this->status_model->get($conferentie->statusId);
        $data['statussen'] = $this->status_model->getAll();

        $this->load->model('inschrijving_model');
        $data['aantalInschrijvingen'] = $this->inschrijving_model->getCountByConferentie($id);

        $this->load->model('sessies_model');
        $data['ongekeurdeSessies'] = $this->sessies_model->countOngekeurde($id);
        $data['gekeurdeSessies'] = $this->sessies_model->countGekeurde($id);

        $this->load->model('activiteit_model');
        $data['activiteiten'] = $this->activiteit_model->countActiviteiten($id);

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/dashboard', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function wijzigStatus() {        
        $confId = $this->session->userdata('conferentieId');
        $this->load->model('conferentie_model');  
        $conf = $this->conferentie_model->getActieveConferentie();
        
        //Huidig actieve conferentie veranderen naar "Afgelopen" of "Toekomstig" op basis van beginDatum
        $oudconferentie->id = $conf->id;
        if ($conf->beginDatum > date("Y-m-d")) { //Als conferentiedatum groter is dan huidige datum
            $oudconferentie->statusId = 3; //toekomstig maken
        } else {
            $oudconferentie->statusId = 1; //afgelopen maken      
        }
        
        $this->conferentie_model->update($oudconferentie);
        
        //Geselecteerde conferentie wijzigen naar "Actief"
        $conferentie->id = $confId;
        $conferentie->statusId = 2;              
        $this->conferentie_model->update($conferentie);
        
        redirect('admin/dashboard/' . $confId);
    }

}

 
 
