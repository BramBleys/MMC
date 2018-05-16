<?php
/**
 * @file accountsBeheren.php
 *
 * View waar de coach de gegevens kan aanpassen van de minder mobielen die hij beheert
 *  - krijgt een $gebruiker-object binnen
 *  - krijgt een $minderMobielen-object binnen
 *  - krijgt een $gekozenAccount-object binnen
 *  - haalt de view ajax_account.php op met ajax
 *  @see Coach::haalAjaxOp_Gebruiker()
 *  @see ajax_account.php
 */
?>
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
<hr>
<h3 class="marginTop">Contactgegevens</h3>
<?php
$attributenFormulier = array('id' => 'mijnFormulier',
    'class' => 'needs-validation',
    'novalidate' => 'novalidate');
echo form_open('coach/accountGegevensOpslaan', $attributenFormulier);
?>
<div id="accountGegevens">

</div>
<?php
$dataAnnuleer = array(
    'class' => 'btn btn-secondary marginTop',
    'content' => 'Annuleer'
);
echo anchor('coach', form_button($dataAnnuleer));
echo form_submit('opslaan', 'Opslaan', 'class="btn achtergrond marginTop"');
echo form_close();
?>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>










