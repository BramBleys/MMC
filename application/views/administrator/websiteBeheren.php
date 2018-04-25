<?php
/**
 * Created by PhpStorm.
 * User: Kix
 * Date: 4/25/2018
 * Time: 2:48 PM
 */
?>
<?php
    echo form_open('administrator/websiteOpslagen');
    ?>
    <div class="form-group">
        <input type="text" class="form-control" name="titel" id="titel" value="<?php echo $sjabloon[0]->titel ?>" >
    </div>
    <div class="form-group">
        <textarea class="form-control" name="inhoud" id="inhoud" rows="7"><?php echo $sjabloon[0]->inhoud ?></textarea>
    </div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    Opslaan
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Veranderingen opslagen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Ben je zeker dat je de veranderingen wilt opslagen ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Terug</button>
                <?php echo form_submit('knop', 'Opslaan', array('class' =>'btn achtergrond')); ?>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

