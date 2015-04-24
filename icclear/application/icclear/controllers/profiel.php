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

        $data['user'] = $this->authex->getUserInfo();
        $data['conferentieId'] = $this->session->userdata('conferentieId');

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
        
        $this->load->model('inschrijving_model');
        $data['inschrijving'] = $this->inschrijving_model->getInschijvingByConferentie($user->id);       
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        
        $diff = abs(strtotime($data['inschrijving']->conferentie->beginDatum) - strtotime($data['inschrijving']->datum));

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        
        $diff = ($data['inschrijving']->datum - $data['inschrijving']->conferentie->beginDatum );
        if ($diff >= 30)
        {
            print_r('korting ' . $years . ' ' . $months . ' ' . $days);
        } else {
            print_r('geen korting ' . $years . ' ' . $months . ' ' . $days . '  ' . $data['inschrijving']->conferentie->beginDatum . ' ' . $data['inschrijving']->datum);
        }
        
        $this->load->model('gebruiker_activiteit_model');
        $data['geld'] = $this->gebruiker_activiteit_model->getPrijsByGebruiker($user->id) + $data['inschrijving']->confonderdeel->prijs;
                
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'gebruiker/wijzigen', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
