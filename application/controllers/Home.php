<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['titel'] = 'Home';

        $partials = array('navigatie' => 'main_bezoeker', 'inhoud' => 'gebruiker/home');
        $this->template->load('main_master', $partials, $data);
    }

    public function uitloggen() {

    }

    public function inloggen() {
        $data['titel'] = "Inloggen";

        $partials = array('navigatie' => 'main_bezoeker', 'inhoud' => 'gebruiker/inloggen');
        $this->template->load('main_master', $partials, $data);
    }

    public function controleerInloggen() {
        $email = $this->input->post('email');
        $wachtwoord = $this->input->post('wachtwoord');

        $data['email'] = $this->input->post('email');
        $data['wachtwoord'] = $this->input->post('wachtwoord');


        if ($this->authex->meldAan($email, $wachtwoord)) {
            // redirect('home/index');
            $this->load->view('gebruiker/home' ,$data);
        } else {
            //redirect('home/index');
            $this->load->view('gebruiker/home', $data);
        }
    }
}