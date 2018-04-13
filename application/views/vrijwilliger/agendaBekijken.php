<h3>Overzicht ritten</h3>

<table class="table">
    <tr>
        <th> Naam</th>
        <th> Datum</th>
        <th> Vertrek adres</th>
        <th> Bestemming</th>
        <th> Vertrek tijdstip</th>
        <th> Supplementaire kost</th>
        <th> Heenrit</th>
        <th> Opmerking</th>
    </tr>
    <?php
        foreach ($ritten as $rit) {
            echo '<tr>' .
                '<td>' .$rit->voornaam . ' ' . $rit->naam . '</td>' .
                '<td>' .$rit->datum . '</td>' .
                '<td>' .$rit->vertrekAdres . '</td>' .
                '<td>' .$rit->bestemming . '</td>' .
                '<td>' .$rit->vertrekTijdstip . '</td>' .
                '<td>' .$rit->supplementaireKost . '</td>' .
                '<td>' .$rit->heenrit . '</td>' .
                '<td>' .$rit->opmerking . '</td>' .
                '</tr>';
        }
    ?>
</table>
