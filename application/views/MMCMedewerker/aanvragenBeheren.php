<?php

/**
 * @file MMCMedewerker/aanvragenBeheren.php
 *
 * View waar alle ritaanvragen bekeken en beheerd kunnen worden.
 *  - Krijgt alle $ritten-objecten (aangevuld met passagiers, chauffeurs, vrijwilligers en adresgegevens) binnen
 */

?>

<script>
    $(document).ready(function(){

        $('.verwijderRit').click(function () {
            $('#annuleerKnop').closest('a').attr('href', $(this).attr('href'));
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    });
</script>

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
        if(!$rit->coach) {
            $nieuweAanvragen .= "<tr>\n<td>" .
                $rit->minderMobiele->voornaam . " " . $rit->minderMobiele->naam . "</td>\n<td>" .
                "<i>Geen coach toegewezen</i></td>\n<td>" .
                $rit->minderMobiele->telefoonnummer . "</td>\n<td>" .
                $datum . "</td>\n<td>" .
                $uur . "</td>\n<td>" .
                "<i class=\"material-icons\">" .
                anchor('MMCMedewerker/aanvraagWijzigen/' . $rit->id, 'edit') .
                anchor('MMCMedewerker/aanvraagVerwijderen/' . $rit->id, 'cancel', 'data-id="' . $rit->id . '" data-toggle="modal" data-target="#bevestigingPopup" class="ml-1 verwijderRit"') .
                "</i></td>\n<td>" .
                "</td>\n</tr>\n";
        } else {
            $nieuweAanvragen .= "<tr>\n<td>" .
                $rit->minderMobiele->voornaam . " " . $rit->minderMobiele->naam . "</td>\n<td>" .
                $rit->coach->voornaam . " " . $rit->coach->naam . "</td>\n<td>" .
                $rit->coach->telefoonnummer . "</td>\n<td>" .
                $datum . "</td>\n<td>" .
                $uur . "</td>\n<td>" .
                "<i class=\"material-icons\">" .
                anchor('MMCMedewerker/aanvraagWijzigen/' . $rit->id, 'edit') .
                anchor('MMCMedewerker/aanvraagVerwijderen/' . $rit->id, 'cancel', 'data-id="' . $rit->id . '" data-toggle="modal" data-target="#bevestigingPopup" class="ml-1 verwijderRit"') .
                "</i></td>\n<td>" .
                "</td>\n</tr>\n";
        }
    } else {
        $afgewerkteAanvragen .= "<tr>\n<td>" .
            $rit->minderMobiele->voornaam . " " . $rit->minderMobiele->naam . "</td>\n<td>" .
            $datum . "</td>\n<td>" .
            $uur . "</td>\n<td>" .
            $rit->chauffeur->voornaam . " " . $rit->chauffeur->naam . "</td>\n<td>" .
            "<i class=\"material-icons\">" .
            anchor('MMCMedewerker/aanvraagWijzigen/' . $rit->id, 'edit') .
            anchor('MMCMedewerker/aanvraagVerwijderen/' . $rit->id, 'cancel', 'data-id="' . $rit->id . '" data-toggle="modal" data-target="#bevestigingPopup" class="ml-1 verwijderRit"') .

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
            <th>Coach</th>
            <th>Telefoon</th>
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
        <th>Chauffeur</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <?= $afgewerkteAanvragen; ?>
    </tbody>
</table>

<!-- Dialoogvenster -->
<div class="modal fade" id="bevestigingPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bevestigingPopupTitle">Verwijderen rit bevestigen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                Ben je zeker dat je de rit wilt verwijderen? Ook een eventueel bijhorende terugrit wordt automatisch verwijderd.
            </div>
            <div class="modal-footer">
                <?php
                $dataAnnuleer = array(
                    'class' => 'btn btn-secondary',
                    'data-dismiss' => 'modal',
                    'content' => 'Rit behouden'
                );
                echo form_button($dataAnnuleer);
                $annuleerKnop = form_button('Rit annuleren', 'Rit annuleren', 'class="btn btn-primary" id="annuleerKnop"');
                echo anchor('', $annuleerKnop);
                ?>
            </div>
        </div>
    </div>
</div>