<?php

class Bezoeker_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get($id) {
        // geef gebruiker-object met opgegeven $id
        $this->db->where('id', $id);
        $query = $this->db->get('gebruiker');
        return $query->row();
    }

    function getGebruiker($email, $wachtwoord) {
        // geef gebruiker-object met $email en $wachtwoord
        $this->db->where('email', $email);
        $query = $this->db->get('gebruiker');

        if ($query->num_rows() == 1) {
            $gebruiker = $query->row();
            // controleren of het wachtwoord overeenkomt
            if (password_verify($wachtwoord, $gebruiker->wachtwoord)) {
                return $gebruiker;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /*function updateWachtwoord($nieuwWachtwoord, $id) {
    $gebruiker = new stdClass();
    $gebruiker->wachtwoord = $nieuwWachtwoord;
    $this->db->where('id', $id);
    $this->db->update('tv_gebruiker', $gebruiker);
    }*/
}

