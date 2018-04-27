<h3>Overzicht ritten</h3>

<table class="table">
    <tr>
        <th> Naam</th>
        <th> Datum</th>
        <th> Vertrek adres</th>
        <th> Bestemming</th>
        <th> Vertrek tijdstip</th>
        <th></th>
        <th></th>
    </tr>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <?php
        foreach ($ritten as $rit) {
            echo '<tr>' .
                '<td>' .$rit->voornaam . ' ' . $rit->naam . '</td>' .
                '<td>' .$rit->datum . '</td>' .
                '<td>' .$rit->vertrekAdres . '</td>' .
                '<td>' .$rit->bestemming . '</td>' .
                '<td>' .$rit->vertrekTijdstip . '</td>' .
                '<td><i class="material-icons" data-toggle="tooltip" title="' . $rit->supplementaireKost . '">attach_money</i></td>' .
                '<td><i class="material-icons" data-toggle="tooltip" title="' . $rit->opmerking . '">lightbulb_outline</i></td>' .
                '</tr>';
        }
    ?>
</table>
