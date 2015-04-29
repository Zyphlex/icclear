<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gebouw extends CI_Controller {

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
        $this->load->model('inschrijving_model');
        if ($user == null) {
            $data['inschrijving'] = null;
        } else {
            $data['inschrijving'] = $this->inschrijving_model->getInschijvingByGebruiker($user->id);
        }

        $data['title'] = 'IC Clear - Gebouw';
        $data['active'] = 'admin';

        $this->load->model('gebouw_model');

        $data['gebouwen'] = $this->gebouw_model->getAll();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebouw/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function overzicht() {
        $this->load->model('gebouw_model');
        $data['gebouwen'] = $this->gebouw_model->getAll();

        $this->load->view('admin/gebouw/lijst', $data);
    }

    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('gebouw_model');
        $gebouw = $this->gebouw_model->get($id);

        echo json_encode($gebouw);
    }

    public function update() {
        $gebouw->id = $this->input->post('id');
        $gebouw->naam = $this->input->post('naam');
        $gebouw->postcode = $this->input->post('postcode');
        $gebouw->gemeente = $this->input->post('gemeente');
        $gebouw->straat = $this->input->post('straat');
        $gebouw->nummer = $this->input->post('nummer');

        $this->load->model('gebouw_model');
        if ($gebouw->id == 0) {
            $id = $this->gebouw_model->insert($gebouw);
        } else {
            $this->gebouw_model->update($gebouw);
        }

        echo $id;
    }

    public function delete() {
        $id = $this->input->post('id');

        $this->load->model('gebouw_model');
        $deleted = $this->gebouw_model->delete($id);

        echo $deleted;
    }

    public function gebouwPerDag() {
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;
        $conferentieId = $this->session->userdata('conferentieId');
        $this->load->model('inschrijving_model');
        /*if ($user == null) {
            $data['inschrijving'] = null;
        } else {
            $data['inschrijving'] = $this->inschrijving_model->getInschijvingByGebruiker($user->id);
        }*/
        $data['title'] = 'IC Clear - Gebouwen';
        $data['active'] = 'admin';

        $data['conferentieId'] = $conferentieId;

        $this->load->model('conferentiedag_model');
        $data['conferentiedagen'] = $this->conferentiedag_model->getFromConferentie($conferentieId);

        $this->load->model('conferentie_model');
        $conferentie = $this->conferentie_model->get($conferentieId);
        $data['conferentie'] = $conferentie;
        
        $this->loaf->model('gebouw_model');
        $data['gebouwen'] = $this->gebouw_model->getPerLand($conferentie->landId);

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/gebouwConferentie/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

}

/* End of file gebouw.php  */
/* Location: ./application/controllers/gebouw.php */
