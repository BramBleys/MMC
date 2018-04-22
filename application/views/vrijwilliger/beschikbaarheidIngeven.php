<h3>Beschikbaarheid ingeven</h3>

<!--Weekpicker-->
<link rel="stylesheet" href="https://cdn.rawgit.com/pingcheng/bootstrap4-datetimepicker/master/build/css/bootstrap-datetimepicker.min.css">

<div class="input-group date align-items-center">
    <div id="weekpicker"></div>
    <button class="btn btn-primary ml-3" id="urenOpslaan">Opslaan</button>
</div>

<?php echo haalJavascriptOp("moment.min.js"); ?>
<script src="https://cdn.rawgit.com/pingcheng/bootstrap4-datetimepicker/master/build/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<?php echo haalJavascriptOp("bootstrap-weekpicker.js"); ?>
<script type="text/javascript">
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
</script>

<!--Uurpicker-->
<div id="day-schedule" class="mt-4"></div>
<?php echo haalJavascriptOp("day-selector.js"); ?>
<script>
    (function ($) {
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
    })($);
</script>

<script>
    /*function toonBeschikbaarheid(dag, startUur, eindUur) {
        if (dag === "1") {
            $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                '0': [[startUur, eindUur]]
            });
        } else if (dag === "2") {
            $("#day-schedule").data('.artsy.dayScheduleSelector').deserialize({
                '1': [[startUur, eindUur]]
            });
        }
        else if (dag === "3") {
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
        } else if (dag === "7") {
            $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                '6': [[startUur, eindUur]]
            });
        }
    }*/
</script>

