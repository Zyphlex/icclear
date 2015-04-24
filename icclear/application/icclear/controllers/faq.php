<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
         $user  = $this->authex->getUserInfo();
        $data['user'] = $user;
        $data['conferentieId'] = $this->session->userdata('conferentieId');        
        $this->load->model('inschrijving_model');
        $data['inschrijving'] = $this->inschrijving_model->getInschijvingByGebruiker($user->id);
        

        $data['title'] = 'IC Clear - F.A.Q.';
        $data['active'] = '';

        $this->load->model('faq_model');
        $data['vragen'] = $this->faq_model->getAll();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'faq/faq', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }   

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
