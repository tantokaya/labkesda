<script type="text/javascript" src="<?=base_url('assets/js/forms/spectrum.js');?>"></script>

<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-accessibility position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Master</li>
            <li>Kegiatan</li>
            <li><a href="<?=base_url('jenis_kegiatan');?>">Jenis Kegiatan</a></li>
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
            <?=form_open('', array('id' => 'frm-jenis-kegiatan','class' => 'form-horizontal'))?>
            <div class="form-group">
                <label class="control-label col-sm-2">Jenis Kegiatan <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="jenis_kegiatan" name="jenis_kegiatan" placeholder="Jenis Kegiatan..." value="<?=isset($jenis_kegiatan['jenis_kegiatan'])?$jenis_kegiatan['jenis_kegiatan']:set_value('jenis_kegiatan');?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Warna Jenis Kegiatan <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control colorpicker" id="warna_jenis_kegiatan" name="warna_jenis_kegiatan" value="<?=isset($jenis_kegiatan['warna_jenis_kegiatan'])?$jenis_kegiatan['warna_jenis_kegiatan']:'#FFFFFF';?>" required>
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
            $('#frm-jenis-kegiatan').submit();
        });

        $('.colorpicker').spectrum({
            showInitial: true,
            showInput: true,
            allowEmpty: false,
            preferredFormat: 'hex',
            cancelText: 'Batal',
            chooseText: 'Pilih'
        });
    });
</script>


