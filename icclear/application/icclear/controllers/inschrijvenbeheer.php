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

        //toont een overzicht van de gebruikers die ingeschreven zijn voor de geselecteerde conferentie 
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
    
    //toont overzicht van alle inschrijvingen die aan te passen zijn
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

    //toont details van elke inschrijving
    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('inschrijving_model');
        $inschrijving = $this->inschrijving_model->get($id);

        echo json_encode($inschrijving);
    }

    //functie om inschrijving te updaten
    public function update() {
        $confId = $this->session->userdata('conferentieId');
        
        $this->load->model('inschrijving_model');
        $this->load->model('betaling_model');
        $this->load->model('activiteit_model');
        $this->load->model('gebruiker_activiteit_model');

        $inschrijving->id = $this->input->post('id');
        $id = $inschrijving->id;
        $inschrijving->gebruikerId = $this->input->post('gebruikerId');
        $inschrijving->conferentieOnderdeelId = $this->input->post('confonderdeel');
        $inschrijving->methodeId = $this->input->post('methode');
        $betaling = $this->input->post('betaling');

        $oud = $this->inschrijving_model->get($id);

        //Als er geen betaling was en nu wel, nieuwe betaling aanmaken
        if ($oud->betalingId == null && $betaling == "ja") {
            $bet->id = 0;
            $bet->gebruikerId = $oud->gebruikerId;
            $betId = $this->betaling_model->insert($bet);
            $inschrijving->betalingId = $betId;
            
            //Activiteiten van de gebruiker ophalen, dan aflopen in foreach en de betalingId updaten
            $activiteiten = $this->activiteit_model->getAllActGebruikerConf($oud->gebruikerId, $confId);
            foreach ($activiteiten as $act) {
                $activiteit->id = $act->id;
                $activiteit->betalingId = $betId;
                $this->gebruiker_activiteit_model->update($activiteit);
            }
            
        //Als er wel een betaling wasn en men nu niet betaald kiest -> Database heeft ON DELETE - SET NULL staan, enkel betaling moet dus verwijderd worden
        } elseif ($oud->betalingId != null && $betaling == "nee") {
            $this->betaling_model->delete($oud->betalingId);
        }

        $this->inschrijving_model->update($inschrijving);
    }
    
    //inschrijving deleten
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
    
//details van een activiteit
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
