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
    }*/

}

function getInschrijvingenPerGebruiker()
{
	$this->load->model('gebruiker_model');
	$this->load->model('onderdeel_model');
	$this->load->model('conferentie_model');
	
	$query = $this->db->get('inschrijving');
	$inschrijvingen = $query->result();
	
	$conferentie = $this->conferentie_model->getActieveConferentie();

	foreach ($inschrijvingen as $inschrijving)
	{	
		$inschrijving->onderdeel = $this->onderdeel_model->get($inschrijving->conferentieOnderdeelId);
		if ($conferentie->id == $inschrijving->onderdeel_model->get($inschrijving->conferentieOnderdeelId)->conferentieId)
		{
			$inschrijving->gebruiker = $this->gebruiker_model->get($inschrijving->gebruikerId);
			$inschrijving->onderdeel = $this->onderdeel_model->get($inschrijving->conferentieOnderdeelId);
			$inschrijving->conferentie = $this->onderdeel_model->getConferentieVanOnderdeel($inschrijving->onderdeel->conferentieId);
		}
	}
}

?>