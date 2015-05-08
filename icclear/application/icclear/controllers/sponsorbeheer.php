<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sponsorbeheer extends CI_Controller {

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

        $data['title'] = 'IC Clear - Sponsors';
        $data['active'] = 'admin';


        //$this->load->model('sponsor_model');
        //$data['sponsors'] = $this->sponsor_model->getAll();

        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sponsor/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    //overzicht van alle sponsors die je kan beheren
    public function overzicht() {
        $this->load->model('sponsor_model');
        $data['sponsors'] = $this->sponsor_model->getAll();

        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();

        $this->load->view('admin/sponsor/lijst', $data);
    }

    //details per sponsor
    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('sponsor_model');
        $sponsor = $this->sponsor_model->get($id);

        echo json_encode($sponsor);
    }

    //sponsor verwijderen
    public function delete($id) {
        $id = $this->input->post('id');

        $this->load->model('sponsor_model');
        $deleted = $this->sponsor_model->delete($id);

        echo $deleted;
    }

    //sponsor wijzigen
    public function update() {
        $sponsor->id = $this->input->post('id');
        $sponsor->naam = $this->input->post('naam');
        $sponsor->landId = $this->input->post('land');
        $sponsor->gemeente = $this->input->post('gemeente');
        $sponsor->postcode = $this->input->post('postcode');
        $sponsor->straat = $this->input->post('straat');
        $sponsor->nummer = $this->input->post('nummer');
        $sponsor->type = $this->input->post('type');

        // foto
        $config['upload_path'] = './application/upload/fotos/sponsors';
        $config['allowed_types'] = 'jpg';
        $config['file_name'] = 'sponsor' . $sponsor->id . '.jpg';
        $config['max_size'] = 200;
        $config['max_height'] = 350;
        $config['max_width'] = 350;
        $config['overwrite'] = true;

        // Map aanmaken als deze nog niet bestaat
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        // Uploaden
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $fieldname = 'userfile';
        if (!empty($_FILES['userfile'])) {
            if (!$this->upload->do_upload($fieldname)) {
                $error = array('error' => $this->upload->display_errors());
                echo print_r($config);
                echo print_r($error);
                echo realpath($config['upload_path']);
            }
        }

        $sponsor->logo = $config['file_name'];

        // Toevoegen als record nog niet bestaat, anders updaten
        $this->load->model('sponsor_model');
        if ($sponsor->id == 0) {
            $id = $this->sponsor_model->insert($sponsor);
        } else {
            $this->sponsor_model->update($sponsor);
        }

        redirect('sponsorbeheer');
    }

}
