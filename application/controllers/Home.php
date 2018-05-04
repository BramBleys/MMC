<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    /**
     * @class Home
     * @brief Controller-klasse voor Bezoekers
     *
     * Controller-klasse met alle methodes die gebruikt worden voor de Bezoeker
     */
    class Home extends CI_Controller {
        /**
         * Constructor
         */
        public function __construct() {
            parent::__construct();
        }

        /**
         * Haalt de inhoud voor de homepagina op via Inhoud_model en toont de view home.php
         *
         * @see Inhoud_model::getInhoud()
         * @see home.php
         */
        public function index() {
            //laat de home pagina zien
            $data['titel'] = 'Home';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            $data['gemaaktDoor'] = "Bram Bleys";

            $this->load->model('inhoud_model');
            $data['inhoud'] = $this->inhoud_model->getInhoud("1");

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'bezoeker/home'
            );
            $this->template->load('main_master', $partials, $data);
        }

        /**
         * Haalt de inhoud voor de contactpagina op via Inhoud_model en toont de view contact.php
         *
         * @see Inhoud_model::getInhoud()
         * @see contact.php
         */
        public function contact(){
            $data['titel'] = 'Contact';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            $data['gemaaktDoor'] = "Bram Bleys";

            $this->load->model('inhoud_model');
            $data['inhoud'] = $this->inhoud_model->getInhoud("5");

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'bezoeker/contact'
            );
            $this->template->load('main_master', $partials, $data);
        }

        /**
         * Toont de view inloggen.php
         *
         * @see inloggen.php
         */
        public function inloggen() {
            $data['titel'] = "Inloggen";
            $data['gebruiker'] = "0";
            $data['gemaaktDoor'] = "Bram Bleys";

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'gebruiker/inloggen'
            );

            $this->template->load('main_master', $partials, $data);
        }

        /**
         * Meldt de gebruiker af door de sessie te laten verlopen via de Authex library
         *
         *@see Authex::meldAf()
         */
        public function uitloggen() {
            //meld de gebruiker af
            $this->authex->meldAf();
            redirect('home/index');
        }

        /**
         * Haalt de parameters op via Parameters_model en toont de view faq.php
         *
         * @see Parameters_model::get()
         * @see faq.php
         */
        public function faq(){
            $data['titel'] = 'FAQ';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            $data['gemaaktDoor'] = "Bram Bleys";

            $this->load->model('parameters_model');
            $data['parameters'] = $this->parameters_model->get();

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'bezoeker/faq'
            );
            $this->template->load('main_master', $partials, $data);
        }

        /**
         * Controleert of de ingegeven gebruikersnaam en het ingegeven wachtwoord overeen komen met de gebruiker in de database. Dit wordt gecontroleert via de Authex library. Als de gegevens overeen komen wordt de gebruiker doorgestuurd naar home.php . Als ze niet overeen komen wordt de gebruiker doorgestuurd naar home_fout.php
         *
         * @see Authex::meldAan()
         * @see home.php
         * @see home_fout.php
         */
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

        /**
         * Toont de view home_fout.php
         *
         * @see home_fout.php
         */
        public function toonFout() {
            //laad de view Home_fout
            $data['titel'] = 'Fout';
            $data['gebruiker'] = $this->authex->getGebruikerInfo();
            $data['gemaaktDoor'] = "Bram Bleys";

            $partials = array(
                'navigatie' => 'main_menu',
                'inhoud' => 'bezoeker/home_fout'
            );

            $this->template->load('main_master', $partials, $data);
        }
    }