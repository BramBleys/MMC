<?php
/**
 * @class Coach_model
 * @brief Model-klasse voor de coaches met hun gebruikers
 *
 * Model-klasse die alle methodes bevat om te interageren met de database-tabel coach
 */

class Coach_model extends CI_Model {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Retourneert een object van coach-records met gebruikerIdCoach = $coachId
     * @param $coachId De id van de bijhorende coach
     * @return Een object met coach-records
     */
    function getGebruikerWhereCoach($coachId){
        $this->db->where('gebruikerIdCoach',$coachId);
        $query = $this->db->get('coach');
        $gebruikerIds = $query->result();
        return $gebruikerIds;
    }

    function getCoachWhereMinderMobiele($minderMobieleId) {
        $this->db->where('gebruikerIdMinderMobiele', $minderMobieleId);
        $query = $this->db->get('coach');

        return $query->row();
    }

}