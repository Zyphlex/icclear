<?php

class Conferentie_onderdeel_model extends CI_Model {


    function __construct() {
        parent::__construct();
    }

    // Alle conferentie onderdelen van eenzelfde conferentie ophalen
    function getAllConferentie($id) {
        $this->db->where('conferentieId', $id);
        $query = $this->db->get('conferentieOnderdeel');
        return $query->result();
    }
    
    // een conferentie onderdeel ophalen
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('conferentieOnderdeel');
        return $query->row();
    }
       
    // Een conferentie onderdeel updaten
    function update($onderdeel) {
        //Html entities en extra spaties verwijderen
        $onderdeel = escape_html($onderdeel);
        
        $this->db->where('id', $onderdeel->id);
        $this->db->update('conferentieOnderdeel', $onderdeel);
    }

    // Een conferentie onderdeel verwijderen
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('conferentieOnderdeel');
    }
    
    // Een nieuw conferentie onderdeel toevoegen
    function insert($onderdeel)
    {
        //Html entities en extra spaties verwijderen
        $onderdeel = escape_html($onderdeel);
        
        $this->db->insert('conferentieOnderdeel', $onderdeel);
        return $this->db->insert_id();
    }
}

?>