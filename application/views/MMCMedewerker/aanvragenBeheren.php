<?php

$nieuweAanvragen = "";
$afgewerkteAanvragen = "";
$datum = "";
$uur = "";
$supplementaireKost = "";

foreach ($ritten as $rit) {

    $datum = date_create($rit->vertrekTijdstip);
    $datum = date_format($datum, 'd/m/Y');

    $uur = date_create($rit->vertrekTijdstip);
    $uur = date_format($uur, 'H:i');

    if(!$rit->supplementaireKost) {
        $supplementaireKost = "0,00 €";
    }

    if(!$rit->chauffeur) {
        $nieuweAanvragen .= "<tr>\n<td>" .
            $rit->minderMobiele->voornaam . " " . $rit->minderMobiele->naam . "</td>\n<td>" .
            $rit->chauffeur->telefoonnummer . "</td>\n<td>" .
            $datum . "</td>\n<td>" .
            $uur . "</td>\n<td>" .
            $rit->chauffeur->voornaam . " " . $rit->chauffeur->naam . "</td>\n<td>" .
            "<i class=\"material-icons\">" .
            anchor('', 'directions_car') .
            "<i class=\"material-icons\">" .
            anchor('MMCMedewerker/aanvraagWijzigen/' . $rit->id, 'edit') .
            "</i></td>\n<td>" .
            "</td>\n</tr>\n";
    } else {
        $afgewerkteAanvragen .= "<tr>\n<td>" .
            $rit->minderMobiele->voornaam . " " . $rit->minderMobiele->naam . "</td>\n<td>" .
            $datum . "</td>\n<td>" .
            $uur . "</td>\n<td>" .
            $supplementaireKost . "</td>\n<td>" .
            $rit->chauffeur->voornaam . " " . $rit->chauffeur->naam . "</td>\n<td>" .
            "<i class=\"material-icons\">" .
            anchor('MMCMedewerker/aanvraagWijzigen/' . $rit->id, 'edit') .
            "</i></td>\n<td>" .
            "</td>\n</tr>\n";
    }
}

if ($nieuweAanvragen == "") {
    $nieuweAanvragen = "<tr><td colspan=\"7\">Er zijn geen nieuwe aanvragen.</td></tr>";
}

?>

<h2 class="mb-4"><?= $titel; ?></h2>

<h3 class="mb-3">Nieuwe aanvragen</h3>

<?= anchor('MMCMedewerker/aanvraagToevoegen','Nieuwe rit ingeven','class="btn btn-primary mb-3"'); ?>

<table class="table">
    <thead>
        <tr>
            <th>Passagier</th>
            <th>Tel. Coach</th>
            <th>Datum</th>
            <th>Uur</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?= $nieuweAanvragen; ?>
    </tbody>
</table>

<h3 class="mb-3">Afgewerkte aanvragen</h3>

<table class="table">
    <thead>
    <tr>
        <th>Passagier</th>
        <th>Datum</th>
        <th>Uur</th>
        <th>Extra kosten</th>
        <th>Chauffeur</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <?= $afgewerkteAanvragen; ?>
    </tbody>
</table>