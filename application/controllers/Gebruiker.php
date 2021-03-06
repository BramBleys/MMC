<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    /**
     * @class Gebruiker
     * @brief Controller-klasse voor Gebruiker
     *
     * Controller-klasse met alle methodes die gebruikt worden voor de Gebruiker
     */
    class Gebruiker extends CI_Controller {
        /**
         * Constructor
         */
        public function __construct() {
            parent::__construct();
        }

        /**
         * Haalt de gebruiker informatie op via Authex en toont de view accountBeheren.php
         *
         * @see Authex::getGebruikerInfo()
         * @see accountBeheren.php
         */
        public function accountBeheren() {
            //laad de view accountBeheren
            $data['titel'] = 'Account beheren';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            $data['gemaaktDoor'] = "Bram Bleys";


            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'gebruiker/accountBeheren'
            );

            $this->template->load('main_master', $partials, $data);
        }

        /**
         * Haalt de ingevulde informatie op uit de view accountBeheren.php en toont de wijzigingen op de view gegevensBevestiging.php
         *
         * @see accountBeheren.php
         * @see gegevensBevestiging.php
         */
        public function gegevensOpslaan() {
            $data['titel'] = 'Home';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            $data['gemaaktDoor'] = "Bram Bleys";

            //haal alle gegevens op uit het ingevulde formulier en steek ze in een object
            $gegevens = new stdClass();
            $gegevens->id = $this->input->post('hidden');
            $gegevens->voornaam = $this->input->post('voornaam');
            $gegevens->naam = $this->input->post('naam');
            $gegevens->telefoonnummer = $this->input->post('telefoonnummer');
            $gegevens->email = $this->input->post('email');
            $gegevens->gemeente = $this->input->post('gemeente');
            $gegevens->postcode = $this->input->post('postcode');
            $gegevens->straatEnNummer = $this->input->post('straatEnNummer');

            $contactvorm = $this->input->post('contactvorm');
            if($contactvorm === "leeg"){
                $contactvorm = NULL;
            }

            $gegevens->contactvorm = $contactvorm;

            $data['gegevens'] = $gegevens;

            $this->load->model('gebruiker_model');
            $this->gebruiker_model->update($gegevens);

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'gebruiker/gegevensBevestiging');
            $this->template->load('main_master', $partials, $data);
        }
    }