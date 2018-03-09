<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bezoeker extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function login() {
        $data['titel'] = 'Inloggen';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();



        $this->template->load('main_master', $partials, $data);
    }
}