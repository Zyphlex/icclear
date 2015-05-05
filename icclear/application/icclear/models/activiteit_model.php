<?php

class Activiteit_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllActGebruikerConf($id, $confId) {     
        $sql = 'select * from activiteit a 
                left join gebruikerActiviteit g 
                on a.id = g.activiteitId
                where a.conferentieId = ? 
                and g.gebruikerId = ?';
        $query = $this->db->query($sql, array($confId, $id));
        return $query->result();
    }
    
    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('activiteit');
        return $query->row();
    }

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

    function getActiviteitenPerConferentie() {
        $query = $this->db->get('activiteit');
        $activiteiten = $query->result();

        $this->load->model('conferentie_model');
        foreach ($activiteiten as $activiteit) {
            $activiteit->conferentie = $this->conferentie_model->get($activiteit->conferentieId);
        }

        return $activiteiten;
    }
    
    function countActiviteitenActieve() {
        $this->load->model('conferentie_model');
        $actieveConferentie = $this->conferentie_model->getActieveConferentie();

        $this->db->where('conferentieId', $actieveConferentie->id);
        $query = $this->db->get('activiteit');
        return $query->num_rows;
    }
    
    function countActiviteiten($id) {
        $this->load->model('conferentie_model');        
        $this->db->where('conferentieId', $id);
        $query = $this->db->get('activiteit');
        return $query->num_rows;
    }
    
    function getActiviteitenConf($id) {
        $this->db->where('conferentieId', $id);
        $query = $this->db->get('activiteit');
        return $query->result();
    }
    
    function getActiviteitenActieve() {
        $this->load->model('conferentie_model');
        $actieveConferentie = $this->conferentie_model->getActieveConferentie();

        $this->db->where('conferentieId', $actieveConferentie->id);
        $query = $this->db->get('activiteit');
        return $query->result();
    }

    function update($activiteit) {
        $activiteit = escape_html($activiteit);
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