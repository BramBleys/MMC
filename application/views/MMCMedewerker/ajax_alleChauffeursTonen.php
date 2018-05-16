<?php

/**
 * @file MMCMedewerker/ajax_alleChauffeursTonen.php
 *
 */

?>

<script>
    function kiesChauffeur(id) {
        $.ajax({type : "GET",
            url : site_url + "/MMCMedewerker/haalAjaxOp_vulChauffeurIn",
            data : { gebruikerId : id },
            success : function(result){

                $("#chauffeur").html(result);
                $('#modalGebruiker').modal('hide');

            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    $(document).ready(function(){

        $( ".kiesChauffeur" ).click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            kiesChauffeur(id);
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    });
</script>

<?php

$alleChauffeurs = '';

foreach ($chauffeurs as $chauffeur) {
    $alleChauffeurs .= "<tr>\n<td>" .
        $chauffeur->voornaam . " " . $chauffeur->naam . "</td>\n<td>" .
        $chauffeur->telefoonnummer . "</td>\n<td>" .
        $chauffeur->straatEnNummer . "</td>\n<td>" .
        $chauffeur->gemeente . "</td>\n<td>" .
        "<i class=\"material-icons\">" .
        anchor('', 'directions_car', 'data-id="' . $chauffeur->id . '" data-toggle="tooltip" data-placement="right" title="Andere ritten"') .
        "<i class=\"material-icons\">" .
        anchor('', 'check_circle', 'data-id="' . $chauffeur->id . '" class="ml-2 kiesChauffeur" data-toggle="tooltip" data-placement="right" title="Kies chauffeur"') .
        "</i></td>\n" .
        "</tr>\n";
}

?>

<h4 class="mb-3">Alle chauffeurs</h4>

<table class="table">
    <thead>
    <tr>
        <th>Naam</th>
        <th>Telefoon</th>
        <th>Adres</th>
        <th>Woonplaats</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?= $alleChauffeurs; ?>
    </tbody>
</table>