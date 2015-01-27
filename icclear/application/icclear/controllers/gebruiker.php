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

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebruiker/beheer', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function verwijder($id) {
        $this->load->model('gebruiker_model');
        $data['gebruiker'] = $this->gebruiker_model->delete($id);

        $this->overzichtGebruikers();
    }

    public function toevoegen() {
        $brouwerij->id = $this->input->post('id');
        $brouwerij->naam = $this->input->post('naam');
        $brouwerij->stichter = $this->input->post('stichter');
        $brouwerij->plaats = $this->input->post('plaats');
        $brouwerij->oprichting = toYYYYMMDD($this->input->post('oprichting'));
        $brouwerij->werknemers = $this->input->post('werknemers');

        $this->load->model('brouwerij_model');
        if ($brouwerij->id == 0) {
            $this->brouwerij_model->insert($brouwerij);
        } else {
            $this->brouwerij_model->update($brouwerij);
        }

        $this->lijst();
    }

    // TEST
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
