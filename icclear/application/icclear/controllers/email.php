<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('email');
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
        $data['conferentieId'] = $this->session->userdata('conferentieId');
        
        $data['title'] = 'IC Clear - Emails.';         
        $data['active'] = 'admin';
        
        $this->load->model('conferentie_model');
        $data['conferentie'] = $this->conferentie_model->getActieveConferentie();
                        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'sidenav' => 'admin_sidenav', 'content' => 'admin/email/opstellen', 'footer' => 'main_footer');
        $this->template->load('admin_master', $partials, $data);
    }
    
    public function verzend(){
        $onderwerp = $this->input->post('onderwerp');
        $ontvanger = $this->input->post('ontvanger');
        $inhoud = $this->input->post('inhoud');
        $conferentie = $this->session->userdata('conferentie');        
        
        $subject = $conferentie . ' - ' . $onderwerp;         
        
        $this->email->from('donotreply@thomasmore.be');
        $this->email->to($ontvanger);
        $this->email->subject($subject);
        $this->email->message($inhoud);
        $this->email->send();                
        
        redirect('admin/index');
    }        
    
}
