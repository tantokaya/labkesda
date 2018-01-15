

<?=form_open('auth/do_login', array('id' => 'form-login', 'class' => 'form-validate'));?>
    <div class="panel panel-body login-form border-left border-left-lg border-left-brown">
        <div class="text-center m-b-20">
            <img class="img-responsive" src="<?=base_url('assets/images/logo.png');?>">
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <input type="email" class="form-control" placeholder="Email" id="email" autocomplete="off" name="email" required="required">
            <div class="form-control-feedback">
                <i class="icon-envelop4 text-muted"></i>
            </div>
        </div>
        <div class="form-group has-feedback has-feedback-left">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password" required="required">
            <div class="form-control-feedback">
                <i class="icon-lock text-muted"></i>
            </div>
        </div>
        <div class="form-group">
            <button type="button" class="btn bg-slate-dark btn-labeled btn-labeled-right btn-block btn-pos"><b><i class="icon-enter"></i></b> KASIR</button>
            <button type="button" class="btn bg-purple-dark btn-labeled btn-labeled-right btn-block btn-log"><b><i class="icon-enter"></i></b> BackAdmin</button>
        </div>
    </div>
<?=form_close();?>