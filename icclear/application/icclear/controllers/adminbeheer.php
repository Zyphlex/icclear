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
        $data['user'] = $this->authex->getUserInfo();

        $data['title'] = 'IC Clear - Admin';
        $data['active'] = 'admin';
        $data['conferentieId'] = $this->session->userdata('conferentieId');

        $this->load->model('gebruiker_model');
        $data['admins'] = $this->gebruiker_model->getAllAdmins();

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
        $admin->gebruikersnaam = $this->input->post('gebruikersnaam');
        $admin->voornaam = $this->input->post('voornaam');
        $admin->familienaam = $this->input->post('familienaam');
        $admin->emailadres = $this->input->post('emailadres');

        $this->load->model('gebruiker_model');
        if ($admin->id == 0) {
            $admin->geboortedatum = null;
            $admin->biografie = null;
            $admin->foto = null;
            $admin->gemeente = null;
            $admin->postcode = null;
            $admin->straat = null;
            $admin->nummer = null;
            $admin->paswoord = null;
            $admin->geslacht = null;
            $admin->typeId = 3;
            $admin->landId = 0;
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
