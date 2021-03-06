<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Spreker extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
    }

    public function index() {
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;
        $data['title'] = 'IC Clear - Sprekers';
        $data['active'] = 'spreker';
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

        $this->load->model('gebruiker_model');
        $data['sprekers'] = $this->gebruiker_model->getSprekersActieve();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'spreker/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    //opent pagina waar je een voorstel kan indienen
    public function voorstel() {

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

        $data['title'] = 'IC Clear - Sprekers';
        $data['active'] = 'programma';

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'spreker/voorstel', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    //Indienen voorstel als je al bent aangemeld
    public function indienen() {
        $this->load->model('conferentie_model');
        $user = $this->authex->getUserInfo();
        $conferentie = $this->conferentie_model->getActieveConferentie();

        // Sessie aan database toevoegen
        $sessie = new stdClass();
        $sessie->onderwerp = $this->input->post('sessieonderwerp');
        $sessie->omschrijving = $this->input->post('sessieomschrijving');
        $sessie->datumIngediend = date('Y-m-d');
        $sessie->isGoedgekeurd = '0';
        $sessie->gebruikerIdSpreker = $user->id;
        $sessie->conferentieId = $conferentie->id;

        $this->load->model('sessies_model');
        $this->sessies_model->insert($sessie);

        // Bevestigingsmail sturen naar spreker
        $this->email->from('donotreply@thomasmore.be');
        $this->email->to($user->email);
        $this->email->subject('Inschrijving voor ' . $conferentie->naam);
        $this->email->message('Beste ' . $user->voornaam . ' ' . $user->familienaam .
                "\n" .
                'Met deze mail bevestigen wij uw voorstel van voor de conferentie  ' . $conferentie->naam . '.' .
                'U ontvangt een bericht zodra uw voorstel is goedgekeurd of afgekeurd.');
        $this->email->send();

        redirect('spreker');
    }

    public function biografie($id, $key) {
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;

        $data['title'] = 'IC Clear - Biografie';
        $data['active'] = 'spreker';
        
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

        $this->load->model('gebruiker_model');
        $spreker = $this->gebruiker_model->get($id);
        $data['spreker'] = $spreker;

        if ($id == $spreker->id && $key == $spreker->generatedKey) {
            $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'spreker/biografie', 'footer' => 'main_footer');
        } else {
            $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'spreker/error', 'footer' => 'main_footer');
        }
        $this->template->load('main_master', $partials, $data);
    }
    
    //biografie wijzigen
    public function updateBiografie() {
        $data['user'] = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Biografie';
        $data['active'] = 'spreker';

        $id = $this->session->userdata('user_id');

        $this->load->model('gebruiker_model');
        $spreker = $this->gebruiker_model->get($id);

        // biografie
        $biografie = $this->input->post("biografie");

        // foto
        $config['upload_path'] = './application/upload/fotos/sprekers';
        $config['allowed_types'] = 'jpg';
        $config['file_name'] = 'spreker' . $spreker->id . '.jpg';
        $config['max_size'] = 200;
        $config['max_height'] = 250;
        $config['max_width'] = 250;
        $config['overwrite'] = true;

        // Map aanmaken als deze nog niet bestaat
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        // Uploaden
        $this->load->library('upload', $config);
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
        
        $this->upload->initialize($config);

        $fieldname = 'userfile';

        if (!$this->upload->do_upload($fieldname)) {
            $error = array('error' => $this->upload->display_errors());
            echo print_r($config);
            echo print_r($error);
            echo realpath($config['upload_path']);
        }

        $spreker->biografie = $biografie;
        $spreker->foto = $config['file_name'];

        $this->gebruiker_model->update($spreker);

        redirect('profiel/instellingen');
    }

    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('gebruiker_model');
        $spreker = $this->gebruiker_model->getSpreker($id);

        echo json_encode($spreker);
    }
    
     public function detailMetSpreker() {
    }

    //Men wilt voorstel versturen zonder aangemeld te zijn
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

        $voorstel->sconferentieId = $conf->id;
        $voorstel->sonderwerp = $this->input->post('sessieonderwerp');
        $voorstel->sdatumIngediend = date("Y-m-d");
        $voorstel->somschrijving = $this->input->post('sessieomschrijving');

        $this->session->set_userdata($voorstel);

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'spreker/aanmelden', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    //Na inschrijving invullen, kiest men om in te loggen
    //Nadat men met success inlogt, moeten de gegevens die werden opgeslagen verwerkt worden tot een inschrijving
    public function aanmelden() {
        $email = strtolower($this->input->post('emaillogon'));
        $password = $this->input->post('passwordlogon');

        //is geactiveerd
        $this->load->model('logon_model');
        $actCheck = $this->logon_model->isGeactiveerd($email);
        if ($this->authex->login($email, sha1($password))) {

            $user = $this->authex->getUserInfo();
            $this->load->model('conferentie_model');
            $conferentie = $this->conferentie_model->getActieveConferentie();

            //Verwerken van het inschrijven
            $this->verwerkenVoorstel($user);
            $this->email->from('donotreply@thomasmore.be');
            $this->email->to($user->email);
            $this->email->subject('Inschrijving voor ' . $conferentie->naam);
            $this->email->message('Beste ' . $user->voornaam . ' ' . $user->familienaam .
                    "\n" .
                    'Met deze mail bevestigen wij uw voorstel van voor de conferentie  ' . $conferentie->naam . '.' .
                    'U ontvangt een bericht zodra uw voorstel is goedgekeurd of afgekeurd.');
            $this->email->send();

            redirect('home');
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
        $user = new stdClass();

        $user->familienaam = $this->input->post('familienaamV');
        $user->voornaam = $this->input->post('voornaamV');
        $user->email = strtolower($this->input->post('emailadresV'));
        $user->wachtwoord = $this->input->post('wachtwoord1V');
        $user->geslacht = $this->input->post('geslachtV');
        $genkey = sha1(mt_rand(10000, 99999) . time() . $user->email);
        $user->generatedKey = $genkey;

        $user->id = $this->authex->register($user);
        $this->load->model('conferentie_model');
        $conferentie = $this->conferentie_model->getActieveConferentie();

        //Verwerken van het inschrijven
        $this->verwerkenVoorstel($user);
        $this->email->from('donotreply@thomasmore.be');
        $this->email->to($user->email);
        $this->email->subject('Inschrijving voor ' . $conferentie->naam);
        $this->email->message('Beste ' . $user->voornaam . ' ' . $user->familienaam .
                "\n " .
                'Met deze mail bevestigen wij uw voorstel voor de conferentie  ' . $conferentie->naam . ' die loopt van ' . $conferentie->beginDatum . ' tot ' . $conferentie->einddatum . '.' .
                'U ontvangt een bericht zodra uw voorstel is goedgekeurd of afgekeurd.' .
                "\n " .
                'Klik op onderstaande link om uw registratie te activeren ' . '\n' . '\n ' . site_url('logon/activeer/' . $genkey));
        $this->email->send();

        redirect('home');
    }

    public function verwerkenVoorstel($user) {
        //Voorstel gegevens uit session halen            
        $voorstel->gebruikerIdSpreker = $user->id;
        $voorstel->conferentieId = $this->session->userdata('sconferentieId');
        $voorstel->onderwerp = $this->session->userdata('sonderwerp');
        $voorstel->datumIngediend = $this->session->userdata('sdatumIngediend');
        $voorstel->omschrijving = $this->session->userdata('somschrijving');
        $voorstel->isGoedgekeurd = '0';

        $this->load->model('sessies_model');
        $this->sessies_model->insert($voorstel);
    }

}

?>