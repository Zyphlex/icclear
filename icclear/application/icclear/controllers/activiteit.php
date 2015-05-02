<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activiteit extends CI_Controller {

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
        $data['title'] = 'IC Clear - Beheer';
        $data['active'] = 'admin';
        $data['conferentieId'] = null;

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
        $data['conferenties'] = $this->conferentie_model->getById();

        $this->load->model('activiteit_model');
        $data['activiteiten'] = $this->activiteit_model->getAllActiviteiten();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/activiteit/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function overzicht() {
        $this->load->model('activiteit_model');
        $data['activiteiten'] = $this->activiteit_model->getAllActiviteiten();

        $this->load->view('admin/activiteit/lijst', $data);
    }

    public function update() {
        $activiteit->id = $this->input->post('id');
        $activiteit->naam = $this->input->post('naam');
        $activiteit->omschrijving = $this->input->post('omschrijving');
        $activiteit->prijs = $this->input->post('prijs');
        $activiteit->conferentieId = $this->input->post('conferentie');

        $this->load->model('activiteit_model');
        if ($activiteit->id == 0) {
            $id = $this->activiteit_model->insert($activiteit);
        } else {
            $this->activiteit_model->update($activiteit);
        }

        echo $id;
    }

    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('activiteit_model');
        $activiteit = $this->activiteit_model->get($id);

        echo json_encode($activiteit);
    }

    public function delete() {
        $id = $this->input->post('id');

        $this->load->model('activiteit_model');
        $deleted = $this->activiteit_model->delete($id);

        echo $deleted;
    }

    // TEST
}

 
 
