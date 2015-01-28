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
        $data['conferentieId'] = $this->session->userdata('conferentieId');

        $data['title'] = 'IC Clear - Beheer';
        $data['active'] = 'admin';

        $this->load->model('gebruiker_model');
        $data['gebruiker'] = $this->gebruiker_model->get($id);

        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebruiker/wijzigen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function verwijder($id) {
        $data['conferentieId'] = $this->session->userdata('conferentieId');

        $this->load->model('gebruiker_model');
        $data['gebruiker'] = $this->gebruiker_model->delete($id);

        $this->overzichtGebruikers();
    }

    public function update() {        
        $gebruiker = new stdClass();

        $gebruiker->id = $this->input->post('id');
        $gebruiker->voornaam = $this->input->post('voornaam');
        $gebruiker->familienaam = $this->input->post('familienaam');
        $gebruiker->geboortedatum = $this->input->post('geboortedatum');
        $gebruiker->emailadres = $this->input->post('emailadres');
        $gebruiker->geslacht = $this->input->post('geslacht');
        $gebruiker->typeId = $this->input->post('type');
        $gebruiker->landId = $this->input->post('land');
        $gebruiker->gemeente = $this->input->post('gemeente');
        $gebruiker->postcode = $this->input->post('postcode');
        $gebruiker->straat = $this->input->post('straat');
        $gebruiker->nummer = $this->input->post('huisnummer');

        $this->load->model('gebruiker_model');

        $this->gebruiker_model->update($gebruiker);

        $this->overzichtGebruikers();
    }
    
    public function nieuw()
    {
        $data['user'] = $this->authex->getUserInfo();
        $data['conferentieId'] = $this->session->userdata('conferentieId');

        $data['title'] = 'IC Clear - Beheer';
        $data['active'] = 'admin';

        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebruiker/toevoegen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function insert() {
        $gebruiker = new stdClass();

        $gebruiker->gebruikersnaam = $this->input->post('gebruikersnaam');
        $gebruiker->voornaam = $this->input->post('voornaam');
        $gebruiker->familienaam = $this->input->post('familienaam');
        $gebruiker->geboortedatum = $this->input->post('geboortedatum');
        $gebruiker->emailadres = $this->input->post('emailadres');
        $gebruiker->gemeente = $this->input->post('gemeente');
        $gebruiker->postcode = $this->input->post('postcode');
        $gebruiker->straat = $this->input->post('straat');
        $gebruiker->nummer = $this->input->post('huisnummer');
        $gebruiker->geslacht = $this->input->post('geslacht');
        $gebruiker->typeId = $this->input->post('type');
        $gebruiker->landId = $this->input->post('land');
       

        $this->load->model('gebruiker_model');

        $this->gebruiker_model->insert($gebruiker);

        $this->overzichtGebruikers();
    }
    
    public function gebruikersConferentie()
    {
        $data['user'] = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - Beheer';
        $data['active'] = 'admin';
        
//        $this->load->model('inschrijving_model');
//        $data['inschrijvingen'] = $this->inschrijving_model->getInschrijvingen($this->session->userdata('conferentieId'));
        
        $this->load->model('sessies_model');
        $data['sessies'] = $this->sessies_model->getAll($this->session->userdata('conferentieId'));
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebruikerConferentie/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    // TEST
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
