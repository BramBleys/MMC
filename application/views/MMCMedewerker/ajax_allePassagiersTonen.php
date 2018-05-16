<?php

/**
 * @file MMCMedewerker/ajax_allePassagiersTonen.php
 *
 * AJAX-view voor het tonen van alle passagiers in een Bootstrap-modal in de view MMCMedewerker/aanvraagToevoegen.php
 */

?>

<script>
    function kiesPassagier(gebruikerId, coachId) {
        $.ajax({type : "GET",
            url : site_url + "/MMCMedewerker/haalAjaxOp_vulPassagierIn",
            data : { gebruikerId : gebruikerId, coachId : coachId },
            success : function(result){

                $("#passagierResultaat").html(result);
                $('#modalGebruiker').modal('hide');

            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    $(document).ready(function(){

        $( ".kiesPassagier" ).click(function(e) {
            e.preventDefault();
            var gebruikerId = $(this).data('id');
            var coachId = $(this).data('coach');
            kiesPassagier(gebruikerId, coachId);
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    });
</script>

<?php

$allePassagiers = '';

foreach ($passagiers as $passagier) {
    if($passagier->coach !== Null) {
        $allePassagiers .= "<tr>\n<td>" .
            $passagier->voornaam . " " . $passagier->naam . "</td>\n<td>" .
            $passagier->coach->voornaam . " " . $passagier->coach->naam . "</td>\n<td>" .
            $passagier->coach->telefoonnummer . "</td>\n<td>" .
            $passagier->straatEnNummer . "</td>\n<td>" .
            $passagier->gemeente . "</td>\n<td>" .
            "<i class=\"material-icons\">" .
            anchor('', 'check_circle', 'data-id="' . $passagier->id . '" data-coach="' . $passagier->coach->id . '"class="ml-2 kiesPassagier" data-toggle="tooltip" data-placement="right" title="Kies passagier"') .
            "</i></td>\n" .
            "</tr>\n";
    } else {
        $allePassagiers .= "<tr>\n<td>" .
            $passagier->voornaam . " " . $passagier->naam . "</td>\n<td colspan='2'><i>Geen Coach ingegeven!</i></td>\n<td>" .
            $passagier->straatEnNummer . "</td>\n<td>" .
            $passagier->gemeente . "</td>\n<td>" .
            "<i class=\"material-icons\">" .
            anchor('', 'check_circle', 'data-id="' . $passagier->id . '" data-coach="' . 0 . '"class="ml-2 kiesPassagier" data-toggle="tooltip" data-placement="right" title="Kies passagier"') .
            "</i></td>\n" .
            "</tr>\n";
    }
}

?>

<h4 class="mb-3">Alle passagiers</h4>

<table class="table">
    <thead>
    <tr>
        <th>Naam</th>
        <th>Naam Coach</th>
        <th>Telefoon Coach</th>
        <th>Adres</th>
        <th>Woonplaats</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?= $allePassagiers; ?>
    </tbody>
</table>