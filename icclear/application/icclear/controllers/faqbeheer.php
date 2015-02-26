<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faqbeheer extends CI_Controller {

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
        $data['title'] = 'IC Clear - F.A.Q.';
        $data['active'] = 'admin';        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
        $this->load->model('faq_model');        
        $data['vragen'] = $this->faq_model->getAll();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/faq/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
  
    public function wijzig($id) {
        $data['user'] = $this->authex->getUserInfo();
        $data['title'] = 'IC Clear - F.A.Q. wijzigen';
        $data['active'] = 'admin';
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        $this->load->model('faq_model');
        $data['vraag'] = $this->faq_model->get($id);
        $data['id'] = $id;        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/faq/wijzigen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
//    public function update() {
//        $id = $this->input->post('id');
//        $vraag = $this->input->post('vraag');
//        $antwoord = $this->input->post('antwoord');
//        
//        $this->load->model('faq_model');
//        $this->faq_model->update($id, $vraag, $antwoord);
//        
//        redirect('faqbeheer/index');
//    }
//
//    public function verwijder($id) {       
//        $this->load->model('faq_model');
//        $this->faq_model->delete($id); 
//        redirect('faqbeheer/index');        
//    }
//
//    public function toevoegen() {
//        $data['user'] = $this->authex->getUserInfo();
//        $data['title'] = 'IC Clear - F.A.Q. toevoegen';
//        $data['active'] = 'admin';
//        $data['conferentieId'] = $this->session->userdata('conferentieId');                
//        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/faq/toevoegen', 'footer' => 'main_footer');
//        $this->template->load('admin_master', $partials, $data);
//    }
//    
//    public function insert() {        
//        $faq->vraag = $this->input->post('vraag');
//        $faq->antwoord = $this->input->post('antwoord');
//        
//        $this->load->model('faq_model');
//        $id = $this->faq_model->insert($faq);
//        
//        if($id != 0){
//            redirect('faqbeheer/index');
//        }
//    }
    
    public function overzicht() {        
        $this->load->model('faq_model');
        $data['vragen'] = $this->faq_model->getAll();

        $this->load->view('admin/faq/lijst', $data);
    }
    
    public function faqdetail() {        
            $id = $this->input->get('id');
                        
            $this->load->model('faq_model');
            $vraag = $this->faq_model->get($id);
            
            echo json_encode($vraag); 
    }
    
    public function faqupdate() {   
        $faq->id = $this->input->post('id');
        $faq->vraag = $this->input->post('vraag');
        $faq->antwoord = $this->input->post('antwoord');
        
        $this->load->model('faq_model');        
        if ($faq->id == 0) {
            $id = $this->faq_model->insert($faq);
        } else {
            $this->faq_model->update($faq);
        }
        
        echo $id;
    }
    
    public function faqdelete() {       
        $id = $this->input->post('id');
        
        $this->load->model('faq_model');
        $deleted = $this->faq_model->delete($id);
        
        echo $deleted;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
