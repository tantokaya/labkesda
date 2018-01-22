<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-user position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Pengaturan</li>
            <li><a href="<?=base_url('pengguna');?>">Pengguna</a></li>
            <li class="active"><?=$page_title;?></li>
        </ul>
    </div>
</div>

<div class="container-fluid page-content">
    <?php if(validation_errors()): ?>
    <div class="alert bg-danger">
        <span class="text-semibold"><?=validation_errors();?></span>
    </div>
    <?php endif; ?>
    <div class="panel panel-default panel-bordered">
        <div class="panel-heading">
            <h5 class="panel-title"><i class="icon-three-bars position-left"></i> <?=$page_title;?></h5>
        </div>
        <div class="panel-body">
            <?=form_open_multipart('', array('id' => 'frm-pengguna','class' => 'form-horizontal'))?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email..." value="<?=isset($user['email'])?$user['email']:set_value('email');?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap..." value="<?=isset($user['nama'])?$user['nama']:set_value('nama');?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Re-Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Re-Password...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Grup Pengguna <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select name="akses_id" style="width: 100%;" id="akses_id" data-placeholder="-- Pilih Grup Pengguna --" required>
                                <option value=""></option>
                                <?php foreach($l_akses as $t): ?>
                                    <?php if(isset($user['akses_id']) && $t['akses_id'] == $user['akses_id']): ?>
                                        <option value="<?=$t['akses_id'];?>" selected><?=$t['akses'];?></option>
                                    <?php else : ?>
                                        <option value="<?=$t['akses_id'];?>" <?=set_select('akses_id', $t['akses_id'])?>><?=$t['akses'];?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Upload Avatar</label>
                        <div class="col-sm-8">
                            <input type="file" name="userfile" id="userfile" placeholder="">
                        </div>
                    </div>
                </div>
                <?php if(isset($user['nama'])): $filename = empty($user['avatar'])?'default.png':$user['avatar']; ?>
                    <div class="col-md-6">
                        <div class="col-md-4 col-xs-12">
                            <div class="text-center">
                                <!--<img src="<?=base_url('assets/images/faces/'.$filename);?>" class="img-responsive img-circle user-avatar" alt="">-->
                                <img src="<?=FSPATH.'avatar/'.$filename;?>" class="img-responsive img-circle user-avatar" alt="">
                                <h2 class="no-margin-bottom m-t-10"><?=$user['nama'];?></h2>
                                <div><?=$user['akses'];?></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?=form_close();?>
        </div>
        <div class="panel-footer">
            <div class="elements">
                <button type="button" class="btn btn-info btn-save"><i class="icon-floppy-disk position-left"></i> Simpan</button>
            </div>
            <a class="elements-toggle"><i class="icon-more"></i></a>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $('#akses_id').select2({width: 'resolve'});

        $('#userfile').uniform({
            wrapperClass: 'bg-info',
            fileButtonHtml: '<i class="icon-plus3"></i>'
        });

        $('.btn-save').on('click', function(e){
            e.preventDefault();
            $('#frm-pengguna').submit();

        });
    });
</script>


