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

<h2><?php echo $titel; ?></h2>

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
            <table class="table">
                <thead>
                <tr>
                    <th>Voornaam</th>
                    <th>Naam</th>
                    <th>E-mail</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php

                foreach ($gebruikers as $gebruiker) {

                    //tabel opvullen voor gebruikers met meerdere types
                    if (strlen($gebruiker->soortId) > 1) {

                        //meerdere types opsplitsen
                        $soortIdArray = str_split($gebruiker->soortId);

                        //tabel opvullen
                        for ($i = 0; $i < count($soortIdArray); $i++) {
                            if ($soortId == $soortIdArray[$i]) {
                                echo "<tr>\n" .
                                    "<td>" . $gebruiker->voornaam . "</td>\n" .
                                    "<td>" . $gebruiker->naam . "</td>\n" .
                                    "<td>" . $gebruiker->email . "</td>\n" .
                                    "<td>" .
                                    "<i class=\"material-icons\"><a href=\"\">edit</a></i>\n" .
                                    "<i class=\"material-icons\"><a href=\"\">directions_car</a></i>\n" .
                                    "</td>\n" .
                                    "</tr>\n";
                            }
                        }
                    }

                    //tabel opvullen voor gebruikers met 1 type
                    if ($soortId == $gebruiker->soortId) {
                        echo "<tr>\n" .
                            "<td>" . $gebruiker->voornaam . "</td>\n" .
                            "<td>" . $gebruiker->naam . "</td>\n" .
                            "<td>" . $gebruiker->email . "</td>\n" .
                            "<td>" .
                            "<i class=\"material-icons\"><a href=\"\">edit</a></i>\n" .
                            "<i class=\"material-icons\"><a href=\"\">directions_car</a></i>\n" .
                            "</td>\n" .
                            "</tr>\n";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

