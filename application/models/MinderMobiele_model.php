<?php

class MinderMobiele_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatum($gebruikerId)
    {
        // geef gebruiker-object met opgegeven $id met de geplande ritten
        $nu = date('Y-m-d H:i:s');
        $this->db->order_by('vertrekTijdstip');
        $this->db->where('gebruikerIdMinderMobiele', $gebruikerId);
        $this->db->where('vertrekTijdstip >', $nu);
        $query = $this->db->get('rit');
        $ritten = $query->result();

        foreach ($ritten as $rit){
            $rit->chauffeur = $this->MinderMobiele_model->getGebruiker($rit->gebruikerIdVrijwilliger);
            $rit->vertrekAdres = $this->MinderMobiele_model->getAdres($rit->adresIdVertrek);
            $rit->bestemmingAdres = $this->MinderMobiele_model->getAdres($rit->adresIdBestemming);
        }
        return $ritten;
    }

    function getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatumOuder($gebruikerId)
    {
        // geef gebruiker-object met opgegeven $id met de geplande ritten
        $nu = date('Y-m-d H:i:s');
        $this->db->order_by('vertrekTijdstip');
        $this->db->where('gebruikerIdMinderMobiele', $gebruikerId);
        $this->db->where('vertrekTijdstip <', $nu);
        $query = $this->db->get('Rit');
        $ritten = $query->result();

        foreach ($ritten as $rit){
            $rit->chauffeur = $this->MinderMobiele_model->getGebruiker($rit->gebruikerIdVrijwilliger);
            $rit->vertrekAdres = $this->MinderMobiele_model->getAdres($rit->adresIdVertrek);
            $rit->bestemmingAdres = $this->MinderMobiele_model->getAdres($rit->adresIdBestemming);
        }
        return $ritten;
    }

    function getGebruiker($gebruikerId){
        $this->db->where('id', $gebruikerId);
        $query = $this->db->get('gebruiker');
        $gebruiker = $query->row();
        return $gebruiker;
    }

    function getAdres($adresId){
        $this->db->where('id', $adresId);
        $query = $this->db->get('adres');
        $adres = $query->row();
        return $adres;
    }
}
