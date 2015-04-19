<?php

class Logon_model extends CI_Model {

    // +----------------------------------------------------------
    // | Beershop - product_model
    // +----------------------------------------------------------
    // | Thomas More Kempen - 2 TI - 201x-201x
    // +----------------------------------------------------------
    // | Product model
    // |
    // +----------------------------------------------------------
    // | K. Vangeel
    // +----------------------------------------------------------

    function __construct() {
        parent::__construct();
    }

    function get($id) {
        // geef user-object met opgegeven $id   
        $this->db->where('id', $id);
        $query = $this->db->get('gebruiker');
        return $query->row();
    }

    function getUser($email, $password) {
        $this->db->where('emailadres', $email);
        $this->db->where('paswoord', $password);
        $query = $this->db->get('gebruiker');
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return null;
        }
    }

    function emailVrij($email) {
        // is email al dan niet aanwezig
        $this->db->where('emailadres', $email);
        $query = $this->db->get('gebruiker');
        if ($query->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function emailAanwezig($email) {
        // is email al dan niet aanwezig
        $this->db->where('emailadres', $email);
        $query = $this->db->get('gebruiker');
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return true;
        }
    }
    
    function isGeactiveerd($email) {        
        $this->db->where('emailadres', $email);
        $this->db->where('activatie', 1);
        $query = $this->db->get('gebruiker');
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    function correct($generatedKey) {
        // is generated key correct?
        $this->db->where('generatedKey', $generatedKey);
        $query = $this->db->get('gebruiker');
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return true;
        }
    }

    function insert($geb) {                                                                       
        // voeg nieuwe user toe        
        $user->voornaam = $geb->voornaam;
        $user->familienaam = $geb->familienaam;
        $user->geboortedatum = '';
        $user->biografie = '';
        $user->foto = '';
        $user->emailadres = $geb->email;
        $user->gemeente = '';
        $user->postcode = '';
        $user->straat = '';
        $user->nummer = '';
        $user->paswoord = sha1($geb->wachtwoord);
        $user->geslacht = $geb->geslacht;
        $user->typeId = 1;
        $user->landId = $geb->land;
        $user->generatedKey = $geb->generatedKey;
        $user->activatie = 0;
//        $user->laatstAangemeld = date("Y-m-d H-i-s");
        $this->db->insert('gebruiker', $user);
        return $this->db->insert_id();
    }
    
    function update($email, $generatedKey) {
        // voeg nieuwe user toe        
        $user->generatedKey = $generatedKey;        
        $this->db->where('emailadres', $email);              
        $this->db->update('gebruiker', $user);
        return true;
    }

    function activeer($generatedKey) {
        $user->activatie = 1;
        $this->db->where('generatedKey', $generatedKey);
        $this->db->update('gebruiker', $user);
    }
    
    function changePass($wachtwoord, $generatedKey) {        
        $user->paswoord = sha1($wachtwoord);        
        $this->db->where('generatedKey', $generatedKey);
        $this->db->update('gebruiker', $user);
    }
    
    function updateKey($generatedKey, $newKey) {        
        $user->generatedKey = $newKey;        
        $this->db->where('generatedKey', $generatedKey);
        $this->db->update('gebruiker', $user);
    }        

}

?>