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
        <input type="hidden" class="form-control" name="id1" id="id1" value="<?php echo $teBeherenText[0]->id ?>">
        <input type="text" class="form-control" name="titel1" id="titel1" value="<?php echo $teBeherenText[0]->titel ?>">
        <textarea rows="3" class="form-control" name="inhoud1" id="inhoud1"><?php echo $teBeherenText[0]->inhoud  ?> </textarea>
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control" name="id2" id="id2" value="<?php echo $teBeherenText[1]->id ?>">
        <input type="text" class="form-control" name="titel2" id="titel2" value="<?php echo $teBeherenText[1]->titel ?>">
        <textarea rows="3" class="form-control" name="inhoud2" id="inhoud2"><?php echo $teBeherenText[1]->inhoud  ?> </textarea>
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control" name="id3" id="id3" value="<?php echo $teBeherenText[2]->id ?>">
        <input type="text" class="form-control" name="titel3" id="titel3" value="<?php echo $teBeherenText[2]->titel ?>">
        <textarea rows="3" class="form-control" name="inhoud3" id="inhoud3"><?php echo $teBeherenText[2]->inhoud  ?> </textarea>
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control" name="id4" id="id4" value="<?php echo $teBeherenText[3]->id ?>">
        <input type="text" class="form-control" name="titel4" id="titel4" value="<?php echo $teBeherenText[3]->titel ?>">
        <textarea rows="3" class="form-control" name="inhoud4" id="inhoud4"><?php echo $teBeherenText[3]->inhoud  ?> </textarea>
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control" name="id5" id="id5" value="<?php echo $teBeherenText[4]->id ?>">
        <input type="text" class="form-control" name="titel5" id="titel5" value="<?php echo $teBeherenText[4]->titel ?>">
        <textarea rows="3" class="form-control" name="inhoud5" id="inhoud5"><?php echo $teBeherenText[4]->inhoud  ?> </textarea>
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control" name="id6" id="id6" value="<?php echo $teBeherenText[5]->id ?>">
        <input type="text" class="form-control" name="titel6" id="titel6" value="<?php echo $teBeherenText[5]->titel ?>">
        <textarea rows="3" class="form-control" name="inhoud6" id="inhoud6"><?php echo $teBeherenText[5]->inhoud  ?> </textarea>
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control" name="id17" id="id7" value="<?php echo $teBeherenText[6]->id ?>">
        <textarea rows="3" class="form-control" name="inhoud7" id="inhoud7"><?php echo $teBeherenText[6]->inhoud  ?> </textarea>
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

