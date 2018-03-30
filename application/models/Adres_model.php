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

    function getIdWhereStraatEnGemeenteEnPostcode($adres){
        $this->db->where('straatEnNummer', $adres->straatEnNummer);
        $this->db->where('gemeente', $adres->gemeente);
        $this->db->where('postcode', $adres->postcode);
        $query = $this->db->get('adres');
        $adres = $query->row();
        if($adres!=NULL){
            return $adres->id;
        }
    }

    function insert($adres)
    {
        $this->db->insert('adres', $adres);
        return $this->db->insert_id();
    }
}