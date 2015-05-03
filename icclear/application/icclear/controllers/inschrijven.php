<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inschrijven extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
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

        $data['title'] = 'IC Clear - Inschrijven';
        $data['active'] = 'inschrijven';

        $this->load->model('onderdeel_model');
        $data['conferentieOnderdelen'] = $this->onderdeel_model->getOnderdelenPerConferentie();
        $data['onderdelen'] = $this->onderdeel_model->getOnderdelenActieve();

        $this->load->model('activiteit_model');
        $data['activiteiten'] = $this->activiteit_model->getActiviteitenPerConferentie();

        $this->load->model('betalingtype_model');
        $data['betaaltypes'] = $this->betalingtype_model->getAll();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'inschrijving/inschrijving', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    //Inschrijven voor conferentie zonder reeds ingelogd te zijn
    //Data van inschrijvingsformulier in sessie plaatsen
    //Doorverwijzen naar pagina om in te loggen/te registeren
    public function aanmeldenEnVerzenden() {  
        //Algemene informatie nodig voor de pagina
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;
        $data['title'] = 'IC Clear - Inschrijven';
        $data['active'] = 'inschrijven';        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
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
        
        $this->load->model('conferentie_model');
        $conf = $this->conferentie_model->getActieveConferentie();
        
        $betId = 0;
        $inschrijving->sconferentieId = $conf->id;
        $inschrijving->sconferentieOnderdeelId = $this->input->post('conferentieOnderdeelId');
        $inschrijving->sdatum = date("Y-m-d");
        $inschrijving->smethodeId = $this->input->post('methode');
        if ($betId != 0) {
            $inschrijving->sbetalingId = $betId;
        }  
        $inschrijving->swiltFactuur = 0;
        if ($this->input->post('factuur')) {
            $inschrijving->swiltFactuur = 1;
        }
        
        $acti = array();
        $actiPer = array();
        $act = array();
        $act = $this->input->post('aanwezig');
        if ($act){
            foreach ($act as $a) {
                array_push($acti, $a);
                array_push($actiPer, $this->input->post($a));
            }
        }
        $this->session->set_userdata('Pers',$actiPer);
        $this->session->set_userdata('ActId',$acti);
        $this->session->set_userdata($inschrijving);         
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'inschrijving/aanmelden', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    //Reeds ingelogd op website
    //Inschrijving verwerken
    public function verzenden() {

        $data['user'] = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Inschrijven';
        $data['active'] = 'home';

        $this->load->model('conferentie_model');
        $conf = $this->conferentie_model->getActieveConferentie();

        $userId = $this->authex->getUserInfo();
        $betId = 0;
        if ($this->input->post('methode') != 4) {
            $betaling->gebruikerId = $userId->id;
            $this->load->model('betaling_model');
            $betId = $this->betaling_model->insert($betaling);
        }

        $inschrijving->gebruikerId = $userId->id;
        $inschrijving->conferentieId = $conf->id;
        $inschrijving->conferentieOnderdeelId = $this->input->post('conferentieOnderdeelId');
        $inschrijving->datum = date("Y-m-d");
        $inschrijving->methodeId = $this->input->post('methode');
        if ($betId != 0) {
            $inschrijving->betalingId = $betId;
        }
        $inschrijving->wiltFactuur = 0;
        if ($this->input->post('factuur')) {
            $inschrijving->wiltFactuur = 1;
        }

        $this->load->model('inschrijving_model');
        $this->inschrijving_model->insert($inschrijving);

        $teller = 1;
        $act = $this->input->post('aanwezig');
        foreach ($act as $a) {
            $activiteit->activiteitId = $a;
            $activiteit->gebruikerId = $userId->id;
            if ($betId != 0) {
                $activiteit->betalingId = $betId;
            }

            $activiteit->aantalPersonen = $this->input->post($a);

            $this->load->model('gebruiker_activiteit_model');
            $actId = $this->gebruiker_activiteit_model->insert($activiteit);
        }

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        redirect('home');
    }

    public function opvolgen() {

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
        $data['gebruikers'] = $this->gebruiker_model->getAll();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/inschrijving/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function overzicht() {
        $data['conferentieId'] = $this->session->userdata('conferentieId');

        $this->load->model('inschrijving_model');
        $data['inschrijvingen'] = $this->inschrijving_model->getAllInschijvingByConferentie($data['conferentieId']);

        $this->load->model('gebruiker_activiteit_model');
        $data['gebactiviteiten'] = $this->gebruiker_activiteit_model->getActiviteitPrijs();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $this->load->model('gebruiker_activiteit_model');
        foreach ($data['inschrijvingen'] as $i) {
            $confId = $data['conferentieId'];
            $diff = (abs(strtotime($i->conferentie->beginDatum) - strtotime($i->datum))) / 86400;
            if ($diff >= 30) {
                $confprijs = $i->confonderdeel->prijs - (($i->confonderdeel->prijs / 100) * $i->confonderdeel->korting);
            } else {
                $confprijs = $i->confonderdeel->prijs;
            }

            $i->geld += $this->gebruiker_activiteit_model->getPrijsByConfGebruiker($i->gebruikerId, $confId) + $confprijs;
        }

        $this->load->view('admin/inschrijving/lijst', $data);
    }

    public function detail() {
        $id = $this->input->get('id');

        $data;

        echo json_encode($data);
    }
    
    //Na inschrijving invullen, kiest men om in te loggen
    //Nadat men met success inlogt, moeten de gegevens die werden opgeslagen verwerkt worden tot een inschrijving
    public function aanmelden() {
        $email = $this->input->post('emaillogon');
        $password = $this->input->post('passwordlogon');

        //is geactiveerd
        $this->load->model('logon_model');
        $actCheck = $this->logon_model->isGeactiveerd($email);
        if ($this->authex->login($email, sha1($password))) {            
            
            $user = $this->authex->getUserInfo();
            
            //Verwerken van het inschrijven
            $this->verwerkenInschrijving($user);
        
            redirect('inschrijven/voorkeuren');
        } else if ($actCheck == flogonalse) {
            redirect('logon/nietGeactiveerd');
        } else {
            redirect('logon/fout');
        }
    }
    
    //Na inschrijving invullen, kiest men om te registreren
    //Nadat men met success registreert, moeten de gegevens die werden opgeslagen verwerkt worden tot een inschrijving
    //Gebruiker krijgt geen activatie mail
    public function registreer() {
        //Eerst nieuwe gebruiker registreren
        $email = $this->input->post('emailadres');
        $genkey = sha1(mt_rand(10000, 99999) . time() . $email);
        $user = new stdClass();

        $user->familienaam = $this->input->post('familienaam');
        $user->voornaam = $this->input->post('voornaam');
        $user->email = $email;
        $user->wachtwoord = $this->input->post('wachtwoord1');
        $user->geslacht = $this->input->post('geslacht');

        $user->id = $this->authex->register($user);
        
        //Verwerken van het inschrijven
        $this->verwerkenInschrijving($user);

        redirect('inschrijven/voorkeuren');
    }
    
    //Voorkeuren doorgeven door persoon die zich net heeft ingeschreven
    public function voorkeuren() {        
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
        $data['active'] = 'inschrijven';
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'inschrijving/voorkeuren', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    

    public function verwerkenInschrijving($user) {
        $betId = 0;
        //Controleren of het geen overschrijving is. Geen overschrijving = betaling verwerken
        if ($this->session->userdata('smethodeId') != 4) {
            $betaling->gebruikerId = $user->id;
            $this->load->model('betaling_model');
            $betId = $this->betaling_model->insert($betaling);
        }
        //Inschrijf gegevens uit session halen
        $inschrijving->gebruikerId = $user->id;
        $inschrijving->conferentieId = $this->session->userdata('sconferentieId');
        $inschrijving->conferentieOnderdeelId = $this->session->userdata('sconferentieOnderdeelId');
        $inschrijving->datum = $this->session->userdata('sdatum');
        $inschrijving->methodeId = $this->session->userdata('smethodeId');
            $inschrijving->wiltFactuur = $this->session->userdata('swiltFactuur');
        //Als het geen overschrijving is, betaling linken
        if ($betId != 0) {
            $inschrijving->betalingId = $betId;
        }

        $this->load->model('inschrijving_model');
        $this->inschrijving_model->insert($inschrijving);

        $Pers = $this->session->userdata('Pers');
        $Acts = $this->session->userdata('ActId');
        $i = 0;
        foreach ($Acts as $a) {
            $activiteit->activiteitId = $a;
            $activiteit->gebruikerId = $user->id;
            if ($betId != 0) {
                $activiteit->betalingId = $betId;
            }
            $activiteit->aantalPersonen = $Pers[$i];
            $this->load->model('gebruiker_activiteit_model');
            $actId = $this->gebruiker_activiteit_model->insert($activiteit);

            $i++;
        }
        
    }
    
}


?>