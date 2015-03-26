<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Planningbeheer extends CI_Controller {

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
        
        $data['title'] = 'IC Clear - Planning';
        $data['active'] = 'admin';        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
        //$this->load->model('planning_model');        
        //$data['planningen'] = $this->planning_model->getAllByDag();
        
        $this->load->model('sessies_model'); 
        $data['sessies'] = $this->sessies_model->getAlleSessies();
        
        $this->load->model('zaal_model'); 
        $data['zalen'] = $this->zaal_model->getAll();
                
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/planning/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
      
    public function overzicht() {    
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
        $this->load->model('planning_model');
        $data['dagen'] = $this->planning_model->getAllByDag($data['conferentieId']);

        $this->load->view('admin/planning/lijst', $data);
    }
    
    public function detail() {        
            $id = $this->input->get('id');
                        
            $this->load->model('planning_model');
            $planning = $this->planning_model->get($id);
            
            echo json_encode($planning); 
    }
    
    public function update() {   
        $planning->id = $this->input->post('id');
        $planning->conferentiedagId = $this->input->post('conferentiedag');
        $planning->sessieId = $this->input->post('sessie');
        $planning->beginUur = $this->input->post('beginuur');
        $planning->eindUur = $this->input->post('einduur');
        $planning->plenair = $this->input->post('plenair');
        $planning->zaalId = $this->input->post('zaal');
        
        $this->load->model('planning_model');        
        if ($planning->id == 0) {
            $id = $this->planning_model->insert($planning);
        } else {
            $this->planning_model->update($planning);
        }
        
        echo $id;
    }
    
    public function delete() {       
        $id = $this->input->post('id');
        
        $this->load->model('planning_model');
        $deleted = $this->planning_model->delete($id);
        
        echo $deleted;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
