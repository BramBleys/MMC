<h3>Beschikbaarheid ingeven</h3>

<link rel="stylesheet" href="https://cdn.rawgit.com/pingcheng/bootstrap4-datetimepicker/master/build/css/bootstrap-datetimepicker.min.css">

<!--Javascripts ophalen-->
<?php echo haalJavascriptOp("moment.min.js"); ?>
<script src="https://cdn.rawgit.com/pingcheng/bootstrap4-datetimepicker/master/build/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<?php echo haalJavascriptOp("bootstrap-weekpicker.js"); ?>
<?php echo haalJavascriptOp("day-selector.js"); ?>

<!--Weekpicker-->
<div class="input-group date align-items-center">
    <div id="weekpicker"></div>
    <button class="btn btn-primary ml-3" id="urenOpslaan">Opslaan</button>
    <?php echo anchor('vrijwilliger/beschikbaarheidIngeven', '<button class="btn btn-primary ml-3" id="refresh">Refresh</button>'); ?>
    <button class="btn btn-primary ml-5" id="Ondersteuning" data-toggle="modal" data-target="#ondersteuningModal">Help
        en ondersteuning
    </button>
</div>

<!--Uurpicker-->
<div id="day-schedule" class="mt-4"></div>

<!-- Modal -->
<div class="modal fade" id="ondersteuningModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">Hoe werken met de kalender? </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Klik op 1 van onderstaande knoppen voor meer informatie.</p>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
                            <h5 class="mb-0"> Je planning bekijken </h5>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                Om te bekijken welke uren je reeds hebt doorgegeven klik je eerst op het vakje waarin de
                                huidige week
                                staat.
                                <?php echo toonAfbeelding("Weekpicker.png", 'style="width: 100%"') ?>Als je hierop klikt
                                zie je een kalender. Hierin kan je er voor kiezen om een week verder/terug te gaan. Je
                                klikt op een dag in de week die je wilt bekijken. Hierna worden je uren getoond in de
                                kalender. <br> Wanneer je een nieuwe week wilt bekijken moet je eerst op de "Refresh"
                                knop klikken. <?php echo toonAfbeelding("Refresh.png", 'style="width: 100%"') ?>Dit
                                zorgt ervoor dat de kalender leeg gemaakt wordt. Hierna herhaal je de eerste stappen.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseTwo">
                            <h5 class="mb-0">Nieuwe uren doorgeven</h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                Om te beginnen klik je op het vakje waarin de huidige week staat.
                                <?php echo toonAfbeelding("Weekpicker.png", 'style="width: 100%"') ?>Als je hierop klikt
                                zie je een kalender. Selecteer een dag van de week waarvoor je nieuwe uren wilt
                                doorgeven. Nu kan je voor de geselecteerde week je uren doorgeven. Dit doe je door 1
                                grijs vakje van een bepaalde dag aan te klikken. Nu kan je je muis naar onder/boven
                                slepen. Je ziet dat de vakjes een blauwe kleur krijgen. Om te stoppen met selecteren
                                klik je nogmaals op 1 van de grijze vakjes. Bijvoorbeeld:
                                <br><?php echo toonAfbeelding("Uren.png", 'style="height: 15rem" class="mb-4"') ?>
                                <br><b>Vergeet niet om je gegevens voor die week op te slaan door op de knop "Opslaan"
                                    te klikken!</b> <?php echo toonAfbeelding("Opslaan.png", 'style="width: 100%"') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function ($) {
        var weekpicker = $("#weekpicker").weekpicker();
        var inputField = $("#weekpicker").find("input");

        inputField.datetimepicker().on('dp.hide', function () {
            var week = weekpicker.getWeek();
            var jaar = weekpicker.getYear();
            haalDatumsOp(week, jaar);
        });

        function haalDatumsOp(week, jaar) {
            $.ajax({
                type: "GET",
                url: site_url + "/Vrijwilliger/haalJsonOp_Datums",
                data: {week: week, jaar: jaar, id: <?php echo $gebruiker->id ?>},
                success: function (result) {
                    try {
                        var dagen = jQuery.parseJSON(result);
                        if (!isLeeg(dagen[0])) {
                            for (var i = 0; i < dagen.length; i++) {
                                var datum = new Date(dagen[i].dag);
                                var dag = datum.getDay().toString();
                                toonBeschikbaarheid(dag, dagen[i].startUur, dagen[i].eindUur);
                            }
                        }
                    } catch (error) {
                        alert("-- ERROR IN JSON --\n" + result);
                    }
                },
                error: function (xhr, status, error) {
                    alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
        }

        function isLeeg(object) {
            for (var key in object) {
                if (object.hasOwnProperty(key)) {
                    return false;
                }
            }
            return true;
        }


        $("#day-schedule").dayScheduleSelector({
            /*
            days: [1, 2, 3, 5, 6],
            interval: 15,
            startTime: '09:50',
            endTime: '21:06'
            */
        });

        $("#urenOpslaan").click(function () {
            <?php $this->load->model('vrijwilliger_model'); ?>
            var nieuweUren = $("#day-schedule").data('artsy.dayScheduleSelector').serialize();
            for (var key in nieuweUren) {
                if (nieuweUren.hasOwnProperty(key)) {
                    for (var i = 0; i < nieuweUren[key].length; i++) {
                        (function () {
                            var dag = key;
                            var startUur = nieuweUren[key][i][0];
                            var eindUur = nieuweUren[key][i][1];

                            var week = weekpicker.getWeek();
                            var jaar = weekpicker.getYear();

                            $.ajax({
                                type: "GET",
                                url: site_url + "/Vrijwilliger/haalDatumsOp",
                                data: {week: week, jaar: jaar},
                                success: function (result) {
                                    var dagen = jQuery.parseJSON(result);
                                    try {
                                        schrijfWeg(dagen[0], dag, startUur, eindUur);
                                    } catch (error) {
                                        alert("-- ERROR IN JSON --\n" + result);
                                    }
                                },
                                error: function (xhr, status, error) {
                                    alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                                }
                            });
                        })();
                    }
                }
            }
        });

        function schrijfWeg(beginWeek, dagNummer, startUur, eindUur) {
            $.ajax({
                type: "GET",
                url: site_url + "/Vrijwilliger/schrijfNieuweUrenWeg",
                data: {
                    beginWeek: beginWeek,
                    dagNummer: dagNummer,
                    startUur: startUur,
                    eindUur: eindUur,
                    id: <?php echo $gebruiker->id ?>},
                success: function (result) {
                    try {

                    } catch (error) {
                        alert("-- ERROR IN JSON --\n" + result);
                    }
                },
                error: function (xhr, status, error) {
                    alert("-- ERROR IN AJAX --\n\n" + xhr.responseText);
                }
            });
        }

        /*Dit ging door de plugin niet efficiënter, excuses aan mevrouw Decabooter!*/
        function toonBeschikbaarheid(dag, startUur, eindUur) {
            if (dag === "1") {
                $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                    '0': [[startUur, eindUur]]
                });
            } else if (dag === "2") {
                $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                    '1': [[startUur, eindUur]]
                });
            } else if (dag === "3") {
                $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                    '2': [[startUur, eindUur]]
                });
            } else if (dag === "4") {
                $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                    '3': [[startUur, eindUur]]
                });
            } else if (dag === "5") {
                $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                    '4': [[startUur, eindUur]]
                });
            } else if (dag === "6") {
                $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                    '5': [[startUur, eindUur]]
                });
            } else if (dag === "0") {
                $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                    '6': [[startUur, eindUur]]
                });
            }
        }
    })($);
</script>