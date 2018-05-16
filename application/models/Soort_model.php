<?php
    /**
     * @class Soort_model
     * @brief Model-klasse voor de soorten gebruikers
     *
     * Model-klasse die alle methodes bevat om te interageren met de database-tabel soort
     */
class Soort_model extends CI_Model {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Retourneert de soort van de gebruiker met gebruikerId = $gebruikerId
     *
     * @param $id de id van de gebruiker
     * @return Een soort object
     */
    function getSoort($id){
        //Geef de soort van de gebruiker afhankelijk van zijn id
        $this->db->order_by('id', 'asc');
        $this->db->where('id', $id);
        $query = $this->db->get('soort');
        return $query->row();
    }
}