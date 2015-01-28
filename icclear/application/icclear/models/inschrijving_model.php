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
	$this->load->model('gebruiker_model');
	$this->load->model('conferentie_model');
	
        $this->db->where('conferentieId',$id);
	$query = $this->db->get('conferentieOnderdeel');
	$onderdelen = $query->result();

	foreach ($onderdelen as $onderdeel)
	{	
		$onderdeel->inschrijving = $this->getPerOnderdeel($onderdeel->id);
		
//		if ($conferentie->id == $inschrijving->onderdeel_model->get($inschrijving->conferentieOnderdeelId)->conferentieId)
//		{
//			$inschrijving->gebruiker = $this->gebruiker_model->get($inschrijving->gebruikerId);
//			$inschrijving->onderdeel = $this->onderdeel_model->get($inschrijving->conferentieOnderdeelId);
//			$inschrijving->conferentie = $this->conferentie_model->get($inschrijving->onderdeel->conferentieId);
//		}
	}
        
        foreach ($onderdelen as $onderd) {
            $onderd->gebruiker = $this->gebruiker_model->get($onderd->inschrijving->gebruikerId);
        }
        
        return $onderdelen;
    }
}
?>