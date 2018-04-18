<script>
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<h2><?= $titel ?></h2>
<?php
if(count($minderMobielen)!=0){
    echo "<div class=\"table-responsive\">\n";
    echo "    <table class=\"table table-hover marginTop\">\n";
    echo "        <thead>\n";
    echo "        <tr>\n";
    echo "            <th>Voornaam</th>\n";
    echo "            <th>Naam</th>\n";
    echo "            <th>E-mail</th>\n";
    echo "            <th></th>\n";
    echo "        </tr>\n";
    echo "        </thead>\n";
    echo "        <tbody>\n";

    $wijzigknop = "<i class=\"fas fa-pencil-alt\" style=\"color:black\"></i>";
    $ritknop = "<i class=\"fas fa-car\" style=\"color:black\"></i>";

    foreach ($minderMobielen as $minderMobiele) {
        echo "<tr>\n" .
            "<td>" . $minderMobiele->voornaam . "</td>\n" .
            "<td>" . $minderMobiele->naam . "</td>\n" .
            "<td>" . $minderMobiele->email . "</td>\n" .
            "<td>";
            $attributesWijzig = 'data-toggle="tooltip" data-placement="bottom" title="account beheren"';
            $attributesRit = 'data-toggle="tooltip" data-placement="bottom" title="nieuwe rit"';
            echo anchor("coach/accountsBeheren/$minderMobiele->id", $wijzigknop, $attributesWijzig) . " " .
            anchor("coach/rittenBeheren/$minderMobiele->id", $ritknop, $attributesRit);
            "</td>\n" .
            "</tr>\n";
    }
    echo"        </tbody>\n";
    echo"    </table>\n";
    echo"</div>\n";
}
else{
    echo "<p>Je beheert nog geen minder mobielen.</p>\n";
}
?>