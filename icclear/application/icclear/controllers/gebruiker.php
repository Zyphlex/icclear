<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gebruiker extends CI_Controller {

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

    public function overzichtGebruikers() {

        $data['user'] = $this->authex->getUserInfo();

        $data['title'] = 'IC Clear - Beheer';
        $data['active'] = 'admin';
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');

        $this->load->model('gebruiker_model');
        $data['gebruikers'] = $this->gebruiker_model->getAll();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebruiker/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function wijzig($id) {

        $data['user'] = $this->authex->getUserInfo();

        $data['title'] = 'IC Clear - Beheer';
        $data['active'] = 'admin';

        $this->load->model('gebruiker_model');
        $data['gebruiker'] = $this->gebruiker_model->get($id);

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebruiker/wijzigen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function verwijder($id) {
        $this->load->model('gebruiker_model');
        $data['gebruiker'] = $this->gebruiker_model->delete($id);

        $this->overzichtGebruikers();
    }

    public function toevoegen() {
        $gebruiker->id = $this->input->post('id');
        $gebruiker->naam = $this->input->post('naam');
        $gebruiker->stichter = $this->input->post('stichter');
        $gebruiker->plaats = $this->input->post('plaats');
        $gebruiker->oprichting = toYYYYMMDD($this->input->post('oprichting'));
        $gebruiker->werknemers = $this->input->post('werknemers');

        $this->load->model('brouwerij_model');
        if ($gebruiker->id == 0) {
            $this->brouwerij_model->insert($gebruiker);
        } else {
            $this->brouwerij_model->update($gebruiker);
        }

        $this->overzichtGebruikers();
    }

    // TEST
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
