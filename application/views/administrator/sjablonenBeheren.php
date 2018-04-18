<?php
/**
 * Created by PhpStorm.
 * User: Kix
 * Date: 3/30/2018
 * Time: 3:10 PM
 */
?>
<html>
<head>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>

<table class="table table-hover marginTop">
    <?php
        $wijzigKnop = '<i class="fas fa-pencil-alt" style="color:black"></i>';
        $attributesWijzig = 'data-toggle="tooltip" data-placement="bottom" title="Sjabloon wijzigen"';
    foreach($sjablonen as $sjabloon){
        echo '<tr>';

        echo '<td>' . $sjabloon->titel . '</td>';

        echo '<td>' . anchor("administrator/sjabloonWijzigen/$sjabloon->id", $wijzigKnop, $attributesWijzig) . '</td>';

        echo '</tr>';
    }

    ?>
</table>
</body>
</html>
