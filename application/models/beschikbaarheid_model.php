<?php


    class beschikbaarheid_model extends CI_Model {
        function __construct() {
            parent::__construct();
        }

        function getBeschikbaarheid($gebruikerId) {
            $this->db->where('gebruikerId', $gebruikerId);
            $query = $this->db->get('vrijwilliger');
            return $query->result();
        }

        function getBeschikbaarheidWhereStartDatumEnEindDatum($gebruikerId, $startDatum, $eindDatum) {
            $this->db->where('gebruikerId', $gebruikerId);
            $query = $this->db->get('vrijwilliger');
            $beschikbaarheid = $query->result();
            $teller = 0;

            foreach ($beschikbaarheid as $value) {
                $correcteDatums[$teller] = new stdClass();

                $dag = date('Y-m-d', strtotime($value->beschikbaarVan));

                if ($dag >= $startDatum && $dag <= $eindDatum) {
                    $correcteDatums[$teller]->dag = $dag;
                    $correcteDatums[$teller]->startUur = date("H:i", strtotime($value->beschikbaarVan));
                    $correcteDatums[$teller]->eindUur = date("H:i", strtotime($value->beschikbaarTot));
                    $teller++;
                }
            }

            return $correcteDatums;
        }
    }