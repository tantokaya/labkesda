<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-accessibility position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Master</li>
            <li>Kegiatan</li>
            <li><a href="<?=base_url('sbk_fgd');?>">SBK FGD</a></li>
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
            <?=form_open('', array('id' => 'frm-sbk-fgd','class' => 'form-horizontal'))?>
            <div class="form-group">
                <label class="control-label col-sm-3">Nama Propinsi <span class="text-danger">*</span></label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="propinsi" name="propinsi" placeholder="Nama Propinsi..." value="<?=isset($sbk_fgd['propinsi'])?$sbk_fgd['propinsi']:set_value('propinsi');?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Fullboard Luar Kota <span class="text-danger">*</span></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="fblk" name="fblk" placeholder="Fullboard Luar Kota..." value="<?=isset($sbk_fgd['fblk'])?$sbk_fgd['fblk']:set_value('fblk');?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Fullboard Dlaam Kota <span class="text-danger">*</span></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="fbdk" name="fbdk" placeholder="Fullboard Dalam Kota..." value="<?=isset($sbk_fgd['fbdk'])?$sbk_fgd['fbdk']:set_value('fbdk');?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Fullday / Halfday Dalam Kota <span class="text-danger">*</span></label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="fddk" name="fddk" placeholder="Fullday/Halfday Dalam Kota..." value="<?=isset($sbk_fgd['fddk'])?$sbk_fgd['fddk']:set_value('fddk');?>" required>
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
            $('#frm-sbk-fgd').submit();

        });

    });
</script>
