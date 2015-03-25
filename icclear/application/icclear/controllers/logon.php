<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logon extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('email');
    }

    public function login() {
        $data['user'] = $this->authex->getUserInfo();
        
        $this->load->view('logon/login', $data);
    }

    public function aanmelden() {
        $naam = $this->input->post('naam');
        $password = $this->input->post('password');

        if ($this->authex->login($naam, sha1($password))) {
            redirect('home');
        } else {
            redirect('faq');
        }
    }

    public function vergeten() {
        $data['user'] = '';

        $this->load->view('logon/wwvergeten', $data);
    }

    public function logout() {
        $this->authex->logout();
        redirect('home');
    }

    public function register() {
        $data['user'] = '';

        $this->load->model('land_model');
        $data['landen'] = $this->land_model->getAll();

        $this->load->view('logon/registreer', $data);
    }

    public function add() {
        $gebruikersnaam = $this->input->post('gebruikersnaam');
        $familienaam = $this->input->post('familienaam');
        $voornaam = $this->input->post('voornaam');
        $email = $this->input->post('emailadres');
        $wachtwoord = $this->input->post('wachtwoord');        
        $activatie = 0;
        
        $generatedKey = sha1(mt_rand(10000, 99999) . time() . $email);

        $id = $this->authex->register($gebruikersnaam, $familienaam, $voornaam, $email, $wachtwoord, $activatie);
        if ($id != 0) {
            $this->sendmail($email, $generatedKey);
            $this->klaar();
        } else {
            $this->bestaat();
        }
    }

    public function nieuwPass() {

        $data['user'] = ''; 
        $data['active'] = '';
        $data['title'] = 'IC Clear - Wachtwoord aangepast';

        $wachtwoord = $this->input->post('wachtwoord');
        $generatedKey = $this->input->post('key');

        $this->authex->nPass($wachtwoord, $generatedKey);
        
        $newKey = sha1(mt_rand(10000, 99999) . time() . $wachtwoord);
        $this->authex->updateKey($generatedKey, $newKey);
        
        
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/ww_succes', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
        
    }

    public function passReset($generatedKey) {
         $this->load->model('logon_model');
        
        $data['user'] = '';
        $data['generatedKey'] = $generatedKey;
        $data['title'] = 'IC Clear - Register'; 
        $data['active'] = '';

        if ($this->logon_model->correct($generatedKey) == false) {
            $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/foutKey', 'footer' => 'main_footer');
        } else {
            $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/newPass', 'footer' => 'main_footer');
        }
        $this->template->load('main_master', $partials, $data);
    }

    public function bestaat() {
        $data['title'] = 'IC Clear - Register';
        $data['user'] = ''; 
        $data['active'] = '';

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/user_bestaat', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function klaar() {
        $data['title'] = 'IC Clear - Register';
        $data['user'] = $this->authex->getUserInfo(); 
        $data['active'] = '';

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/user_klaar', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function ajax() {
        $zoekstring = $this->input->get('zoekstring');
        $this->load->model('logon_model');
        $this->logon_model->user_exists($zoekstring);
    }

    public function activeer($generatedKey) {
        $data['title'] = 'Succesvol geactiveerd';

        $this->authex->activate($generatedKey);

        $data['user'] = null; 
        $data['active'] = '';
        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/user_geactiveerd', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    private function sendmail($to, $generatedKey) {
        $this->email->from('donotreply@thomasmore.be');
        $this->email->to($to);
        $this->email->subject('Geregistreerd bij IC Clear');
        $this->email->message('U bent geregistreerd! Klik op onderstaande link om uw registratie te activeren ' . "\n" . "\n " . site_url("logon/activeer/$generatedKey"));
        $this->email->send();         
    }

    public function resetPass() {
 
        $data['active'] = '';
        $data['title'] = 'IC Clear - Email verzonden';

        $email = $this->input->post('emailadres');
        $generatedKey = sha1(mt_rand(10000, 99999) . time() . $email);

        $this->authex->new_genKey($email, $generatedKey);

        $this->email->from('donotreply@icclear.com');
        $this->email->to($email);
        $this->email->subject('Paswoord resetten - IC Clear');
        $this->email->message('Klik op onderstaande link als u uw wachtwoord wilt resetten. ' . "\n" . "\n " . site_url("logon/passReset/$generatedKey"));
        $this->email->send();

        $data['user'] = '';

        $partials = array('header' => 'main_header', 'nav' => 'main_nav', 'content' => 'logon/verzonden', 'footer' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    function check_email_availablity() {
        $this->load->model('email_model');
        $result = $this->email_model->check_email_availablity();

        if (!$result)
            echo '<p class="form-note form-note-used">Niet beschikbaar</p>';
        else
            echo '<p class="form-note form-note-ok">Beschikbaar</p>';
    }

    function check_username_availablity() {
        $this->load->model('gebruiker_model');
        $result = $this->gebruiker_model->check_username_availablity();

        if (!$result)
            echo '<p class="form-note form-note-used">Niet beschikbaar</p>';
        else
            echo '<p class="form-note form-note-ok">Beschikbaar</p>';
    }

    // TEST
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
