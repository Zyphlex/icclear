<?php

class Inschrijving_model extends CI_Model {

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

    function getInschrijving($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('inschrijving');
        $inschrijving = $query->row();
        
        $this->load->model('betalingtype_model');
        $this->load->model('gebruiker_model');
        $this->load->model('conferentie_model');
        $this->load->model('conferentie_onderdeel_model');
        $this->load->model('betaling_model');
        $this->load->model('activiteit_model');
        $inschrijving->methode = $this->betalingtype_model->get($inschrijving->methodeId);
        $inschrijving->gebruiker = $this->gebruiker_model->get($inschrijving->gebruikerId);
        $inschrijving->conferentie = $this->conferentie_model->get($inschrijving->conferentieId);
        $inschrijving->confond = $this->conferentie_onderdeel_model->get($inschrijving->conferentieOnderdeelId);
        $inschrijving->betaling = $this->betaling_model->get($inschrijving->betalingId);        
        $inschrijving->activiteiten = $this->activiteit_model->getAllActGebruikerConf($inschrijving->gebruiker->id,$inschrijving->conferentie->id);
        
        return $inschrijving;
    }
    
    function getAllInschijvingByConferentie($id) {
        $this->db->where('conferentieId', $id);
        $query = $this->db->get('inschrijving');
        $inschrijvingen = $query->result();

        $this->load->model('gebruiker_model');
        $this->load->model('betaling_model');
        $this->load->model('conferentie_onderdeel_model');
        $this->load->model('betalingtype_model');
        $this->load->model('conferentie_model');


        foreach ($inschrijvingen as $inschrijving) {
            $inschrijving->gebruiker = $this->gebruiker_model->get($inschrijving->gebruikerId);
            $inschrijving->betaling = $this->betaling_model->get($inschrijving->betalingId);
            $inschrijving->confonderdeel = $this->conferentie_onderdeel_model->get($inschrijving->conferentieOnderdeelId);
            $inschrijving->conferentie = $this->conferentie_model->get($inschrijving->conferentieId);       
            $inschrijving->type = $this->betalingtype_model->get($inschrijving->methodeId);
        }
        return $inschrijvingen;
    }
    
    function getInschijvingByGebruiker($id) {
        $this->db->where('gebruikerId', $id);
        $query = $this->db->get('inschrijving');        
        $inschrijvingen = $query->result();
        
        $this->load->model('betaling_model');
        $this->load->model('conferentie_onderdeel_model');
        $this->load->model('conferentie_model');
        $this->load->model('betalingtype_model');
        $this->load->model('gebruiker_activiteit_model');            
        
        foreach ($inschrijvingen as $inschrijving)
        {
            $inschrijving->betaling = $this->betaling_model->get($inschrijving->betalingId);            
            $inschrijving->confonderdeel = $this->conferentie_onderdeel_model->get($inschrijving->conferentieOnderdeelId);
            $inschrijving->conferentie = $this->conferentie_model->get($inschrijving->conferentieId);            
            $inschrijving->type = $this->betalingtype_model->get($inschrijving->methodeId);
        }
        
        return $inschrijvingen;
    }

    function getOnderdeelByInschrijving($id) {
        $this->db->where('conferentieOnderdeelId', $id);
        $query = $this->db->get('inschrijving');
        $inschrijving = $query->row();

        $this->load->model('gebruiker_model');
        $this->load->model('betaling_model');
        $this->load->model('conferentie_onderdeel_model');
        $this->load->model('betalingtype_model');
        $this->load->model('conferentie_model');


        $inschrijving->gebruiker = $this->gebruiker_model->get($inschrijving->gebruikerId);
        $inschrijving->betaling = $this->betaling_model->get($inschrijving->betalingId);
        $inschrijving->confonderdeel = $this->conferentie_onderdeel_model->get($inschrijving->conferentieOnderdeelId);
        $inschrijving->conferentie = $this->conferentie_model->get($inschrijving->conferentieId);
        
        return $inschrijving;
    }
    
    function getCountByConferentie($id) {
        $this->db->where('conferentieId', $id);
        $query = $this->db->get('inschrijving');
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    function insert($inschrijving) {
        //Html entities en extra spaties verwijderen
        $inschrijving = escape_html($inschrijving);
        
        $this->db->insert('inschrijving', $inschrijving);
        return $this->db->insert_id();
    }
    
    //Kijken of er een inschrijving is van de gebruiker voor de actieve conferentie
    function IsGebruikerIngeschreven($id)
    {
        $this->load->model('conferentie_model');
        $confId = $this->conferentie_model->getActieveConferentie();        
        
        $this->db->where('gebruikerId', $id);
        $this->db->where('conferentieId', $confId->id);
        $query = $this->db->get('inschrijving');        
        $inschrijving = $query->row();        
        return $inschrijving;
    }
    
     function update($inschrijving) {
        //Html entities en extra spaties verwijderen
        $inschrijving = escape_html($inschrijving);
        
        $this->db->where('id', $inschrijving->id);
        $this->db->update('inschrijving', $inschrijving);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('inschrijving');
    }

}

?>