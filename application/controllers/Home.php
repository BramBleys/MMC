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

            $this->load->model('gebruiker_model');
            $data['inhoud'] = $this->gebruiker_model->getInhoud("1");

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'bezoeker/home'
            );
            $this->template->load('main_master', $partials, $data);
        }

        public function contact(){
            $data['titel'] = 'Contact';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            $this->load->model('gebruiker_model');
            $data['inhoud'] = $this->gebruiker_model->getInhoud("5");

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'bezoeker/contact'
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

            //controleer of gebruikersnaam en wachtwoord overeen komen
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
    }