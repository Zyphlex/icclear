<?php

class Logon_model extends CI_Model {
    

    function __construct() {
        parent::__construct();
    }

    // Een gebruiker ophalen
    function get($id) {
        // geef user-object met opgegeven $id   
        $this->db->where('id', $id);
        $query = $this->db->get('gebruiker');
        return $query->row();
    }

    // Een gebruiker zoeken met zijn email adres en paswoord
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

    // Controleren of een email adres nog niet voorkomt in de database
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
    
    // Controleren of een emailadres al in de database aanwezig is
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
    
    // Een gebruiker opzoeken met zijn emailadres en controleren of zijn account geactiveerd is
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
    
    // Controleren of de generated key overeenkomt met die in de database
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

    // Nieuwe gebruiker toevoegen
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
        $user->generatedKey = $geb->generatedKey;
        $user->activatie = 0;
//        $user->laatstAangemeld = date("Y-m-d H-i-s");
//Html entities en extra spaties verwijderen
        $user = escape_html($user);
        
        $this->db->insert('gebruiker', $user);
        return $this->db->insert_id();
    }
    
    // Bestaande gebruiker updaten
    function update($email, $generatedKey) {
        // voeg nieuwe user toe        
        $user->generatedKey = $generatedKey;        
        $this->db->where('emailadres', $email);
        //Html entities en extra spaties verwijderen
        $user = escape_html($user);
        
        $this->db->update('gebruiker', $user);
        return true;
    }

    // Een gebruikersaccount activeren
    function activeer($generatedKey) {
        $user->activatie = 1;
        $this->db->where('generatedKey', $generatedKey);
        //Html entities en extra spaties verwijderen
        $user = escape_html($user);
        
        $this->db->update('gebruiker', $user);
    }
    
    // Paswoord van een account wijzigen
    function changePass($wachtwoord, $generatedKey) {        
        $user->paswoord = sha1($wachtwoord);        
        $this->db->where('generatedKey', $generatedKey);
        //Html entities en extra spaties verwijderen
        $user = escape_html($user);
        
        $this->db->update('gebruiker', $user);
    }
    
    // Paswoord van een gebruiker wijzigen
    function changePassUser($wachtwoord, $id) {  
        //Html entities en extra spaties verwijderen en dan naar sha1 hashen    
        $user->paswoord = sha1($wachtwoord);        
        $this->db->where('id', $id);        
        $pass = escape_html($user);  
        
        $this->db->update('gebruiker', $user);
    }
    
    // De generated key van een gebruiken updaten
    function updateKey($generatedKey, $newKey) {        
        $user->generatedKey = $newKey;        
        $this->db->where('generatedKey', $generatedKey);
        //Html entities en extra spaties verwijderen
        $user = escape_html($user);
        
        $this->db->update('gebruiker', $user);
    }        

}

?>