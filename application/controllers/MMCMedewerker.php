<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MMCMedewerker extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Template');
    }

    public function index() {
        $data['titel'] = 'Home';

        $partials = array( 'navigatie' => 'main_gebruiker');
        $this->template->load('main_master', $partials, $data);

        //$this->load->view('mmc');
    }
}