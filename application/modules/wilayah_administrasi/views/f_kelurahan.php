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
            <li><a href="<?=($this->uri->segment(2) == 'add')?base_url('wilayah_administrasi/kecamatan/'.substr($this->uri->segment(4),0,4)):base_url('wilayah_administrasi/kecamatan/'.substr($this->uri->segment(4),0,4));?>"><?=ucwords(strtolower($kota['kota']));?></a></li>
            <li><a href="<?=($this->uri->segment(2) == 'add')?base_url('wilayah_administrasi/kelurahan/'.$this->uri->segment(4)):base_url('wilayah_administrasi/kelurahan/'.substr($this->uri->segment(4),0,6));?>">Kec. <?=ucwords(strtolower($kecamatan['kecamatan']));?></a></li>
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
            <h5 class="panel-title"><i class="icon-three-bars position-left"></i> <?=$panel_title;?> di Kecamatan <?=ucwords(strtolower($kecamatan['kecamatan']));?></h5>
        </div>
        <div class="panel-body">
            <?=form_open('', array('id' => 'frm-kelurahan','class' => 'form-horizontal'))?>
            <div class="form-group">
                <label class="control-label col-sm-2">Kode Kelurahan/Desa <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="kelurahan_id" name="kelurahan_id" placeholder="Kode Kelurahan/Desa..." value="<?=isset($kelurahan['kelurahan_id'])?$kelurahan['kelurahan_id']:$this->uri->segment(4);?>" maxlength="10" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Kelurahan/Desa <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Kelurahan/Desa..." value="<?=isset($kelurahan['kelurahan'])?$kelurahan['kelurahan']:set_value('kelurahan');?>" maxlength="50" required>
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
            $('#frm-kelurahan').submit();
        });
    });
</script>
