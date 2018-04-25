<?php
/**
 * Created by PhpStorm.
 * User: Kix
 * Date: 4/18/2018
 * Time: 1:58 PM
 */
?>
<html>
<head>
</head>
<body>
<?php
    echo form_open('administrator/sjabloonOpslagen');
    ?>
    <div class="form-group">
        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $sjabloon[0]->id ?>" >
    </div>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Sjabloon opslagen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Ben je zeker dat je het sjabloon wilt opslagen ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Terug</button>
                <?php echo form_submit('knop', 'Opslaan', array('class' =>'btn achtergrond')); ?>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
</body>
</html>
