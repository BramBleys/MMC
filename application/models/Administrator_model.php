<?php
/**
 * Created by PhpStorm.
 * User: Kix
 * Date: 3/9/2018
 * Time: 3:32 PM
 */
class Administrator_model extends CI_Model {



    function __construct()
    {
        parent::__construct();
    }

    function update($parameters)
    {
        $this->db->update('Parameters', $parameters);
    }

}

?>
