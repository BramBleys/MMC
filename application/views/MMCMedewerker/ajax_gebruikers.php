<?php
/*
//controleren of de gebruiker meer als 1 type gebruiker is. (Bv Coach en vrijwilliger)
if (strlen($gebruiker->soortId) > 1) {
    $idArray = str_split($gebruiker->soortId); //meerdere types opsplitsen
    for ($i = 0; $i < count($idArray); $i++) { //balk opvullen voor gebruiker van meerdere types

    }
} else {

}

*/?>


<table class="table">
    <thead>
        <tr>
            <th>Voornaam</th>
            <th>Naam</th>
            <th>E-mail</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="collapse show no-transition" id="MinderMobielen" aria-labelledby="navButtons" data-parent="#accordion">
    <?php

    foreach ($gebruikers as $gebruiker) {
        if ($soortId == 1) {

            echo "<tr>\n" .
                "<td>" . $gebruiker->voornaam . "</td>\n" .
                "<td>" . $gebruiker->naam . "</td>\n" .
                "<td>" . $gebruiker->email . "</td>\n" .
                "<td>" .
                "<i class=\"material-icons\"><a href=\"\">edit</a></i>\n" .
                "<i class=\"material-icons\"><a href=\"\">directions_car</a></i>\n" .
                "</td>\n" .
                "</tr>\n";
        }
    }

                ?>
    </tbody>
</table>