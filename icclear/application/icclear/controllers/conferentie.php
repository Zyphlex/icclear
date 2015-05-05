<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conferentie extends CI_Controller {

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

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->get($this->session->userdata('conferentieId'));

        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        $data['inschrijvingen'] = $this->conferentie_model->getAllInschijvingByConferentie($this->session->userdata('conferentieId'));

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/conferentie/wijzigen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function toevoegen() {
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;

        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['title'] = 'IC Clear - Conferentie toevoegen';
        $data['active'] = 'admin';
        
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

        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/conferentie/toevoegen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function nieuwopslaan() {
        //ingevoerde gegevens ophalen
        $conferentie->stad = $this->input->post('stad');
        $conferentie->landId = $this->input->post('land');
        $conferentie->naam = $this->input->post('naam');
        $conferentie->beschrijving = $this->input->post('beschrijving');
        $conferentie->seminarieDag = $this->input->post('seminariedag');
        $conferentie->maxInschrijvingen = $this->input->post('maxinschrijvingen');
        //status is "toekomstig"
        $conferentie->statusId = 3;

        $begindatum = $this->input->post('begindatum');
        $einddatum = $this->input->post('einddatum');
        $conferentie->beginDatum = $begindatum;
        $conferentie->eindDatum = $einddatum;

        $this->load->model('conferentie_model');
        $conferentieId = $this->conferentie_model->insert($conferentie);

        //Alle datums tussen begin en einddatum zoeken
        $datums = $this->getDatumsConferentie($begindatum, $einddatum);
        //Elke datum als conferentiedag toevoegen
        foreach ($datums as $datum){
            $conferentiedag->conferentieId = $conferentieId;
            $conferentiedag->datum = $datum;
            $conferentiedag->gebouwId = null;
            
            $this->load->model('conferentiedag_model');
            $conferentiedagId = $this->conferentiedag_model->insert($conferentiedag);
        }

        redirect('gebouw/gebouwPerDag/' . $conferentieId);
    }

    public function opslaan() {
        $conferentie->id = $this->input->post('id');
        $conferentie->stad = $this->input->post('stad');
        $conferentie->landId = $this->input->post('land');
        $conferentie->naam = $this->input->post('naam');
        $conferentie->beschrijving = $this->input->post('beschrijving');
        $conferentie->seminarieDag = $this->input->post('seminariedag');
        //$conferentie->statusId = $this->input->post('id');
        $conferentie->maxInschrijvingen = $this->input->post('maxinschrijvingen');

        $this->load->model('conferentie_model');
        $this->conferentie_model->update($conferentie);
        echo $id;

        redirect('admin/dashboard/' . $conferentie->id);
    }

    public function overzicht() {
        $this->load->model('conferentie_onderdeel_model');
        $data['onderdelen'] = $this->conferentie_onderdeel_model->getAllConferentie($this->session->userdata('conferentieId'));

        $this->load->view('admin/conferentie/lijst', $data);
    }

    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('conferentie_onderdeel_model');
        $onderdeel = $this->conferentie_onderdeel_model->get($id);

        echo json_encode($onderdeel);
    }

    public function delete($id) {
        $id = $this->input->post('id');

        $this->load->model('conferentie_onderdeel_model');
        $deleted = $this->conferentie_onderdeel_model->delete($id);

        echo $deleted;
    }

    public function update() {
        $onderdeel->id = htmlentities($this->input->post('id'));
        $onderdeel->conferentieId = $this->session->userdata('conferentieId');
        $onderdeel->omschrijving = htmlentities($this->input->post('onderdeel'));
        $onderdeel->prijs = htmlentities($this->input->post('prijs'));
        $onderdeel->korting = htmlentities($this->input->post('korting'));

        //toevoegen als het nog niet bestaat, anders updaten
        $this->load->model('conferentie_onderdeel_model');
        if ($onderdeel->id == 0) {
            $id = $this->conferentie_onderdeel_model->insert($onderdeel);
        } else {
            $this->conferentie_onderdeel_model->update($onderdeel);
        }

        echo $id;
    }

    //Alle datums ophalen tussen de begin- en einddatum
    public function getDatumsConferentie($begindatum, $einddatum) {
        $datums = array();

        //Datums in formaat dd/mm/jjjj zetten
        $startDatum = mktime(1, 0, 0, substr($begindatum, 5, 2), substr($begindatum, 8, 2), substr($begindatum, 0, 4));
        $stopDatum = mktime(1, 0, 0, substr($einddatum, 5, 2), substr($einddatum, 8, 2), substr($einddatum, 0, 4));

        if ($stopDatum >= $startDatum) {
            array_push($datums, date('Y-m-d', $startDatum)); // Eerste invoer
            while ($startDatum < $stopDatum) {
                $startDatum+=86400; // 24 uur er bij doen
                
                array_push($datums, date('Y-m-d', $startDatum));
            }
        }
        return $datums;
    }

}
