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

    function getAll() {
        $this->db->order_by('vertrekTijdstip');
        $query = $this->db->get('rit');
        return $query->result();
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

    function getWhereDatum($gebruikerId, $datum)
    {
        $date = strtotime($datum);
        $weekDag = date('w', $date);
        if ($weekDag != 1){
            $startdate = strtotime("last monday", $date);
            $enddate = strtotime("monday", $date);

        } else {
            $startdate = strtotime("today", $date);
            $enddate = strtotime("next monday", $date);
        }
        $startdate = date('Y-m-d H:i:s', $startdate);
        $enddate = date('Y-m-d H:i:s', $enddate) ;
        $this->db->order_by('vertrekTijdstip');
        $this->db->where('gebruikerIdMinderMobiele', $gebruikerId);
        $this->db->where('vertrekTijdstip >', $startdate);
        $this->db->where('vertrekTijdstip <', $enddate);
        $this->db->where('ritIdHeenrit', NULL);

        $query = $this->db->get('rit');
        $ritten = $query->result();

        return $ritten;
    }

    function getAllByDatumWithGebruikerEnAdres()
    {
        $this->db->order_by('vertrekTijdstip');
        $query = $this->db->get('rit');
        $ritten = $query->result();

        foreach ($ritten as $rit){
            $this->load->model('Gebruiker_model');
            $rit->minderMobiele = $this->Gebruiker_model->getGebruiker($rit->gebruikerIdMinderMobiele);
            $rit->chauffeur = $this->Gebruiker_model->getGebruiker($rit->gebruikerIdVrijwilliger);
            $this->load->model('Adres_model');
            $rit->vertrekAdres = $this->Adres_model->getAdres($rit->adresIdVertrek);
            $rit->bestemmingAdres = $this->Adres_model->getAdres($rit->adresIdBestemming);
        }
        return $ritten;
    }

    function getRitWithGebruikerEnAdres($ritId)
    {
        $this->db->where('id', $ritId);
        $query = $this->db->get('rit');
        $rit = $query->row();

        $this->load->model('Gebruiker_model');
        $rit->minderMobiele = $this->Gebruiker_model->getGebruiker($rit->gebruikerIdMinderMobiele);
        $rit->chauffeur = $this->Gebruiker_model->getGebruiker($rit->gebruikerIdVrijwilliger);

        $this->load->model('Coach_model');
        $coach = $this->Coach_model->getCoachWhereMinderMobiele($rit->minderMobiele->id);
        $coachId = $coach->gebruikerIdCoach;
        $rit->coach = $this->Gebruiker_model->getGebruiker($coachId);

        $this->load->model('Adres_model');
        $rit->vertrekAdres = $this->Adres_model->getAdres($rit->adresIdVertrek);
        $rit->bestemmingAdres = $this->Adres_model->getAdres($rit->adresIdBestemming);

        return $rit;
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