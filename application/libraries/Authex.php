<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * @class Authex
     * @brief Library voor inloggen en sessies
     *
     * Library met alle methodes rond inloggen en sessies
     */
class Authex {

    /**
     * Constructor
     */
    public function __construct() {
        $CI = &get_instance();
        $CI->load->model('gebruiker_model');
    }

    /**
     * Controleert of er een gebruiker is aangemeld via Authex::isAangemeld() . Indien er niemand is aangemeld gebeurd er niets, anders wordt er een sessie aangemaakt met de gebruikerId uit Gebruiker_model
     *
     * @see Authex::isAangemeld()
     * @see Gebruiker_model::get()
     * @return Een gebruiker object
     */
    function getGebruikerInfo() {
        // geef gebruiker-object als gebruiker aangemeld is
        $CI = &get_instance();

        if (!$this->isAangemeld()) {
            return null;
        } else {
            $id = $CI->session->userdata('gebruiker_id');
            return $CI->gebruiker_model->get($id);
        }
    }

    /**
     * Controleert of er al een sessie bestaat voor de gebruiker
     *
     * @return true of false naargelang de gebruiker is aangemeld of niet is aangemeld
     */
    function isAangemeld() {
        // gebruiker is aangemeld als sessievariabele gebruiker_id bestaat
        $CI = &get_instance();

        if ($CI->session->has_userdata('gebruiker_id')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Meldt de gebruiker aan als gebruikersnaam en wachtwoord overeen komen met de database via Gebruiker_model
     * @param $gebruikersnaam De gebruikersnaam
     * @param $wachtwoord Het wachtwoord
     * @return true of false naargelang de gegevens correct of niet correct zijn
     *
     * @see Gebruiker_model::getGebruikerLogin()
     */
    function meldAan($gebruikersnaam, $wachtwoord) {
        // gebruiker aanmelden met opgegeven gebruikersnaam en wachtwoord
        $CI = &get_instance();

        $gebruiker = $CI->gebruiker_model->getGebruikerLogin($gebruikersnaam, $wachtwoord);

        if ($gebruiker == null) {
            return false;
        } else {
            $CI->session->set_userdata('gebruiker_id', $gebruiker->id);
            return true;
        }
    }

    /**
     * Meldt de gebruiker af door sessie weg te doen
     */
    function meldAf() {
        // afmelden, dus sessievariabele wegdoen
        $CI = &get_instance();

        $CI->session->unset_userdata('gebruiker_id');
    }
}