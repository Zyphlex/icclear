<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Beheerfaq extends CI_Controller {

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
       
    public function wijzig($id) {
        $data['user'] = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - F.A.Q. wijzigen';
        $data['active'] = '';
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $data['$id'] = $id;
        $this->load->model('faq_model');
        $data['vraag'] = $this->faq_model->get($id);
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/faq/wijzigen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }

    public function verwijder($id) {
        
    }

    public function toevoegen() {
        
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
