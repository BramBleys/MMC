<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Kix
 * Date: 3/9/2018
 * Time: 1:20 PM
 */

class MinderMobiele extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('Template');
    }

    public function index()
    {
        $data['titel'] = 'Mijn geplande ritten';

        /**
        $this->load->model('minderMobiele_model');
        $data['geplanderitten'] = $this->minderMobiele_model->getAllWithGebruikerenAdresWherePassagierEnDate();
        */
        $geplandeRitten = array();
        $data['geplanderitten'] = $geplandeRitten;

        $partials = array( 'navigatie' => 'main_gebruiker',
            'inhoud' => 'minderMobiele/geplandeRitten');
        $this->template->load('main_master', $partials, $data);
    }
}