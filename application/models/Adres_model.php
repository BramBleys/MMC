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
     * @param $adresId De id van het adres waar we informatie over nodig hebben
     * @return Een object van het adres-record
     */
    function getAdres($adresId){
        $this->db->where('id', $adresId);
        $query = $this->db->get('adres');
        $adres = $query->row();
        return $adres;
    }

    /**
     * Retourneert het id van de adres-record met straatEnNummer = $adres->straatEnNummer, gemeente = $adres->gemeente en postcode = $adres->postcode
     * @param $adres Het adres object waarvan we willen zien of het in de database zit
     * @return De id van het adres-record (indien het adres aanwezig is)
     */
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

    /**
     * Maakt een nieuw adres-record aan met record = $adres, retourneert de id van het toegevoegde record
     * @param $adres Het adres object dat we willen toevoegen aan de database
     * @return De id van het toegevoegde record
     */
    function insert($adres)
    {
        $this->db->insert('adres', $adres);
        return $this->db->insert_id();
    }
}