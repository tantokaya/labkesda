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

                    <div class="form-group" id="field_jabatan" style="display: none;">
                        <label class="control-label col-sm-3">Jabatan<span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select name="jabatan_id" id="jabatan_id" style="width: 100%;" data-placeholder="-- Pilih Jabatan --"><?=isset($l_jabatan)?$l_jabatan:'';?></select>
                        </div>
                    </div>

                    <div class="form-group" id="field_satker" style="display: none;">
                        <label class="control-label col-sm-3">Satuan Kerja <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select name="unit_kerja_id" id="unit_kerja_id" style="width: 100%;" data-placeholder="-- Pilih Satuan Kerja --"><?=isset($l_satker)?$l_satker:'';?></select>
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
        $('#unit_kerja_id, #jabatan_id').select2({width: 'resolve'});

        $('#userfile').uniform({
            wrapperClass: 'bg-info',
            fileButtonHtml: '<i class="icon-plus3"></i>'
        });

        $('.btn-save').on('click', function(e){
            e.preventDefault();
            $('#frm-pengguna').submit();

        });

        $('#akses_id').on('change', function(e){
            e.preventDefault();
            var akses_id = $(this).val();

            cek_akses(akses_id);
        });

        <?php if(validation_errors()): ?>
            cek_akses($('#akses_id').val());
        <?php endif; ?>

        <?php if($this->uri->segment(2) == 'edit' && $user['akses_id'] >= '3'): ?>
           $('#field_satker').show();
        <?php endif; ?>

        <?php if($this->uri->segment(2) == 'edit' && $user['akses_id'] >= '2'): ?>
        $('#field_jabatan').show();
        <?php endif; ?>

        function cek_akses(akses_id){
            if(akses_id == '2'){
                get_list_jabatan(akses_id);
                $('#field_jabatan').fadeIn('slow');
                $('#field_satker').fadeOut('slow');

            } else if(akses_id >= '3'){
                $('#field_satker, #field_jabatan').fadeIn('slow');
                get_list_satker(akses_id);
                get_list_jabatan(akses_id);
            } else {
                $('#field_satker, #field_jabatan').fadeOut('slow');
            }
        }

        function get_list_satker(id){
            $.ajax({
                type: 'POST',
                url: '<?=base_url('pengguna/get_list_satker');?>',
                data: {id: id},
                success: function(res){
                    $('#unit_kerja_id').html(res);
                },
                error: function(er){

                }
            });
        }

        function get_list_jabatan(id){
            $.ajax({
                type: 'POST',
                url: '<?=base_url('pengguna/get_list_jabatan');?>',
                data: {id: id},
                success: function(res){
                    $('#jabatan_id').html(res);
                },
                error: function(er){

                }
            });
        }

    });
</script>


