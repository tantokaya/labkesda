<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-map5 position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Master</li>
            <li><a href="<?=base_url('wilayah_administrasi');?>">Wilayah Administrasi</a></li>
            <li><a href="<?=($this->uri->segment(2) == 'add')?base_url('wilayah_administrasi/kota/'.substr($this->uri->segment(4),0,2)):base_url('wilayah_administrasi/kota/'.substr($this->uri->segment(4),0,2));?>">Propinsi <?=ucwords(strtolower($propinsi['propinsi']));?></a></li>
            <li><a href="<?=($this->uri->segment(2) == 'add')?base_url('wilayah_administrasi/kecamatan/'.$this->uri->segment(4)):base_url('wilayah_administrasi/kecamatan/'.substr($this->uri->segment(4),0,4));?>"><?=ucwords(strtolower($kota['kota']));?></a></li>
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
            <h5 class="panel-title"><i class="icon-three-bars position-left"></i> <?=$panel_title;?> di <?=ucwords(strtolower($kota['kota']));?></h5>
        </div>
        <div class="panel-body">
            <?=form_open('', array('id' => 'frm-kecamatan','class' => 'form-horizontal'))?>
            <div class="form-group">
                <label class="control-label col-sm-2">Kode Kecamatan <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="kecamatan_id" name="kecamatan_id" placeholder="Kode Kecamatan..." value="<?=isset($kecamatan['kecamatan_id'])?$kecamatan['kecamatan_id']:$this->uri->segment(4);?>" maxlength="6" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Kecamatan <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Kecamatan..." value="<?=isset($kecamatan['kecamatan'])?$kecamatan['kecamatan']:set_value('kecamatan');?>" maxlength="50" required>
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
            $('#frm-kecamatan').submit();
        });
    });
</script>
