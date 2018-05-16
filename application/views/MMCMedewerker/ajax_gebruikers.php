<?php

/**
 * @file MMCMedewerker/ajax_gebruikers.php
 *
 */

?>

<table class="table">
    <thead>
        <tr>
            <th>Voornaam</th>
            <th>Naam</th>
            <th>E-mail</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php

    foreach ($gebruikers as $gebruiker) {

        if($soortId == 6) {
            if($gebruiker->inactief == 0) {
                echo "<tr>\n" .
                    "<td>" . $gebruiker->voornaam . "</td>\n" .
                    "<td>" . $gebruiker->naam . "</td>\n" .
                    "<td>" . $gebruiker->email . "</td>\n" .
                    "<td>" .
                    "<i class=\"material-icons\">" .
                    anchor('/MMCMedewerker/gebruikerBewerken/' . $gebruiker->id,'edit') .
                    "</i>\n" .
                    "<i class=\"material-icons\">" .
                    anchor('/MMCMedewerker/rittenBekijken/' . $gebruiker->id, 'directions_car') .
                    "</i>\n" .
                    "</td>\n" .
                    "</tr>\n";
            }
        } elseif($gebruiker->inactief == 1) {
            //tabel opvullen voor gebruikers met meerdere types
            if (strlen($gebruiker->soortId) > 1) {

                //meerdere types opsplitsen
                $soortIdArray = str_split($gebruiker->soortId);

                //tabel opvullen
                for ($i = 0; $i < count($soortIdArray); $i++) {
                    if ($soortId == $soortIdArray[$i]) {
                        echo "<tr>\n" .
                            "<td>" . $gebruiker->voornaam . "</td>\n" .
                            "<td>" . $gebruiker->naam . "</td>\n" .
                            "<td>" . $gebruiker->email . "</td>\n" .
                            "<td>" .
                            "<i class=\"material-icons\">" .
                            anchor('/MMCMedewerker/gebruikerBewerken/' . $gebruiker->id,'edit') .
                            "</i>\n" .
                            "<i class=\"material-icons\">" .
                            anchor('/MMCMedewerker/rittenBekijken/' . $gebruiker->id, 'directions_car') .
                            "</i>\n" .
                            "</td>\n" .
                            "</tr>\n";
                    }
                }
            }

            //tabel opvullen voor gebruikers met 1 type
            if ($soortId == $gebruiker->soortId) {
                echo "<tr>\n" .
                    "<td>" . $gebruiker->voornaam . "</td>\n" .
                    "<td>" . $gebruiker->naam . "</td>\n" .
                    "<td>" . $gebruiker->email . "</td>\n" .
                    "<td>" .
                    "<i class=\"material-icons\">" .
                    anchor('/MMCMedewerker/gebruikerBewerken/' . $gebruiker->id,'edit') .
                    "</i>\n" .
                    "<i class=\"material-icons\">" .
                    anchor('/MMCMedewerker/rittenBekijken/' . $gebruiker->id, 'directions_car') .
                    "</i>\n" .
                    "</td>\n" .
                    "</tr>\n";
            }
        }
    }
    ?>
    </tbody>
</table>