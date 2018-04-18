<h3>Beschikbaarheid ingeven</h3>
<div class="col-auto">
    <div class="input-group align-items-center">
        <div id="weekpicker"></div>
    </div>

    <div id="day-schedule"></div>

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="/assets/javascript/day-selector.js"></script>
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
</div>