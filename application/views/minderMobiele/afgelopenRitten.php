<h2><?= $titel ?></h2>
<?php
$extraButton = array('class' => 'btn achtergrond margin-top');
$button = form_button("knopNieuw", "Nieuwe rit", $extraButton);
echo '<p>' . anchor('minderMobiele/nieuweRit', $button) . ' ';

$extraButton = array('class' => 'btn achtergrond margin-top');
$button = form_button("knopGepland", "Geplande ritten", $extraButton);
echo anchor('minderMobiele', $button) . '</p>';


if(count($ritten)!=0){
    echo "<table class=\"table table-hover\">\n";
    echo "   <thead>\n";
    echo "    <tr>\n";
    echo "        <th>Datum</th>\n";
    echo "        <th>Uur</th>\n";
    echo "        <th>Vertrek adres</th>\n";
    echo "        <th>Bestemming</th>\n";
    echo "        <th>Bestuurder</th>\n";
    echo "        <th>Bedrag</th>\n";
    echo "    </tr>\n";
    echo "    </thead>\n";
    echo "    <tbody>\n";

    foreach ($ritten as $rit) {
        $spatie = strpos($rit->vertrekTijdstip, " ");
        echo "<tr>\n<td>" . zetOmNaarDDMMYYYY(substr($rit->vertrekTijdstip,0, $spatie)) . "</td>\n<td>"
            . substr($rit->vertrekTijdstip, $spatie+1, 5) . "</td>\n<td>"
            . $rit->vertrekAdres->straatEnNummer . ", " . $rit->vertrekAdres->postcode . " " . $rit->vertrekAdres->gemeente
            . "</td>\n<td>"
            . $rit->bestemmingAdres->straatEnNummer . ", " . $rit->bestemmingAdres->postcode . " " . $rit->bestemmingAdres->gemeente
            . "</td>\n<td>"
            . $rit->chauffeur->voornaam . " " . $rit->chauffeur->naam
            . "</td>\n<td>"
            . "€5800"
            . "</td>\n</tr>\n";
    }
    echo"    </tbody>\n";
    echo"</table>\n";
}
else{
    echo "<p>Je hebt geen afgelopen ritten.</p>\n";
}
?>
