<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Authex {
           
    // +----------------------------------------------------------
    // | Authex library
    // |
    // +----------------------------------------------------------
    // | Nelson Wells
    // | http://nelsonwells.net/2010/05/creating-a-simple-extensible-codeigniter-authentication-library/    
    // | aangepast door Frederik Van Hooghten
    // +----------------------------------------------------------

    public function __construct()
    {
        $CI = & get_instance();
        
        $CI->load->model('logon_model');
    }

    function loggedIn() 
    {
        // gebruiker is aangemeld als sessievariabele user_id bestaat
        $CI = & get_instance();
        if ($CI->session->userdata('user_id')) {
            return true;
        } else {
            return false;
        }
    }
    
    function getUserInfo() 
    {
        // geef user-object als gebruiker aangemeld is
        $CI = & get_instance();
        if (! $this->loggedIn()) {
            return null;
        } else {
            $id = $CI->session->userdata('user_id');
            return $CI->logon_model->get($id);
        }
    }

    function login($email, $password) 
    {
        // gebruiker aanmelden met opgegeven email en wachtwoord
        $CI = & get_instance();
        $user = $CI->logon_model->getUser($email, $password);
        if ($user == null) {
            return false;
        } else {
            $CI->session->set_userdata('user_id', $user->id);
            return true;
        }
    }

    function logout() 
    {
        // uitloggen, dus sessievariabele wegdoen
        $CI = & get_instance();
        $CI->session->unset_userdata('user_id');
    }        

    function register($user)
    {
        // nieuwe gebruiker registreren als email nog niet bestaat
        $CI = & get_instance();
        if ($CI->logon_model->emailVrij($user->email)) {
            $id = $CI->logon_model->insert($user);
            return $id;
        } else {
            return 0;
        }
    }
    
    function new_genKey($email,  $generatedKey)
    {
        // nieuwe gebruiker registreren als email nog niet bestaat
        $CI = & get_instance();
        if ($CI->logon_model->emailAanwezig($email)) {
            $id = $CI->logon_model->update($email, $generatedKey);
            return $id;
        } else {
            return false;
        }
    }
    
    function updateKey($generatedKey, $newKey)
    {
        // nieuwe gebruiker registreren als email nog niet bestaat
        $CI = & get_instance();        
        $CI->logon_model->updateKey($generatedKey, $newKey);        
    }
    
    function nPass($wachtwoord, $generatedKey) 
    {
        // nieuwe gebruiker activeren
        $CI = & get_instance();
        $CI->logon_model->changePass($wachtwoord, $generatedKey);
    }
    
    function activate($id) 
    {
        // nieuwe gebruiker activeren
        $CI = & get_instance();
        $CI->logon_model->activeer($id);
    }

}