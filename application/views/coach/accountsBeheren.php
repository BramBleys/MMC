<script>

    function haalGegevensOp(accountId)
    {
        $.ajax({type : "GET",
            url : site_url + "/coach/haalAjaxOp_Gebruiker",
            data : { accountId : accountId },
            success : function(result){
                $("#accountGegevens").html(result);

            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    $(document).ready(function () {
        var accountId = $('input[name="accountId"]').val();
        haalGegevensOp(accountId);

        $('select[name="minderMobielen"]').change(function(){
            accountId = $(this).val();
            haalGegevensOp(accountId);
            $('#naamTitel').text($('select[name="minderMobielen"] option:selected' ).text());
        });
    });

</script>

<!--TODO nog controleren op string/int + juiste bolletje nog selecteren in script hierboven + custom tooltip error message-->

<?php
    echo "<h2>$titel van <span id=\"naamTitel\">$gekozenAccount->voornaam $gekozenAccount->naam</span></h2>\n";
    echo "<div class=\"form-row\">\n<div class=\"col-md-4\">";
    echo form_labelpro('Persoon', 'minderMobielen');
    $dataDropdown= array();
    $dataDropdown[$gebruiker->id] = "$gebruiker->voornaam $gebruiker->naam";
    foreach ($minderMobielen as $minderMobiele){
        $dataDropdown[$minderMobiele->id] = "$minderMobiele->voornaam $minderMobiele->naam";
    }
    echo form_dropdown('minderMobielen', $dataDropdown, $gekozenAccount->id, array('class'=>'form-control')) . "\n";
    echo "</div>\n</div>";
    echo form_hidden('accountId', $gekozenAccount->id);
?>
<div id="accountGegevens">

</div>










