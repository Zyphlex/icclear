<?php

class Activiteit_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //1 activiteit ophalen
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('activiteit');
        return $query->row();
    }

    //Alle activiteiten gesorteerd per conferentie ophalen
    function getAllActiviteiten() {
        $this->db->order_by('conferentieId');
        $query = $this->db->get('activiteit');
        $activiteiten = $query->result();

        $this->load->model('conferentie_model');

        foreach ($activiteiten as $activiteit) {
            $activiteit->conferentie = $this->conferentie_model->get($activiteit->conferentieId);
        }

        return $activiteiten;
    }

    //Alle activiteiten van conferenties ophalen
    function getActiviteitenPerConferentie() {
        $query = $this->db->get('activiteit');
        $activiteiten = $query->result();

        $this->load->model('conferentie_model');
        foreach ($activiteiten as $activiteit) {
            $activiteit->conferentie = $this->conferentie_model->get($activiteit->conferentieId);
        }

        return $activiteiten;
    }
    
    //Tellen hoeveel activiteiten er voor de actieve conferentie zijn
    function countActiviteitenActieve() {
        $this->load->model('conferentie_model');
        $actieveConferentie = $this->conferentie_model->getActieveConferentie();

        $this->db->where('conferentieId', $actieveConferentie->id);
        $query = $this->db->get('activiteit');
        return $query->num_rows;
    }
    
    //Tellen hoeveel activiteiten er voor een conferentie zijn
    function countActiviteiten($id) {
        $this->load->model('conferentie_model');        
        $this->db->where('conferentieId', $id);
        $query = $this->db->get('activiteit');
        return $query->num_rows;
    }
    
    //Alle activiteiten waar de gebruiker voor deze conferentie is ingeschreven ophalen.
    //Aangezien dit niet is gelinkt aan inschrijving om 1 of andere reden, was de enigste manier
    //om deze terug te krijgen een join te gebruiken.
    function getAllActGebruikerConf($id, $confId) {     
        $sql = 'select * from activiteit a 
                join gebruikerActiviteit g 
                on a.id = g.activiteitId
                where a.conferentieId = ? 
                and g.gebruikerId = ?';
        $query = $this->db->query($sql, array($confId, $id));
        return $query->result();
    }
    
    //Alle activiteiten van conferentie ophalen
    function getActiviteitenConf($id) {
        $this->db->where('conferentieId', $id);
        $query = $this->db->get('activiteit');
        return $query->result();
    }
    
    //Alle activiteiten van de actieve conferentie ophalen
    function getActiviteitenActieve() {
        $this->load->model('conferentie_model');
        $actieveConferentie = $this->conferentie_model->getActieveConferentie();

        $this->db->where('conferentieId', $actieveConferentie->id);
        $query = $this->db->get('activiteit');
        return $query->result();
    }

    function update($activiteit) {
        $activiteit = escape_html($activiteit); //Alle witruimte en html chars wegahlen
        $this->db->where('id', $activiteit->id);
        $this->db->update('activiteit', $activiteit);
    }

    function insert($activiteit) {
        $activiteit = escape_html($activiteit);
        $this->db->insert('activiteit', $activiteit);
        return $this->db->insert_id();
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('activiteit');
    }

}

?>