<script>
    function haalRittenOp(id) {
        $.ajax({type: "GET",
            url: site_url + "/MinderMobiele/haalJsonOp_AfgelopenRitten",
            data: {gebruikerId: id},
            success: function (result) {
                try {
                    var ritten = jQuery.parseJSON(result);
                    $.each(ritten, function () {
                        var rit = this;
                        var vertrekStraat = this.vertrekAdres.straatEnNummer.trim();
                        var vertrekGemeente = this.vertrekAdres.gemeente.trim();
                        var vertrek = vertrekStraat.replace(' ', '+') + ',' + vertrekGemeente;
                        var bestemmingStraat = this.bestemmingAdres.straatEnNummer.trim();
                        var bestemmingGemeente = this.bestemmingAdres.gemeente.trim();
                        var bestemming = bestemmingStraat.replace(' ', '+') + ',' + bestemmingGemeente;
                        $.getJSON('https://maps.googleapis.com/maps/api/distancematrix/json?origins=' + vertrek + '&destinations=' + bestemming + '&key=AIzaSyC0400WkUDYmE7pOI4J4FuhPSCUhuWu2X4', function (data) {
                            console.log(data);
                            var spatie = data.rows[0].elements[0].distance.text.indexOf(' ');
                            var afstand = parseFloat(data.rows[0].elements[0].distance.text.substring(0, spatie).replace(',', '.'));
                            var prijs = parseFloat($('input[name="prijsPerKm"').val().replace(',', '.')) * afstand;
                            console.log(rit.id);
                            console.log(prijs);
                            $("tr[data-id='" + rit.id + "'] td:eq(5)").text("€" + prijs);
                        });
                    })
                } catch (error) {
                    alert("-- ERROR IN JSON --\n" + result);
                }
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }
    $(document).ready(function(){
        var id = $('input[name="gebruikerId"').val();
        haalRittenOp(id);
    });
</script>
<h2><?= $titel ?></h2>
<?php
echo form_hidden('gebruikerId', $gebruiker->id) . "\n";
echo form_hidden('prijsPerKm', $parameters->prijsPerKm) . "\n";
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
            . "</td>\n<td>";
            if ($rit->chauffeur){
                echo $rit->chauffeur->voornaam . " " . $rit->chauffeur->naam;
            } else {
                echo "Er is nog geen chauffeur toegewezen";
            }
            echo "</td>\n<td>"
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
