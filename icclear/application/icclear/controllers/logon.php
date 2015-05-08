<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logon extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('email');
    }

    public function login() {
        $data['user'] = $this->authex->getUserInfo();

        $this->load->view('logon/login', $data);
    }

    //Gewoon aanmelden
    public function aanmelden() {
        $email = strtolower($this->input->post('email'));
        $password = $this->input->post('password');

        //is geactiveerd
        $this->load->model('logon_model');
        $actCheck = $this->logon_model->isGeactiveerd($email);
        if ($this->authex->login($email, sha1($password))) {
            redirect('home');
        } else if ($actCheck == flogonalse) {
            redirect('logon/nietGeactiveerd');
        } else {
            redirect('logon/fout');
        }
    }

    //Er is een fout bij het aanmelden
    public function fout() {
        $data['title'] = 'IC Clear - Fout';
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

        $data['active'] = '';
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/fout', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    //wachtwoord vergeten
    public function vergeten() {
        $data['user'] = '';
        $this->load->view('logon/wwvergeten', $data);
    }

    //uitloggen
    public function logout() {
        $this->authex->logout();
        redirect('home');
    }

    //registreren
    public function register() {
        $data['user'] = '';

        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();

        $this->load->view('logon/registreer', $data);
    }

    //gebruiker toevoegen aan database en email versturen
    public function add() {
        $email = strtolower($this->input->post('emailadres'));
        $genkey = sha1(mt_rand(10000, 99999) . time() . $email);
        $user = new stdClass();

        $user->familienaam = $this->input->post('familienaam');
        $user->voornaam = $this->input->post('voornaam');
        $user->email = $email;
        $user->wachtwoord = $this->input->post('wachtwoord1');
        $user->geslacht = $this->input->post('geslacht');
        $user->generatedKey = $genkey;

        $id = $this->authex->register($user);
        if ($id != 0) {
            $this->sendmail($user->email, $user->generatedKey);
            $this->klaar();
        } else {
            $this->bestaat();
        }
    }
    //nieuw passwoord instellen
    public function nieuwPass() {
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
        
        $data['active'] = '';
        $data['title'] = 'IC Clear - Wachtwoord aangepast';

        $wachtwoord = $this->input->post('wachtwoord');
        $generatedKey = $this->input->post('key');

        $this->authex->nPass($wachtwoord, $generatedKey);

        $newKey = sha1(mt_rand(10000, 99999) . time() . $wachtwoord);
        $this->authex->updateKey($generatedKey, $newKey);

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/ww_succes', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    //paswoord resetten
    public function passReset($generatedKey) {
        $this->load->model('logon_model');

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
        
        $data['generatedKey'] = $generatedKey;
        $data['title'] = 'IC Clear - Register';
        $data['active'] = '';

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        if ($this->logon_model->correct($generatedKey) == false) {
            $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/foutKey', 'footer' => 'main_footer');
        } else {
            $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/newPass', 'footer' => 'main_footer');
        }
        $this->template->load('main_master', $partials, $data);
    }

    //wat er gebeurt als gebruiker nog niet geactiveerd is
    public function nietGeactiveerd() {
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
        $data['title'] = 'IC Clear - Account niet geactiveerd';
        $data['active'] = '';

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/nietActief', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    //wat er gebeurt als emailadres al bestaat
    public function bestaat() {
        $data['title'] = 'IC Clear - Register';
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
        $data['active'] = '';

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/user_bestaat', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    //Een account is met success aangemaakt
    public function klaar() {
        $data['title'] = 'IC Clear - Register';
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
        $data['active'] = '';

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/user_klaar', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    //Zoeken of een username al bestaat
    //Niet meer nodig
    public function ajax() {
        $zoekstring = $this->input->get('zoekstring');
        $this->load->model('logon_model');
        $this->logon_model->user_exists($zoekstring);
    }

    //Een user laten activeren via een key die ze in een mail ontvingen
    public function activeer($generatedKey) {
        $data['title'] = 'Succesvol geactiveerd';

        //Activeren met de key
        $this->authex->activate($generatedKey);

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
        $data['active'] = '';

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/user_geactiveerd', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    // Mail sturen zodat nieuwe ghebruikers hun account kunnen activeren
    private function sendmail($to, $generatedKey) {
        $this->email->from('donotreply@thomasmore.be');
        $this->email->to($to);
        $this->email->subject('Geregistreerd bij IC Clear');
        $this->email->message('U bent geregistreerd! Klik op onderstaande link om uw registratie te activeren ' . "\n" . "\n " . site_url("logon/activeer/$generatedKey"));
        $this->email->send();
    }

    //Wachtwoord resetten via de "wachtwoord vergeten optie"
    public function resetPass() {

        $data['active'] = '';
        $data['title'] = 'IC Clear - Email verzonden';

        $email = strtolower($this->input->post('emailVergeten'));
        $generatedKey = sha1(mt_rand(10000, 99999) . time() . $email);

        $this->authex->new_genKey($email, $generatedKey);

        $this->email->from('donotreply@thomasmore.be');
        $this->email->to($email);
        $this->email->subject('Paswoord resetten - IC Clear');
        $this->email->message('Klik op onderstaande link als u uw wachtwoord wilt resetten. ' . "\n" . "\n " . site_url("logon/passReset/$generatedKey"));
        $this->email->send();

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

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/verzonden', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    function check_email_availablity() {
        $this->load->model('email_model');
        $email = trim($this->input->post('email'));
        $result = $this->email_model->check_email_availablity($email);
        print_r($result);
        if (!$result) {
            echo 0;
        } else {
            echo 1;
        }
    }

}

 
 
