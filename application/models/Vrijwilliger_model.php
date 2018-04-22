<?php

    class Vrijwilliger_model extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        function getBeschikbaarheid($gebruikerId) {
            $this->db->where('gebruikerId', $gebruikerId);
            $query = $this->db->get('vrijwilliger');
            return $query->result();
        }

        function getBeschikbaarheidWhereStartDatumEnEindDatum($gebruikerId, $startDatum, $eindDatum) {
            $this->db->order_by('beschikbaarVan');
            $this->db->where('gebruikerId', $gebruikerId);
            $query = $this->db->get('vrijwilliger');
            $beschikbaarheid = $query->result();
            $teller = 0;
            $correcteDatums[0] = new stdClass();
            foreach ($beschikbaarheid as $value) {
                $dag = date('Y-m-d', strtotime($value->beschikbaarVan));

                if ($dag >= $startDatum && $dag <= $eindDatum) {
                    if ($teller == 0) {
                        $correcteDatums[$teller]->dag = $dag;
                        $correcteDatums[$teller]->startUur = date("H:i", strtotime($value->beschikbaarVan));
                        $correcteDatums[$teller]->eindUur = date("H:i", strtotime($value->beschikbaarTot));
                        $teller++;
                    } else {
                        $correcteDatums[$teller] = new stdClass();
                        $correcteDatums[$teller]->dag = $dag;
                        $correcteDatums[$teller]->startUur = date("H:i", strtotime($value->beschikbaarVan));
                        $correcteDatums[$teller]->eindUur = date("H:i", strtotime($value->beschikbaarTot));
                        $teller++;
                    }
                }
            }

            return $correcteDatums;
        }

        function schrijfNieuweUrenWeg($gebruikerId, $dag, $startUur, $eindUur) {
            $beschikbaarVan = $dag . ' ' . $startUur . ":00";
            $beschikbaarTot = $dag . ' ' . $eindUur . ":00";

            $data = array(
                'gebruikerId' => $gebruikerId,
                'beschikbaarVan' => $beschikbaarVan,
                'beschikbaarTot' => $beschikbaarTot
            );

            $this->db->insert('vrijwilliger', $data);
        }

    }