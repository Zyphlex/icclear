<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adminbeheer extends CI_Controller {

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
        $data['title'] = 'IC Clear - Admin';
        $data['active'] = 'admin';
        $data['conferentieId'] = null;

        $this->load->model('inschrijving_model');
        if ($user == null) {
            $data['inschrijving'] = null;
        } else {
            $data['inschrijving'] = $this->inschrijving_model->getInschijvingByGebruiker($user->id);
        }

        $this->load->model('gebruiker_model');
        $data['admins'] = $this->gebruiker_model->getAllAdmins();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebruiker/overzicht_admin', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function overzicht() {
        $this->load->model('gebruiker_model');
        $data['admins'] = $this->gebruiker_model->getAllAdmins();

        $this->load->view('admin/gebruiker/lijst_admin', $data);
    }

    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('gebruiker_model');
        $admin = $this->gebruiker_model->get($id);

        echo json_encode($admin);
    }

    public function update() {
        $admin->id = $this->input->post('id');
        $admin->voornaam = $this->input->post('voornaam');
        $admin->familienaam = $this->input->post('familienaam');
        $admin->emailadres = $this->input->post('emailadres');
        $wachtwoord = $this->input->post('wachtwoord');
        $admin->paswoord = sha1($wachtwoord);

        $this->load->model('gebruiker_model');
        if ($admin->id == 0) {
            $admin->geboortedatum = '';
            $admin->biografie = '';
            $admin->foto = '';
            $admin->gemeente = '';
            $admin->postcode = '';
            $admin->straat = '';
            $admin->nummer = '';
            $admin->geslacht = '';
            $admin->typeId = 3;
            $admin->landId = 1;
            $id = $this->gebruiker_model->insert($admin);
        } else {
            $this->gebruiker_model->update($admin);
        }

        echo $id;
    }

    public function delete() {
        $id = $this->input->post('id');

        $this->load->model('gebruiker_model');
        $deleted = $this->gebruiker_model->delete($id);

        echo $deleted;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
