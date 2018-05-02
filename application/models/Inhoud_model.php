<?php
    /**
     * @class Inhoud_model
     * @brief Model-klasse voor de inhoud op de pagina
     *
     * Model-klasse die alle methodes bevat om te interageren met de database-tabel inhoud
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

    function getInhoudWhereTypeInhoudId($typeInhoudId){
        $this->db->order_by('id', 'ASC');
        $this->db->where('typeInhoudId', $typeInhoudId);
        $query = $this->db->get('inhoud');

        return $query->result();
    }

        function getInhoudWherePaginaId($paginaId){
            $this->db->order_by('id', 'ASC');
            $this->db->where('paginaId', $paginaId);
            $query = $this->db->get('inhoud');

        return $query->result();
    }

    function getInhoudWhereId($id){
        $this->db->order_by('id', 'ASC');
        $this->db->where('id', $id);
        $query = $this->db->get('inhoud');

        return $query->result();
    }

    function update($sjabloon) {
        //update het sjabloon waar de gebruiker aanpassingen aan heeft gedaan
        $this->db->where('id', $sjabloon->id);
        $this->db->update('inhoud', $sjabloon);
    }

    function leegMaken($sjabloon){
        $this->db->where('id', $sjabloon->id);
        $this->db->update('inhoud', $sjabloon);
    }

    function updateText($teBeherenText1, $teBeherenText2, $teBeherenText3, $teBeherenText4, $teBeherenText5, $teBeherenText6, $teBeherenText7) {
        $this->db->where('id', $teBeherenText1->id);
        $this->db->update('inhoud', $teBeherenText1);
        $this->db->where('id', $teBeherenText2->id);
        $this->db->update('inhoud', $teBeherenText2);
        $this->db->where('id', $teBeherenText3->id);
        $this->db->update('inhoud', $teBeherenText3);
        $this->db->where('id', $teBeherenText4->id);
        $this->db->update('inhoud', $teBeherenText4);
        $this->db->where('id', $teBeherenText5->id);
        $this->db->update('inhoud', $teBeherenText5);
        $this->db->where('id', $teBeherenText6->id);
        $this->db->update('inhoud', $teBeherenText6);
        $this->db->where('id', $teBeherenText7->id);
        $this->db->update('inhoud', $teBeherenText7);
    }
}