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

        public function uitloggen() {
            //meld de gebruiker af
            $this->authex->meldAf();
            redirect('home/index');
        }

        public function inloggen() {
            $data['titel'] = "Inloggen";
            //haal gebruiker op en laat bijhorende zijbalk zien op homepagina
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'gebruiker/inloggen'
            );

            $this->template->load('main_master', $partials, $data);
        }

        public function controleerInloggen() {
            //haal email en wachtwoord uit formulier op
            $email = $this->input->post('email');
            $wachtwoord = $this->input->post('wachtwoord');

            //controleer of email en wachtwoord overeen komen
            if ($this->authex->meldAan($email, $wachtwoord)) {
                //toon homepagina
                redirect('home/index');
            } else {
                //toon fout
                redirect('home/toonFout');
            }
        }

        public function toonFout() {
            $data['titel'] = 'Fout';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'home_fout'
            );

            $this->template->load('main_master', $partials, $data);
        }
    }