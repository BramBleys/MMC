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
        $this->load->library('Template');
    }

    public function index()
    {
        $data['titel'] = 'Parameters';
        $data['inhoud'] = "het werkt";

        $partials = array( 'navigatie' => 'main_gebruiker');
        $this->template->load('main_master', $partials, $data);

        $this->load->view('minderMobiele/geplandeRitten');
    }
}