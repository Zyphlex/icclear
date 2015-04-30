<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aankondiging extends CI_Controller {

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
//        $data['conferentie'] = $this->session->userdata('conferentie');

        $this->load->model('inschrijving_model');
        if ($user == null) {
            $data['inschrijving'] = null;
        } else {
            $data['inschrijving'] = $this->inschrijving_model->getInschijvingByGebruiker($user->id);
        }

        $this->load->model('aankondiging_model');
        $data['aankondigingen'] = $this->aankondiging_model->getAllPerConferentie($this->session->userdata('conferentieId'));

        $data['title'] = 'IC Clear - aankondigingen';
        $data['active'] = 'admin';

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/aankondiging/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function overzicht() {
        $this->load->model('aankondiging_model');
        $data['aankondigingen'] = $this->aankondiging_model->getAllPerConferentie($this->session->userdata('conferentieId'));

        $this->load->view('admin/aankondiging/lijst', $data);
    }

    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('aankondiging_model');
        $aankondiging = $this->aankondiging_model->getAankondiging($id);

        echo json_encode($aankondiging);
    }

    public function delete($id) {
        $id = $this->input->post('id');

        $this->load->model('aankondiging_model');
        $deleted = $this->aankondiging_model->delete($id);

        echo $deleted;
    }

    public function update() {
        $aankondiging->id = htmlentities($this->input->post('id'));
        $aankondiging->titel = htmlentities($this->input->post('titel'));
        $aankondiging->inhoud = htmlentities($this->input->post('inhoud'));
        $aankondiging->gepostDoor = htmlentities($this->input->post('gepostDoor'));
        $aankondiging->conferentieId = htmlentities($this->input->post('conferentieId'));

        $this->load->model('aankondiging_model');
        if ($aankondiging->id == 0) {
            $id = $this->aankondiging_model->insert($aankondiging);
        } else {
            $this->aankondiging_model->update($aankondiging);
        }

        echo $id;
    }
    // TEST
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
