<?php echo form_open("home/controleerInloggen"); ?>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email">
        </div>
    </div>
    <div class="form-group row">
        <label for="wachtwoord" class="col-sm-2 col-form-label">Wachtwoord</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="wachtwoord" placeholder="Wachtwoord">
        </div>
    </div>

<?php echo form_submit("inloggen","Inloggen"); ?>