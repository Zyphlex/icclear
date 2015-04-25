<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Statistiek extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $user = $this->authex->getUserInfo();
        $data['user'] = $user;
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $this->load->model('inschrijving_model');
        if ($user == null) {
            $data['inschrijving'] = null;
        } else {
            $data['inschrijving'] = $this->inschrijving_model->getInschijvingByGebruiker($user->id);
        }

        $data['title'] = 'IC Clear - Statistieken';
        $data['active'] = 'admin';

        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $this->load->model('sponsor_model');
        $data['sponsors'] = $this->sponsor_model->getAll();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'admin/statistiek/overzicht', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

}
