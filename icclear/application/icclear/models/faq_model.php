<?php

class Faq_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Alle FAQ items ophalen
    function getAll() {
        $query = $this->db->get('faq');
        return $query->result();
    }

    // Een FAQ item ophalen
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('faq');
        return $query->row();
    }

    // Een FAQ item ophalen
    function update($faq) {
        //Html entities en extra spaties verwijderen
        $faq = escape_html($faq);
        
        $this->db->where('id', $faq->id);
        $this->db->update('faq', $faq);
    }

    // Een FAQ item verwijderen
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('faq');
    }
    
    // Een FAQ item toevoegen
    function insert($faq)
    {
        //Html entities en extra spaties verwijderen
        $faq = escape_html($faq);
        
        $this->db->insert('faq', $faq);
        return $this->db->insert_id();
    }

}

?>