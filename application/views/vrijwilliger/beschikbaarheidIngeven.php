<h3>Beschikbaarheid ingeven</h3>

<!--Weekpicker-->
<link rel="stylesheet" href="https://cdn.rawgit.com/pingcheng/bootstrap4-datetimepicker/master/build/css/bootstrap-datetimepicker.min.css">

<div class="input-group date align-items-center">
    <div id="weekpicker"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.rawgit.com/pingcheng/bootstrap4-datetimepicker/master/build/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<?php echo haalJavascriptOp("bootstrap-weekpicker.js"); ?>
<script type="text/javascript">
    var weekpicker = $("#weekpicker").weekpicker();
    var inputField = $("#weekpicker").find("input");

    inputField.datetimepicker().on('dp.hide', function () {
        var week = weekpicker.getWeek();

        /*TODO: Dit moeten we in een php variabele kunnen steken -> week nodig voor volgende plugin*/
        <?php /*$week = '<script>weekpicker.getWeek();</script>';
        echo $week;
        */?>
    });
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
        $("#day-schedule").on('selected.artsy.dayScheduleSelector', function (e, selected) {
            console.log(selected);
        });

    })($);
</script>
<script>
    function toonBeschikbaarheid(dag, startUur, eindUur) {
        if (dag === "Monday") {
            $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                '0': [[startUur, eindUur]]
            });
        } else if (dag === "Tuesday") {
            $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                '1': [[startUur, eindUur]]
            });
        } else if (dag === "Wednesday") {
            $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                '2': [[startUur, eindUur]]
            });
        } else if (dag === "Thursday") {
            $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                '3': [[startUur, eindUur]]
            });
        } else if (dag === "Friday") {
            $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                '4': [[startUur, eindUur]]
            });
        } else if (dag === "Saturday") {
            $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                '5': [[startUur, eindUur]]
            });
        } else if (dag === "Sunday") {
            $("#day-schedule").data('artsy.dayScheduleSelector').deserialize({
                '6': [[startUur, eindUur]]
            });
        }

    }
</script>
<?php
    foreach ($beschikbaarheid as $tijd) {
        $dag = date('l', strtotime($tijd->beschikbaarVan));
        $startUur = date("H:i", strtotime($tijd->beschikbaarVan));
        $eindUur = date("H:i", strtotime($tijd->beschikbaarTot));

        echo '<script> toonBeschikbaarheid("' . $dag . '","' . $startUur . '","' . $eindUur . '"); </script>';
    }
?>
