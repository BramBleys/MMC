<?php
    /**
     * @file sjablonenBeheren.php
     *
     * View waarin de sjablonen worden weergegeven.
     * De gebruiker kan kiezen om deze sjablonen aan te passen of leeg te maken.
     * - krijgt een $sjabloon-object binnen
     * - gebruikt een Bootstrap-modal
     *
     */
?>
    <script>
        var action;
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();

            $('.verwijderKnop').click(function () {
                $('form').attr('action', $(this).attr('href'));
            });
        });
    </script>

    <table class="table table-hover marginTop">
        <?php
            $wijzigKnop = '<i class="fas fa-pencil-alt" style="color:black"></i>';
            $verwijderknop = "<i class=\"fas fa-times\" style=\"color:black\"></i>";
            $attributesWijzig = 'data-toggle="tooltip" data-placement="bottom" title="Sjabloon wijzigen"';
            $attributesVerwijder = 'data-toggle="modal" class="verwijderKnop" data-target="#exampleModalCenter" data-placement="bottom" title="Sjabloon Leeg maken"';

            echo form_open('administrator/sjabloonVerwijderen');

            foreach ($sjablonen as $sjabloon) {
                echo '<tr>';

                echo '<td>' . $sjabloon->titel . '</td>';

                echo '<td>' . anchor("administrator/sjabloonWijzigen/$sjabloon->id", $wijzigKnop, $attributesWijzig) . '<span class="ml-3"></span>' . anchor("administrator/sjabloonVerwijderen/$sjabloon->id", $verwijderknop, $attributesVerwijder) . '</td>';

                echo '</tr>';
            } ?>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Sjabloon opslagen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Ben je zeker dat je het sjabloon wilt verwijderen ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Terug</button>
                        <?php echo form_submit('knop', 'Verwijderen', array('class' => 'btn achtergrond')); ?>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                Ben je zeker dat je het sjabloon wilt verwijderen ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Terug</button>
                <?php echo form_submit('knop', 'Verwijderen', array('class' =>'btn achtergrond')); ?>
            </div>
        </div>
    </div>
</div>
        </div>

        <?php

            form_close();

        ?>
    </table>
<?php
echo anchor('/Home/index', 'Terug', array('class' => 'btn btn-primary mb-4')) . "\n";
?>