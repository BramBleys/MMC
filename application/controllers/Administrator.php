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
        //De Template library inladen
        $this->load->library('Template');
    }

    public function index(){
        //titel veranderen naar Parameters
        $data['titel'] = 'Parameters';
        //Login nakijken
        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        //Templates definieren en inladen
        $partials = array( 'navigatie' => 'main_menu', 'inhoud' => 'administrator/parameters');
        $this->template->load('main_master', $partials, $data);
    }

    public function parametersOpslagen(){
        //titel veranderen naar Opgeslagen
        $data['titel'] = 'Opgeslagen';
        //Login nakijken
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        //Variabel aanmaken om parameters in op te slagen
        $parameters = new stdClass();

        //Ingevulde parameters opslagen in het variabel
        $parameters->maxRitten = $this->input->post('maxRitten');
        $parameters->prijsPerKM = $this->input->post('prijsPerKM');
        $parameters->annulatieTijd = $this->input->post('annulatieTijd');

        //in data stoppen
        $data['parameters'] = $parameters;

        //Parameters model laden en de database updaten
        $this->load->model('Parameters_model');
        $this->parameters_model->update($parameters);

        //bevestiging pagina tonen
        $partials = array( 'navigatie' => 'main_menu', 'inhoud' => 'administrator/parametersBevestiging');
        $this->template->load('main_master', $partials, $data);


    }
}