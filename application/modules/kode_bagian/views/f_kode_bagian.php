<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-city position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Master</li>
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
            <?=form_open('', array('id' => 'frm-kode-bagian','class' => 'form-horizontal'))?>
            <div class="form-group">
                <label class="control-label col-sm-2">Kode Bagian <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="kode_bagian" name="kode_bagian" placeholder="Kode Bagian..." value="<?=isset($kode_bagian['kode_bagian'])?$kode_bagian['kode_bagian']:set_value('kode_bagian');?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Deskripsi</label>
                <div class="col-sm-4">
                    <textarea class="form-control" id="deskripsi" name="deskripsi"><?=isset($kode_bagian['deskripsi'])?$kode_bagian['deskripsi']:set_value('deskripsi');?></textarea>
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
            $('#frm-kode-bagian').submit();

        });

    });
</script>


