<?php

class Inschrijving_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*function getAllWithGebruiker() {
        $this->db->order_by('gebruikerId', 'asc');
        $query = $this->db->get('inschrijving');
        $inschrijvingen = $query->result();

        $this->load->model('gebruiker_model');

        foreach ($inschrijvingen as $inschrijving) {
            $inschrijving->gebruiker = $this->gebruiker_model->get($inschrijving->gebruikerId);
        }
        
        return $inschrijvingen;
    }

    }*/

    function getPerOnderdeel($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('inschrijving');
        $sessie = $query->row();
        
        return $inschrijving;
    }


    function getInschrijvingen($id)
    {
	
        $this->db->where('conferentieId',$id);
	$query = $this->db->get('conferentieOnderdeel');
	$onderdelen = $query->result();

	foreach ($onderdelen as $onderdeel)
	{	
		$onderdeel->inschrijving = $this->getPerOnderdeel($onderdeel->id);		
	}
        
	$this->load->model('gebruiker_model');
        foreach ($onderdelen as $onderdeel) {
            $onderdeel->gebruiker = $this->gebruiker_model->get($onderdeel->inschrijving->gebruikerId);
        }
        
        return $onderdelen;
    }
}
?>