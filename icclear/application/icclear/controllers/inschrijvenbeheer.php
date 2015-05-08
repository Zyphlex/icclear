<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inschrijvenbeheer extends CI_Controller {

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
        $data['gebruikers'] = $this->gebruiker_model->getAllWithType();

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

    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('inschrijving_model');
        $inschrijving = $this->inschrijving_model->get($id);

        echo json_encode($inschrijving);
    }

    public function update() {
        $this->load->model('inschrijving_model');
        $this->load->model('betaling_model');

        $inschrijving->id = $this->input->post('id');
        $id = $inschrijving->id;
        $inschrijving->conferentieOnderdeelId = $this->input->post('confonderdeel');
        $inschrijving->methodeId = $this->input->post('methode');
        $betaald = $this->input->post('betaling');

        $oud = $this->inschrijving_model->get($id);

        if ($oud->betalingId == null && $betaald == "ja") {
            $betaling->id = 0;
            $betaling->gebruikerId = $inschrijving->gebruikerId;
            $inschrijving->betalingId = $this->betaling_model->insert($betaling);
        }

        $this->inschrijving_model->update($inschrijving);
    }

    public function delete() {
        $id = $this->input->post('id');
        $this->load->model('inschrijving_model');
        $inschrijving = $this->inschrijving_model->get($id);

        $this->load->model('gebruiker_activiteit_model');
        $this->gebruiker_activiteit_model->delete($inschrijving->gebruikerId);

        $this->inschrijving_model->delete($id);

        if ($inschrijving->betalingId != null) {

            $this->load->model('betaling_model');
            $this->betaling_model->delete($inschrijving->betalingId);
        }
    }

    public function actDetail() {
        $id = $this->input->get('id');

        $this->load->model('inschrijving_model');
        $inschrijving = $this->inschrijving_model->get($id);

        $this->load->model('activiteit_model');
        $data['act'] = $this->activiteit_model->getAllActGebruikerConf($inschrijving->gebruikerId, $inschrijving->conferentieId);

        $this->load->view('admin/inschrijving/details', $data);
    }

}

?>
