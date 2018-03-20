<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Home extends CI_Controller {

        public function __construct() {
            parent::__construct();
        }

        public function index() {
            //laat de home pagina zien
            $data['titel'] = 'Home';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'gebruiker/home'
            );
            $this->template->load('main_master', $partials, $data);
        }

        public function inloggen() {
            $data['titel'] = "Inloggen";
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'gebruiker/inloggen'
            );

            $this->template->load('main_master', $partials, $data);
        }

        public function uitloggen() {
            //meld de gebruiker af
            $this->authex->meldAf();
            redirect('home/index');
        }

        public function controleerInloggen() {
            //haal email en wachtwoord uit formulier op
            $gebruikersnaam = $this->input->post('gebruikersnaam');
            $wachtwoord = $this->input->post('wachtwoord');

            //controleer of email en wachtwoord overeen komen
            if ($this->authex->meldAan($gebruikersnaam, $wachtwoord)) {
                //toon homepagina
                redirect('home/index');
            } else {
                //toon fout
                redirect('home/toonFout');
            }
        }

        public function toonFout() {
            //laad de view Home_fout
            $data['titel'] = 'Fout';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'home_fout'
            );

            $this->template->load('main_master', $partials, $data);
        }

        public function accountBeheren(){
            //laad de view accountBeheren
            $data['titel'] = 'Account beheren';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'gebruiker/accountBeheren'
            );

            $this->template->load('main_master', $partials, $data);
        }

        public function gegevensOpslaan(){
            $data['titel'] = 'Home';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

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
            $gegevens->contactvorm = $this->input->post('contactvorm');

            $data['gegevens'] = $gegevens;

            $this->load->model('gebruiker_model');
            $this->gebruiker_model->update($gegevens);

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'gebruiker/gegevensBevestiging');
            $this->template->load('main_master', $partials, $data);
        }
    }