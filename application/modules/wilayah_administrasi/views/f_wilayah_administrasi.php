<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-map5 position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Master</li>
            <li><a href="<?=base_url('wilayah_administrasi');?>">Wilayah Administrasi</a></li>
            <li class="active"><?=$panel_title;?></li>
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
            <h5 class="panel-title"><i class="icon-three-bars position-left"></i> <?=$panel_title;?></h5>
        </div>
        <div class="panel-body">
            <?=form_open('', array('id' => 'frm-propinsi','class' => 'form-horizontal'))?>
            <div class="form-group">
                <label class="control-label col-sm-2">Kode Propinsi <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="propinsi_id" name="propinsi_id" placeholder="Kode Propinsi..." value="<?=isset($propinsi['propinsi_id'])?$propinsi['propinsi_id']:set_value('propinsi_id');?>" maxlength="2" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Propinsi <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="propinsi" name="propinsi" placeholder="Propinsi..." value="<?=isset($propinsi['propinsi'])?$propinsi['propinsi']:set_value('propinsi');?>" maxlength="50" required>
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
            $('#frm-propinsi').submit();
        });
    });
</script>
