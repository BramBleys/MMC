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
        $this->db->where('passagierId', $gebruikerId);
        $this->db->where('vertrekTijdstip >', $nu);
        $query = $this->db->get('Rit');
        $ritten = $query->result();

        foreach ($ritten as $rit){
            $rit->chauffeur = $this->MinderMobiele_model->getGebruiker($rit->chauffeurId);
            $rit->vertrekAdres = $this->MinderMobiele_model->getAdres($rit->vertrekAdresId);
            $rit->bestemmingAdres = $this->MinderMobiele_model->getAdres($rit->bestemmingAdresId);
        }
        return $ritten;
    }

    function getAllByDatumWithGebruikerEnAdresWhereGebruikerEnDatumOuder($gebruikerId)
    {
        // geef gebruiker-object met opgegeven $id met de geplande ritten
        $nu = date('Y-m-d H:i:s');
        $this->db->order_by('vertrekTijdstip');
        $this->db->where('passagierId', $gebruikerId);
        $this->db->where('vertrekTijdstip <', $nu);
        $query = $this->db->get('Rit');
        $ritten = $query->result();

        foreach ($ritten as $rit){
            $rit->chauffeur = $this->MinderMobiele_model->getGebruiker($rit->chauffeurId);
            $rit->vertrekAdres = $this->MinderMobiele_model->getAdres($rit->vertrekAdresId);
            $rit->bestemmingAdres = $this->MinderMobiele_model->getAdres($rit->bestemmingAdresId);
        }
        return $ritten;
    }

    function getGebruiker($gebruikerId){
        $this->db->where('id', $gebruikerId);
        $query = $this->db->get('Gebruiker');
        $gebruiker = $query->row();
        return $gebruiker;
    }

    function getAdres($adresId){
        $this->db->where('id', $adresId);
        $query = $this->db->get('Adres');
        $adres = $query->row();
        return $adres;
    }
}
