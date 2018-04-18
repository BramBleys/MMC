<html>
<head>
    <script>

        function haalGebruikersOp(soortId)
        {
            $.ajax({type : "GET",
                url : site_url + "/MMCMedewerker/haalAjaxOp_Gebruikers",
                data : { soortId : soortId },
                success : function(result){
                    $("#gebruikers").html(result);

                },
                error: function (xhr, status, error) {
                    alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
        }

        $(document).ready(function () {

            $(".gebruikerOphalen").click(function (e) {
                e.preventDefault();
                var soortId = $(this).data('id');
                haalGebruikersOp(soortId);
            });

        });

    </script>
</head>
<body>
<h2><?php echo $titel; ?></h2>

<div class="row">
    <div class="col-12">
        <form action="" class="form-inline">
            <div class="form-group">
                <label for="zoekVeld"></label>
                <input type="text" class="form-control" placeholder="Vul hier een zoekterm in.">
                <button type="submit" class="btn btn-primary mx-2">Zoeken</button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-3">
        <?php

        echo anchor('', 'Minder Mobielen', array('class' => 'btn btn-primary gebruikerOphalen', 'data-id' => '1')) . "\n";
        echo anchor('', 'Coaches', array('class' => 'btn btn-primary gebruikerOphalen', 'data-id' => '2')) . "\n";
        echo anchor('', 'Vrijwilligers', array('class' => 'btn btn-primary gebruikerOphalen', 'data-id' => '3')) . "\n";

        ?>
    </div>
    <div class="col-9">
        <div id="gebruikers">
        </div>
    </div>
</div>
<script>
    $('.collapse').addClass('no-transition').collapse('toggle');
</script>
</body>
</html>