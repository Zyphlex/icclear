<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sponsorbeheer extends CI_Controller {

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
         $user  = $this->authex->getUserInfo();
        $data['user'] = $user;
        $data['conferentieId'] = null;        
        $this->load->model('inschrijving_model');
        $data['inschrijving'] = $this->inschrijving_model->getInschijvingByGebruiker($user->id);
        
        $data['title'] = 'IC Clear - Sponsors'; 
        $data['active'] = 'admin';        
                
        
        //$this->load->model('sponsor_model');
        //$data['sponsors'] = $this->sponsor_model->getAll();
        
        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/sponsor/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
      
    public function overzicht() {        
        $this->load->model('sponsor_model');
        $data['sponsors'] = $this->sponsor_model->getAll();
        
        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();

        $this->load->view('admin/sponsor/lijst', $data);
    }
    
    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('sponsor_model');
        $sponsor = $this->sponsor_model->get($id);

        echo json_encode($sponsor);
    }
    
    public function delete($id){
        $id = $this->input->post('id');

        $this->load->model('sponsor_model');
        $deleted = $this->sponsor_model->delete($id);

        echo $deleted;
    }
    
    public function update() {        
        $sponsor->id = $this->input->post('id');
        $sponsor->naam = $this->input->post('naam');
        $sponsor->landId = $this->input->post('land');
        $sponsor->gemeente = $this->input->post('gemeente');
        $sponsor->postcode = $this->input->post('postcode');
        $sponsor->straat = $this->input->post('straat');
        $sponsor->nummer = $this->input->post('nummer');
        $sponsor->type = $this->input->post('type');
        
        $this->load->model('sponsor_model');
        if ($sponsor->id == 0) {
            $id = $this->sponsor_model->insert($sponsor);
        } else {
            $this->sponsor_model->update($sponsor);
        }
        
        echo $id;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
