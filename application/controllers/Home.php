<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['titel'] = 'Home';

        $this->load->model('bezoeker_model');
        $data['gebruiker'] = $this->bezoeker_model->get("1");

        $partials = array( 'navigatie' => 'main_bezoeker', 'inhoud' => 'gebruiker/home');
        $this->template->load('main_master', $partials, $data);

        //$this->load->view('mmc');
    }

    public function uitloggen(){

    }





}