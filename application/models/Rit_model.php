<?php
/**
 * Created by PhpStorm.
 * User: Kix
 * Date: 3/28/2018
 * Time: 12:17 PM
 */

class Rit_model extends CI_Model {

    function get($id){
        $this->db->where('id', $id);
        $query = $this->db->get('rit');
        $rit = $query->row();
        return $rit;
    }

    function getAllRitten($gebruikerId){
        $this->db->where('gebruikerIdVrijwilliger', $gebruikerId);
        $query = $this->db->get('rit');
        return $query->result();
    }

    function getByHeenRit($id){
        $this->db->where('ritIdHeenrit', $id);
        $query = $this->db->get('rit');
        $rit = $query->row();
        return $rit;
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
            $this->load->model('Gebruiker_model');
            $rit->chauffeur = $this->Gebruiker_model->getGebruiker($rit->gebruikerIdVrijwilliger);
            $this->load->model('Adres_model');
            $rit->vertrekAdres = $this->Adres_model->getAdres($rit->adresIdVertrek);
            $rit->bestemmingAdres = $this->Adres_model->getAdres($rit->adresIdBestemming);
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
            $this->load->model('Gebruiker_model');
            $rit->chauffeur = $this->Gebruiker_model->getGebruiker($rit->gebruikerIdVrijwilliger);
            $this->load->model('Adres_model');
            $rit->vertrekAdres = $this->Adres_model->getAdres($rit->adresIdVertrek);
            $rit->bestemmingAdres = $this->Adres_model->getAdres($rit->adresIdBestemming);
        }
        return $ritten;
    }

    function insert($rit)
    {
        $this->db->insert('rit', $rit);
        return $this->db->insert_id();
    }

    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('rit');
    }
}