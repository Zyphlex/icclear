<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Routesbeheer extends CI_Controller {
    
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
        $data['user']  = $this->authex->getUserInfo();        
        $data['title'] = 'IC Clear - Routes beheren';         
        $data['active'] = 'admin';
        
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
        $this->load->model('gebouw_model');
        $data['gebouwen'] = $this->gebouw_model->getAll();                

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/routes/overzicht', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
        
    public function overzicht() {        
        $this->load->model('routes_model');
        $data['routes'] = $this->routes_model->getRoutes();
        
        $this->load->view('admin/routes/lijst', $data);
    }
    
    public function detail() {
        $id = $this->input->get('id');

        $this->load->model('routes_model');
        $sponsor = $this->routes_model->getRoute($id);

        echo json_encode($sponsor);
    }
    
    public function delete($id){
        $id = $this->input->post('id');

        $this->load->model('routes_model');
        $deleted = $this->routes_model->delete($id);

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
