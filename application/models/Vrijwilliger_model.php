<?php

    /**
     * @class Vrijwilliger_model
     * @brief Model-klasse voor de vrijwilliger
     *
     * Model-klasse die alle methodes bevat om te interageren met de database-tabel vrijwilliger
     */
    class Vrijwilliger_model extends CI_Model {

        /**
         * Constructor
         */
        function __construct() {
            parent::__construct();
        }

        /**
         * Retourneert een array van gegevens voor gebruiker met gebruikerId = $gebruikerId uit de tabel vrijwilliger
         * @param $gebruikerId De id van de gebruiker waar we informatie over nodig hebben
         * @return Een array met alle datums waarop de vrijwilliger beschikbaar is
         */
        function getBeschikbaarheid($gebruikerId) {
            $this->db->where('gebruikerId', $gebruikerId);
            $query = $this->db->get('vrijwilliger');
            return $query->result();
        }

        /**
         * Retourneert een array van datums tussen beschikbaarVan = $startDatum en beschikbaarTot = $eindDatum voor gebruikerId = $gebruikerId uit de tabel vrijwilliger
         * @param $gebruikerId De id van de vrijwilliger waar we informatie over nodig hebben
         * @param $startDatum De start datum vanaf waar we beginnen te zoeken
         * @param $eindDatum De eind datum tot waar we moeten zoeken
         * @return Een array met alle datums tussen $startDatum en $eindDatum voor de vrijwilliger
         */
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

        /**
         * Maakt een nieuwe rij aan in de tabel vrijwilliger met gebruikerId = $gebruikerId, beschikbaarVan = $dag + $startUur, beschikbaarTot = $dag + $einduur
         * @param $gebruikerId De id van de vrijwilliger waarvoor we informatie willen wegschrijven
         * @param $dag De dag die we willen wegschrijven
         * @param $startUur Het start uur voor die dag
         * @param $eindUur het eind uur voor die dag
         */
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