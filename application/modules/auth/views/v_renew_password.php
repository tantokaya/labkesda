<?=form_open('renew', array('id' => 'form-reset', 'class' => 'form-validate'));?>
    <div class="panel panel-body login-form border-left border-left-lg border-left-brown">
        <div class="text-center m-b-20">
            <h1>Reset Password</h1>
            <?=validation_errors();?>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <input type="password" class="form-control" placeholder="Password" id="password" autocomplete="off" name="password" required="required" data-min-length="8">
            <div class="form-control-feedback">
                <i class="icon-lock text-muted"></i>
            </div>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <input type="password" class="form-control" placeholder="Re-Password" name="repassword" id="repassword" required="required" data-min-length="8" data-equalto="#password">
            <div class="form-control-feedback">
                <i class="icon-lock text-muted"></i>
            </div>
        </div>

        <div class="form-group">
            <input type="hidden" id="token" name="token" value="<?=$token;?>"/>
            <button type="submit" class="btn bg-brown btn-labeled btn-labeled-right btn-block btn-reset"><b><i class="icon-reset"></i></b> Reset</button>
        </div>
    </div>
<?=form_close();?>