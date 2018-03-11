<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Home extends CI_Controller {

        public function __construct() {
            parent::__construct();
        }

        public function index() {
            $data['titel'] = 'Home';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'gebruiker/home'
            );
            $this->template->load('main_master', $partials, $data);
        }

        public function uitloggen() {
            $this->authex->meldAf();
            redirect('home/index');
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

        public function controleerInloggen() {
            $email = $this->input->post('email');
            $wachtwoord = $this->input->post('wachtwoord');

            if ($this->authex->meldAan($email, $wachtwoord)) {
                redirect('home/index');
            } else {
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