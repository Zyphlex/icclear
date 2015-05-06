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
        if ($act) {
            foreach ($act as $a) {
                array_push($acti, $a);
                array_push($actiPer, $this->input->post($a));
            }
        }
        $this->session->set_userdata('Pers', $actiPer);
        $this->session->set_userdata('ActId', $acti);
        $this->session->set_userdata($inschrijving);

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'inschrijving/aanmelden', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    //Reeds ingelogd op website
    //Inschrijving verwerken
    public function verzenden() {
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;
        $data['title'] = 'IC Clear - Inschrijven';
        $data['active'] = 'home';

        $this->load->model('conferentie_model');
        $conf = $this->conferentie_model->getActieveConferentie();

        $betId = 0;
        if ($this->input->post('methode') != 4) {
            $betaling->gebruikerId = $user->id;
            $this->load->model('betaling_model');
            $betId = $this->betaling_model->insert($betaling);
        }

        $inschrijving->gebruikerId = $user->id;
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
            $activiteit->gebruikerId = $user->id;
            if ($betId != 0) {
                $activiteit->betalingId = $betId;
            }

            $activiteit->aantalPersonen = $this->input->post($a);

            $this->load->model('gebruiker_activiteit_model');
            $actId = $this->gebruiker_activiteit_model->insert($activiteit);
        }

        $this->load->model('conferentie_model');
        $conferentie = $this->conferentie_model->getActieveConferentie();

        $this->email->from('donotreply@thomasmore.be');
        $this->email->to($user->emailadres);
        $this->email->subject('Inschrijving voor ' . $conferentie->naam);
        $this->email->message('Beste ' . $user->voornaam . ' ' . $user->familienaam . "\n" . 'Met deze mail bevestigen wij uw inschrijving voor de conferentie  ' . $conferentie->naam . ' die loopt van ' . $conferentie->beginDatum . ' tot ' . $conferentie->eindDatum . '.');
        $this->email->send();

        redirect('inschrijven/voorkeuren');
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

        $this->load->model('betalingtype_model');
        $data['methodes'] = $this->betalingtype_model->getAll();

        $this->load->model('conferentie_onderdeel_model');
        $data['onderdelen'] = $this->conferentie_onderdeel_model->getAllConferentie($data['conferentieId']);

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
            $this->load->model('conferentie_model');
            $conferentie = $this->conferentie_model->getActieveConferentie();

            //Verwerken van het inschrijven
            $this->verwerkenInschrijving($user);
            $this->email->from('donotreply@thomasmore.be');
            $this->email->to($user->email);
            $this->email->subject('Inschrijving voor ' . $conferentie->naam);
            $this->email->message('Beste ' . $user->voornaam . ' ' . $user->familienaam . "\n" . 'Met deze mail bevestigen wij uw inschrijving voor de conferentie  ' . $conferentie->naam . ' die loopt van ' . $conferentie->beginDatum . ' tot ' . $conferentie->eindDatum . '.');
            $this->email->send();

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
        $user = new stdClass();

        $user->familienaam = $this->input->post('familienaam');
        $user->voornaam = $this->input->post('voornaam');
        $user->email = $this->input->post('emailadres');
        $user->wachtwoord = $this->input->post('wachtwoord1');
        $user->geslacht = $this->input->post('geslacht');
        $genkey = sha1(mt_rand(10000, 99999) . time() . $user->email);
        $user->generatedKey = $genkey;

        $user->id = $this->authex->register($user);
        $this->load->model('conferentie_model');
        $conferentie = $this->conferentie_model->getActieveConferentie();

        //Verwerken van het inschrijven
        $this->verwerkenInschrijving($user);
        $this->email->from('donotreply@thomasmore.be');
        $this->email->to($user->email);
        $this->email->subject('Inschrijving voor ' . $conferentie->naam);
        $this->email->message('Beste ' . $user->voornaam . ' ' . $user->familienaam .
                "\n" .
                'Met deze mail bevestigen wij uw inschrijving voor de conferentie  ' . $conferentie->naam . ' die loopt van ' . $conferentie->beginDatum . ' tot ' . $conferentie->eindDatum . '.' .
                "\n" .
                'Klik op onderstaande link om uw registratie te activeren ' . site_url('logon/activeer/' . $genkey));
        $this->email->send();

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

        $this->load->model('sessies_model');
        $data['sessies'] = $this->sessies_model->getPlenaireActief();

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

    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('inschrijving_model');
        $inschrijving = $this->inschrijving_model->get($id);

        echo json_encode($inschrijving);
    }

    public function update() {
        $inschrijving->id = $this->input->post('id');
        $inschrijving->gebruikerId = $this->input->post('gebruiker');
        $inschrijving->conferentieOnderdeelId = $this->input->post('confonderdeel');
        $inschrijving->methodeId = $this->input->post('methode');

        $this->load->model('betaling_model');

        $this->load->model('inschrijving_model');
        if ($inschrijving->id == 0) {
            $id = $this->inschrijving_model->insert($inschrijving);
            if ($inschrijving->methodeId != 4) {
                $this->betaling_model->insert($inschrijving->gebruikerId);
            }
        } else {
            if ($inschrijving->methodeId != 4) {
                $this->betaling_model->insert($inschrijving->gebruikerId);
            }
            $this->inschrijving_model->update($inschrijving);
        }

        echo $id;
    }

    public function delete() {
        $id = $this->input->post('id');
        $this->load->model('inschrijving_model');
        $inschrijving = $this->inschrijving_model->get($id);

        $this->inschrijving_model->delete($id);

        if ($inschrijving->betalingId != null) {

            $this->load->model('betaling_model');
            $this->betaling_model->delete($inschrijving->betalingId);
        }
    }

    public function prijsAct() {
        $id = $this->input->post('id');

        $this->load->model('activiteit_model');
        $act = $this->activiteit_model->get($id);

        echo json_encode($act);
    }

    public function prijsOnd() {
        $id = $this->input->post('id');

        $this->load->model('conferentie_onderdeel_model');
        $ond = $this->conferentie_onderdeel_model->get($id);

        echo json_encode($ond);
    }

}

?>