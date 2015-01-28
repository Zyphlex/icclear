<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['user']  = $this->authex->getUserInfo();
        
        $data['title'] = 'IC Clear - F.A.Q.';         
        $data['active'] = '';
        
        $this->load->model('faq_model');
        $data['vragen'] = $this->faq_model->getFaq();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'faq/faq', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function beheer(){
        $data['user']  = $this->authex->getUserInfo();        
        $data['title'] = 'IC Clear - F.A.Q.';         
        $data['active'] = '';
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $this->load->model('faq_model');
        $data['vragen'] = $this->faq_model->getAll();
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/faq/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function wijzig($id)
    {
        
    }
    
    public function verwijder($id)
    {
        
    }
    
    public function toevoegen()
    {
        
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
