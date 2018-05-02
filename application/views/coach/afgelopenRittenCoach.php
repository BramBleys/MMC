<script>

    function haalAfgelopenRittenOp(accountId)
    {
        $.ajax({type : "GET",
            url : site_url + "/coach/haalAjaxOp_AfgelopenRitten",
            data : { accountId : accountId },
            success : function(result){
                $("#ritGegevens").html(result);

            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    $(document).ready(function () {
        var accountId = $('input[name="accountId"]').val();
        haalAfgelopenRittenOp(accountId);

        $('select[name="minderMobielen"]').change(function(){
            accountId = $(this).val();
            haalAfgelopenRittenOp(accountId);
            $('#naamTitel').text($('select[name="minderMobielen"] option:selected' ).text());
        });
    });

</script>

<!--TODO nog controleren op string/int + juiste bolletje nog selecteren in script hierboven + custom tooltip error message-->

<?php

if(count($minderMobielen)!=0) {
    echo "<h2>$titel van <span id=\"naamTitel\">$gekozenAccount->voornaam $gekozenAccount->naam</span></h2>\n";
    echo "<div class=\"form-row\">\n<div class=\"col-md-4\">";
    echo form_labelpro('Persoon', 'minderMobielen');
    $dataDropdown = array();
    $idArray = str_split($gebruiker->soortId);
    if(in_array('1', $idArray)){
        $dataDropdown[$gebruiker->id] = "$gebruiker->voornaam $gebruiker->naam";
    }
    foreach ($minderMobielen as $minderMobiele) {
        $dataDropdown[$minderMobiele->id] = "$minderMobiele->voornaam $minderMobiele->naam";
    }
    echo form_dropdown('minderMobielen', $dataDropdown, $gekozenAccount->id, array('class' => 'form-control')) . "\n";
    echo "</div>\n</div>";
    echo form_hidden('accountId', $gekozenAccount->id);
    echo "<div id=\"ritGegevens\"></div>";
} else {
    echo "<p>Je beheert nog geen personen die een rit kunnen aanvragen.</p>\n";
}
?>










