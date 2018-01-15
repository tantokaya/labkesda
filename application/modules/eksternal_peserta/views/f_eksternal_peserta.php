<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-city position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Master</li>
            <li><a href="<?=base_url('eksternal_peserta');?>">Eksternal Peserta</a></li>
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
            <?=form_open('', array('id' => 'frm-eksternal-peserta','class' => 'form-horizontal'))?>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Nama Peserta<span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="nm_peserta" name="nm_peserta" placeholder="Nama Peserta..." value="<?=isset($eksternal_peserta['nm_peserta'])?$eksternal_peserta['nm_peserta']:set_value('nm_peserta');?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Golongan</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="golongan" name="golongan" placeholder="Golongan..." value="<?=isset($eksternal_peserta['golongan'])?$eksternal_peserta['golongan']:set_value('golongan');?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Jabatan</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan..." value="<?=isset($eksternal_peserta['jabatan'])?$eksternal_peserta['jabatan']:set_value('jabatan');?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Email</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email..." value="<?=isset($eksternal_peserta['email'])?$eksternal_peserta['email']:set_value('email');?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Alamat</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="alamat" name="alamat"><?=isset($eksternal_peserta['alamat'])?$eksternal_peserta['alamat']:set_value('alamat');?></textarea>
                        </div>
                    </div>
                </div>
            

                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-4">No Telp/Hp</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="No Telp/Hp..." value="<?=isset($eksternal_peserta['no_telepon'])?$eksternal_peserta['no_telepon']:set_value('no_telepon');?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Nama Instansi</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="nm_instansi" name="nm_instansi" placeholder="Nama Instansi..." value="<?=isset($eksternal_peserta['nm_instansi'])?$eksternal_peserta['nm_instansi']:set_value('nm_instansi');?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">NPWP</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="no_npwp" name="no_npwp" placeholder="NPWP..." value="<?=isset($eksternal_peserta['no_npwp'])?$eksternal_peserta['no_npwp']:set_value('no_npwp');?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Representatif</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="representatif" name="representatif" placeholder="Representatif..." value="<?=isset($eksternal_peserta['representatif'])?$eksternal_peserta['representatif']:set_value('representatif');?>">
                        </div>
                    </div>
                </div>
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

        $('.btn-save').on('click', function(e){
            e.preventDefault();
            $('#frm-eksternal-peserta').submit();

        });

    });
</script>