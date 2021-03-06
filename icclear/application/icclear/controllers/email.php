<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email extends CI_Controller {

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

        $data['title'] = 'IC Clear - Emails';
        $data['active'] = 'admin';

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/email/opstellen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    
    //email verzenden naar 1 persoon met standaard onderwerp per conferentie waarbij je emailadressen manueel moet ingeven
    public function verzend() {
        $onderwerp = $this->input->post('onderwerp');
        $ontvanger = $this->input->post('ontvanger');
        $inhoud = $this->input->post('inhoud');
        $conferentie = $this->session->userdata('conferentie');

        $subject = $conferentie . ' - ' . $onderwerp;

        $this->email->from('donotreply@thomasmore.be');
        $this->email->to($ontvanger);
        $this->email->subject($subject);
        $this->email->message($inhoud);
        $this->email->send();

        redirect('admin/index');
    }

    //email verzenden naar 1 gebruiker
    public function verzenden() {               
        $onderwerp = $this->input->post('onderwerp');
        $inhoud = $this->input->post('boodschap');        
        $ontvanger = $this->input->post('emailadreszend');
        
        $this->email->from('donotreply@thomasmore.be');
        $this->email->to($ontvanger);
        $this->email->subject($onderwerp);
        $this->email->message($inhoud);
        $this->email->send();
    }

    //emails versturen naar alle gebruikers in 1 keer
    public function verzendenAlle() {
        $this->load->model('gebruiker_model');
        $gebruikers = $this->gebruiker_model->getAll();

        $onderwerp = $this->input->post('onderwerpall');
        $inhoud = $this->input->post('boodschapall');
        $this->email->message($inhoud);

        foreach ($gebruikers as $g) {
            $ontvanger = $g->emailadres;
            $this->email->from('donotreply@thomasmore.be');
            $this->email->to($ontvanger);
            $this->email->subject($onderwerp);
            $this->email->send();
        }
    }
    
   //Gebruiker updaten
    public function update() {
        $gebruiker->id = $this->input->post('id');
        $gebruiker->voornaam = $this->input->post('voornaam');
        $gebruiker->familienaam = $this->input->post('familienaam');
        $gebruiker->geboortedatum = $this->input->post('geboortedatum');
        $gebruiker->emailadres = $this->input->post('emailadres');
        $gebruiker->geslacht = strtolower($this->input->post('geslacht'));
        $gebruiker->typeId = $this->input->post('type');
        $gebruiker->landId = $this->input->post('land');
        $gebruiker->gemeente = $this->input->post('gemeente');
        $gebruiker->postcode = $this->input->post('postcode');
        $gebruiker->straat = $this->input->post('straat');
        $gebruiker->nummer = $this->input->post('nummer');

        $this->load->model('gebruiker_model');
        if ($gebruiker->id == 0) {
            $id = $this->gebruiker_model->insert($gebruiker);
        } else {
            $this->gebruiker_model->update($gebruiker);
        }

        echo $id;
    }

}
