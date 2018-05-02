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
                        var service = new google.maps.DistanceMatrixService();
                        service.getDistanceMatrix(
                            {
                                origins: [vertrek],
                                destinations: [bestemming],
                                travelMode: 'DRIVING',
                            }, callback);

                        function callback(response, status) {
                            console.log(response);
                            if (status == 'OK'){
                                if (response.rows[0].elements[0].status == 'OK') {
                                    var spatie = response.rows[0].elements[0].distance.text.indexOf(' ');
                                    var afstand = parseFloat(response.rows[0].elements[0].distance.text.substring(0, spatie).replace(',', '.'));
                                    var prijs = parseFloat($('input[name="prijsPerKm"').val().replace(',', '.')) * afstand;
                                    console.log(prijs);
                                    $("tr[data-id='" + rit.id + "'] td:eq(5)").text("€" + prijs);
                                }
                            }
                        }
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
$button = form_button("knopNieuw", "Nieuwe rit aanvragen", $extraButton);
echo '<p>' . anchor('minderMobiele/nieuweRit', $button) . ' ';

$extraButton = array('class' => 'btn achtergrond margin-top');
$button = form_button("knopGepland", "Geplande ritten bekijken", $extraButton);
echo anchor('minderMobiele', $button) . '</p>';


if(count($ritten)!=0){
    echo "<div class=\"table-responsive\">\n";
    echo "    <table class=\"table table-hover marginTop\">\n";
    echo "        <thead>\n";
    echo "        <tr>\n";
    echo "            <th>Datum</th>\n";
    echo "            <th>Uur</th>\n";
    echo "            <th>Vertrek adres</th>\n";
    echo "            <th>Bestemming</th>\n";
    echo "            <th>Bestuurder</th>\n";
    echo "            <th>Bedrag</th>\n";
    echo "            <th></th>\n";
    echo "        </tr>\n";
    echo "        </thead>\n";
    echo "        <tbody>\n";

    foreach ($ritten as $rit) {
        $spatie = strpos($rit->vertrekTijdstip, " ");
        echo "<tr data-id='$rit->id'>\n<td>" . zetOmNaarDDMMYYYY(substr($rit->vertrekTijdstip,0, $spatie)) . "</td>\n<td>"
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
                . "</td>\n</tr>\n";
    }
    echo"        </tbody>\n";
    echo"    </table>\n";
    echo"</div>\n";
}
else{
    echo "<p>Je hebt geen afgelopen ritten.</p>\n";
}
?>
