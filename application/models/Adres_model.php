<?php
/**
 * Created by PhpStorm.
 * User: Kix
 * Date: 3/28/2018
 * Time: 12:17 PM
 */

class Adres_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getAdres($adresId){
        $this->db->where('id', $adresId);
        $query = $this->db->get('adres');
        $adres = $query->row();
        return $adres;
    }

}