<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Zaal extends CI_Controller {

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

        $data['title'] = 'IC Clear - Zaal';
        $data['active'] = 'admin';



        $this->load->model('zaal_model');
        $data['zalen'] = $this->zaal_model->getAll();

        $this->load->model('gebouw_model');
        $data['gebouwen'] = $this->gebouw_model->getAll();

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/zaal/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function overzicht() {
        $this->load->model('zaal_model');
        $data['zalen'] = $this->zaal_model->getGebouw();

        $this->load->model('gebouw_model');
        $data['gebouwen'] = $this->gebouw_model->getAll();

        $this->load->view('admin/zaal/lijst', $data);
    }

    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('zaal_model');
        $zaal = $this->zaal_model->get($id);

        echo json_encode($zaal);
    }

    public function update() {
        $zaal->id = $this->input->post('id');
        $zaal->naam = $this->input->post('naam');
        $zaal->gebouwId = $this->input->post('gebouw');
        $zaal->maximumAantalPersonen = $this->input->post('maximumAantalPersonen');

        $this->load->model('zaal_model');
        if ($zaal->id == 0) {
            $id = $this->zaal_model->insert($zaal);
        } else {
            $this->zaal_model->update($zaal);
        }

        echo $id;
    }

    public function delete() {
        $id = $this->input->post('id');

        $this->load->model('zaal_model');
        $deleted = $this->zaal_model->delete($id);

        echo $deleted;
    }

}

/* End of file gebouw.php */
/* Location: ./application/controllers/gebouw.php */
