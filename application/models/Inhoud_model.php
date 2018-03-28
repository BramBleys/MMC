<?php
/**
 * Created by PhpStorm.
 * User: Kix
 * Date: 3/28/2018
 * Time: 12:17 PM
 */

class Inhoud_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getInhoud($paginaId){
        $this->db->order_by('naam', 'ASC');
        $this->db->where('paginaId', $paginaId);
        $query = $this->db->get('inhoud');

        return $query->result();
    }

}