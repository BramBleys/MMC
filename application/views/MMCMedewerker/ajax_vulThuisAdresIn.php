<?php

/**
 * @file MMCMedewerker/ajax_vulThuisAdresIn.php
 *
 * AJAX-view voor het invullen van het thuisAdres, wordt getoond in de view MMCMedewerker/wijzigAanvraag.php
 *  - krijgt een minderMobiele-object binnen
 */

?>

<script>
    function thuisAdresInvullen(checked, gebruikerId) {
        $.ajax({type : "GET",
            url : site_url + "/MMCMedewerker/haalAjaxOp_thuisAdres",
            data : { checked: checked, gebruikerId : gebruikerId },
            success : function(result){
                $("#vertrekAdres").html(result);
            },
            error: function (xhr, status, error) {
                alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
            }
        });
    }

    $(document).ready(function(){

        $( "#thuisAdres" ).change(function(e) {
            e.preventDefault();
            var checked = $(this).data('bool');
            var gebruikerId = $(this).data('id');
            thuisAdresInvullen(checked, gebruikerId);
        });
    });
</script>

<div class="col-12">
    <?php

    if($checked) {
        $checked = 0;
        $inputStatus = "required";
    } else {
        $checked = 1;
        $inputStatus = "disabled";
    }

    $checkbox = array(
        'name'          => 'thuisAdres',
        'id'            => 'thuisAdres',
        'value'         => 'ja',
        'checked'       => $checked,
        'data-bool'     => $checked,
        'data-id'       => $minderMobiele->id
    );

    echo form_checkbox($checkbox);
    echo form_label('De rit start bij het thuisadres van de passagier','thuisAdres', 'class="ml-1"');

    ?>
</div>
<div class="col-4">
    <?php

    echo "<p>" .
        form_label('Postcode', 'postcode') .
        "<br>" .
        form_input('postcode',$minderMobiele->postcode,'id="postcode" class="form-control" ' . $inputStatus) .
        "<span class=\"invalid-feedback\">Vul hier de postcode in</span>" .
        "</p>\n";

    ?>
</div>
<div class="col-8">
    <?php

    echo "<p>" .
        form_label('Gemeente', 'gemeente') .
        "<br>" .
        form_input('gemeente',$minderMobiele->gemeente,'id="gemeente" class="form-control" ' . $inputStatus) .
        "<span class=\"invalid-feedback\">Vul hier de gemeente in</span>" .
        "</p>\n";

    ?>
</div>
<div class="col-12">
    <?php

    echo "<p>" .
        form_label('Straat + Nr. + Bus', 'straatEnNummer') .
        "<br>" .
        form_input('straatEnNummer',$minderMobiele->straatEnNummer,'id="straatEnNummer" class="form-control" ' . $inputStatus) .
        "<span class=\"invalid-feedback\">Vul hier de straat, nummer en eventueel busnummer in</span>" .
        "</p>\n";

    ?>
</div>

