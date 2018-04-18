<?php
/**
 * Created by PhpStorm.
 * User: Kix
 * Date: 3/28/2018
 * Time: 12:17 PM
 */

class Coach_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getGebruikerWhereCoach($coachId){
        $this->db->where('gebruikerIdCoach',$coachId);
        $query = $this->db->get('coach');
        $gebruikerIds = $query->result();
        return $gebruikerIds;
    }

}