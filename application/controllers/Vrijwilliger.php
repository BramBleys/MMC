<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Vrijwilliger extends CI_Controller {
        public function __construct() {
            parent::__construct();
        }

        public function beschikbaarheidIngeven(){
            //titel veranderen naar Parameters
            $data['titel'] = 'Beschikbaarheid ingeven';
            //Login nakijken
            $data['gebruiker'] = $this->authex->getGebruikerInfo();

            //Templates definieren en inladen
            $partials = array( 'navigatie' => 'main_menu', 'inhoud' => 'vrijwilliger/beschikbaarheidIngeven');
            $this->template->load('main_master', $partials, $data);
        }
    }