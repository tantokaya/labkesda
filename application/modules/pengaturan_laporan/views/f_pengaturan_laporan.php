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
            <?=form_open('', array('id' => 'frm-pengaturan-laporan','class' => 'form-horizontal'))?>
            <div class="form-group">
                <label class="control-label col-sm-2">Jenis Kegiatan <span class="text-danger">*</span></label>
                <input type="hidden" name="jenis_kegiatan_id" value="<?=$pengaturan_laporan['jenis_kegiatan_id']?>">
                <div class="col-sm-4">
                <select class="select" style="width: 100%;" data-placeholder="-- Pilih Jenis Kegiatan --" name="jenis_kegiatan_id" id="jenis_kegiatan_id" <?=($pengaturan_laporan != NULL)? 'disabled':'required'?>>
                    <option value=""></option>
                    <?php foreach($jenis_kegiatan as $t):
                        if(isset($pengaturan_laporan['jenis_kegiatan_id']) && $pengaturan_laporan['jenis_kegiatan_id'] == $t['jenis_kegiatan_id']): ?>
                            <option value="<?=$t['jenis_kegiatan_id'];?>" selected><?=$t['jenis_kegiatan'];?></option>
                        <?php else : ?>
                            <option value="<?=$t['jenis_kegiatan_id'];?>" <?=set_select('jenis_kegiatan_id', $t['jenis_kegiatan_id'])?>><?=$t['jenis_kegiatan'];?></option>
                        <?php endif; ?> 
                    <?php endforeach; ?>
                </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Jenis Laporan <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                <select class="select" style="width: 100%;" data-placeholder="Jenis Laporan" name="jenis_laporan_id[]" id="jenis_laporan_id" multiple="multiple" required>
                    <option value=""></option>
                    <?php foreach($jenis_laporan as $t):?>
                        <?php if($pengaturan_laporan != NULL):?>
                            <option value="<?=$t['jenis_laporan_id'];?>" 
                            <?php foreach($_pengaturan_laporan as $datas):
                            if(isset($datas['jenis_laporan_id']) && $datas['jenis_laporan_id'] == $t['jenis_laporan_id']): ?>
                            selected  
                            <?php endif; endforeach;?>><?=$t['jenis_laporan'];?></option>
                        
                        <?php else:?>
                            <option value="<?=$t['jenis_laporan_id'];?>" <?=set_select('jenis_laporan_id', $t['jenis_laporan_id'])?>><?=$t['jenis_laporan'];?></option>
                        <?php endif;?>
                    <?php endforeach; ?>
                </select>
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
        $('.select').select2({
            minimumResultsForSearch: Infinity
        });

        $('.btn-save').on('click', function(e){
            e.preventDefault();
            $('#frm-pengaturan-laporan').submit();

        });

    });
</script>

<script type="text/javascript">

    $("#jenis_laporan_id").on('change', function () {
        console.log($(this).val());
    });
</script>
