<?php

class Bezoeker_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get($id) {
        // geef gebruiker-object met opgegeven $id
        $this->db->where('id', $id);
        $query = $this->db->get('Gebruiker');
        return $query->row();
    }

    function getGebruiker($gebruikersnaam, $wachtwoord) {
        // geef gebruiker-object met gebruikersnaam en wachtwoord
        $this->db->where('gebruikersnaam', $gebruikersnaam);
        $query = $this->db->get('Gebruiker');

        if ($query->num_rows() == 1) {
            $gebruiker = $query->row();
            // controleren of het wachtwoord overeenkomt
            if ($wachtwoord == $gebruiker->wachtwoord) {
                return $gebruiker;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    function getGebruikerWithSoort($id) {
        //geef gebruiker-object met soort door opgegeven $id
        $this->db->order_by('id', 'asc');

        $query = $this->db->where('id', $id);
        $gebruiker = $query->row();

        $this->load->model('soort_model');
        $gebruiker->soort = $this->soort_model->getSoort($gebruiker->id);

        return $gebruiker;
    }

    /*function getTekst($paginaId) {
        $this->db->order_by('id', 'asc');

        $query = $this->db->where('id', $paginaId);
        return $query->result();
    }*/
}

