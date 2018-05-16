<?php
    /**
     * @class Adres_model
     * @brief Model-klasse voor de adressen
     *
     * Model-klasse die alle methodes bevat om te interageren met de database-tabel adres
     */

class Adres_model extends CI_Model {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Retourneert een adres object met adresId = $adresId
     * @param $adresId De is van het adres waar we informatie over nodig hebben
     * @return Een adres object
     */
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
        } else {
            return 0;
        }
    }

    function insert($adres)
    {
        $this->db->insert('adres', $adres);
        return $this->db->insert_id();
    }
}