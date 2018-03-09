<?php
$extraButton = array('class' => 'btn btn-warning btn-xs btn-round',
    'data-toggle' => 'tootlip', 'title' => 'Brouwerij Toevoegen');
$button = form_button("knopnieuw", "<span class=\"glyphicon glyphicon-plus\"></span>", $extraButton);
echo '<p>' . anchor('brouwerij/maakNieuwe', $button) . '</p>';

if(count($geplanderitten)!=0){
    echo "<table class=\"table table-hover\">\n";
    echo "   <thead>\n";
    echo "    <tr>\n";
    echo "        <th>Datum</th>\n";
    echo "        <th>Uur</th>\n";
    echo "        <th>Vertrek adres</th>\n";
    echo "        <th>Bestemming</th>\n";
    echo "        <th>Bestuurder</th>\n";
    echo "        <th>Bedrag</th>\n";
    echo "        <th></th>\n";
    echo "    </tr>\n";
    echo "    </thead>\n";
    echo "    <tbody>\n";

    foreach ($geplanderitten as $rit) {
        $wijzigknop = "<button type=\"button\" class=\"btn btn-success btn-xs btn-round\">"
            . "<span class=\"glyphicon glyphicon-pencil\"></span></button>";
        $verwijderknop = "<button type=\"button\" class=\"btn btn-danger btn-xs btn-round\">"
            . "<span class=\"glyphicon glyphicon-remove\"></span></button>";
        echo "<tr>\n<td>" . $rit->vertrekTijdstip . "</td>\n<td>"
            . $rit->vertrekTijdstip . "</td>\n<td>"
            //. ($brouwerij->oprichting != "0000-00-00" ? zetOmNaarDDMMYYYY($brouwerij->oprichting) : "")
            . $rit->vertrekAdres->straatEnNummer . ", " . $rit->vertrekAdres->postcode . " " . $rit->vertrekAdres->gemeente
            . "</td>\n<td>"
            . $rit->bestemmingAdres->straatEnNummer . ", " . $rit->bestemmingAdres->postcode . " " . $rit->bestemmingAdres->gemeente
            . "</td>\n<td>"
            . $rit->bestuurder->voornaam . " " . $rit->bestuurder-naam
            . "</td>\n<td>"
            . "€5800"
            . "</td>\n<td>"
            . anchor("minderMobiele/wijzig/rit->id", $wijzigknop)
            . " " . anchor("minderMobile/schrap/rit->id", $verwijderknop)
            . "</td>\n</tr>\n";
    }
    echo"    </tbody>\n";
    echo"</table>\n";
}
else{
    echo "<p>Je hebt geen geplande ritten.";
}
?>


<hr>

<?php

echo '<p>' . anchor('home', 'Terug') . '</p>';
?>
