<?php

    /**
     * @class Inhoud_model
     * @brief Model-klasse voor de inhoud op de pagina
     *
     * Model-klasse die alle methodes bevat om te interageren met de database-tabel inhoud
     *
     */
class Inhoud_model extends CI_Model {

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Retourneert een array van teksten voor de pagina met paginaId = $paginaId
     * @param $paginaId De id van de pagina waar we de inhoud van willen opvragen
     * @return Een array van teksten voor op de pagina
     */
    function getInhoud($paginaId){
        $this->db->order_by('naam', 'ASC');
        $this->db->where('paginaId', $paginaId);
        $query = $this->db->get('inhoud');

        return $query->result();
    }

    /**
     * Retourneert de records met typeInhoudId=$typeInhoudId uit de tabel inhoud
     *
     * @param $typeInhoudId de typeInhoudId van de records dat opgevraagd worden
     * @return de opgevraagde records
     */
    function getInhoudWhereTypeInhoudId($typeInhoudId){
        $this->db->order_by('id', 'ASC');
        $this->db->where('typeInhoudId', $typeInhoudId);
        $query = $this->db->get('inhoud');

        return $query->result();
    }

    /**
     * Retourneert de records met paginaId=$paginaId uit de tabel inhoud
     *
     * @param $paginaId de paginaId van de records dat opgevraagd worden
     * @return de opgevraagde records
     */
    function getInhoudWherePaginaId($paginaId){
            $this->db->order_by('id', 'ASC');
            $this->db->where('paginaId', $paginaId);
            $query = $this->db->get('inhoud');

        return $query->result();
    }

    /**
     * Retourneert de records met id=$id uit de tabel inhoud
     *
     * @param $id de id van de records dat opgevraagd worden
     * @return de opgevraagde recrods
     */
    function getInhoudWhereId($id){
        $this->db->order_by('id', 'ASC');
        $this->db->where('id', $id);
        $query = $this->db->get('inhoud');

        return $query->result();
    }

    /**
     * Update de records met id=$sjabloon->id uit de tabel inhoud
     *
     * @param $sjabloon het sjabloon dat geupdate wordt
     */
    function update($sjabloon) {
        //update het sjabloon waar de gebruiker aanpassingen aan heeft gedaan
        $this->db->where('id', $sjabloon->id);
        $this->db->update('inhoud', $sjabloon);
    }

    /**
     * Update de records met id=$sjabloon->id uit de tabel inhoud
     *
     * @param $sjabloon het sjabloon dat geupdate wordt
     */
    function leegMaken($sjabloon){
        $this->db->where('id', $sjabloon->id);
        $this->db->update('inhoud', $sjabloon);
    }

    /**
     * Update de records met id=$teBeherenText->id uit de tabel inhoud
     *
     * @param $teBeherenText de text die geupdate wordt
     */
    function updateText($teBeherenText) {
        $this->db->where('id', $teBeherenText->id);
        $this->db->update('inhoud', $teBeherenText);
    }
}