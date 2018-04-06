<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<h2><?= $titel ?></h2>
<?php
$extraButton = array('class' => 'btn achtergrond');
$button = form_button("knopNieuw", "Nieuwe rit", $extraButton);
echo '<p class="marginTop">' . anchor('minderMobiele/nieuweRit', $button) . ' ';

$extraButton = array('class' => 'btn achtergrond');
$button = form_button("knopAfgelopen", "Agelopen ritten", $extraButton);
echo anchor('minderMobiele/afgelopenRitten', $button) . '</p>';

$wijzigknop = "<i class=\"fas fa-pencil-alt\" style=\"color:black\"></i>";
$verwijderknop = "<i class=\"fas fa-times\" style=\"color:black\"></i>";

if(count($ritten)!=0){
    echo "<table class=\"table table-hover marginTop\">\n";
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

    foreach ($ritten as $rit) {
        $spatie = strpos($rit->vertrekTijdstip, " ");
        echo "<tr>\n<td>" . zetOmNaarDDMMYYYY(substr($rit->vertrekTijdstip,0, $spatie)) . "</td>\n<td>"
            . substr($rit->vertrekTijdstip, $spatie+1, 5) . "</td>\n<td>"
            . $rit->vertrekAdres->straatEnNummer . ", " . $rit->vertrekAdres->postcode . " " . $rit->vertrekAdres->gemeente
            . "</td>\n<td>"
            . $rit->bestemmingAdres->straatEnNummer . ", " . $rit->bestemmingAdres->postcode . " " . $rit->bestemmingAdres->gemeente
            . "</td>\n<td>";
            if ($rit->chauffeur){
                echo $rit->chauffeur->voornaam . " " . $rit->chauffeur->naam;
            } else {
                echo "Er is nog geen chauffeur toegewezen";
            }
            echo "</td>\n<td>"
            . "€5800"
            . "</td>\n<td>"
            . anchor("minderMobiele/wijzigRit/$rit->id", $wijzigknop, 'data-toggle="tooltip" data-placement="bottom" title="rit bewerken"')
            . " " . anchor("minderMobiele/schrap/$rit->id", $verwijderknop, 'data-toggle="tooltip" data-placement="bottom" title="rit annuleren"')
            . "</td>\n</tr>\n";
    }
    echo"    </tbody>\n";
    echo"</table>\n";
}
else{
    echo "<p>Je hebt geen geplande ritten.</p>\n";
}
?>