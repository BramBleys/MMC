<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Kix
 * Date: 3/9/2018
 * Time: 1:20 PM
 */

class Administrator extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->library('Template');
    }

    public function index(){
        $data['titel'] = 'Parameters';

        $partials = array( 'navigatie' => 'main_gebruiker', 'inhoud' => 'administrator/parameters');
        $this->template->load('main_master', $partials, $data);
    }

    public function parametersOpslagen(){
        $data['titel'] = 'Opgeslagen';
        $parameters = new stdClass();

        $parameters->maxRitten = $this->input->post('maxRitten');
        $parameters->prijsPerKM = $this->input->post('prijsPerKM');
        $parameters->annulatieTijd = $this->input->post('annulatieTijd');

        $data['parameters'] = $parameters;

        $this->load->model('administrator_model');
        $this->administrator_model->update($parameters);

        $partials = array( 'navigatie' => 'main_gebruiker', 'inhoud' => 'administrator/parametersBevestiging');
        $this->template->load('main_master', $partials, $data);


    }
}