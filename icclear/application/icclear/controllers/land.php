<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Land extends CI_Controller {
    
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
        
        $data['title'] = 'IC Clear - Beheer';        
        $data['active'] = 'admin';        
                
        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/land/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function overzicht(){
        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();                  
        $this->load->view('admin/land/lijst', $data);
    }
    
     public function update() {   
        $land->id = $this->input->post('id');
        $land->naam = $this->input->post('naam');                        
        
        $this->load->model('land_model');        
        if ($land->id == 0) {
            $id = $this->land_model->insert($land);
        } else {
            $this->land_model->update($land);
        }
        
        echo $id;
    }
    
    public function detail() {        
            $id = $this->input->get('id');                        
            $this->load->model('land_model');
            $land = $this->land_model->get($id);            
            echo json_encode($land); 
    }
    
    public function delete() {       
        $id = $this->input->post('id');
        
        $this->load->model('land_model');
        $deleted = $this->land_model->delete($id);
        
        echo $deleted;
    }
    

    
    
    // TEST
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
