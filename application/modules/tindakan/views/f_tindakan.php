<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-city position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Master</li>
            <li><a href="<?=base_url('tindakan');?>">Tindakan</a></li>
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
            <?=form_open('', array('id' => 'frm-tindakan','class' => 'form-horizontal'))?>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12">Nama Tindakan <span class="text-danger">*</span></label>
                    <div class="col-md-6 col-sm-12">
                        <input type="text" class="form-control" id="tindakan" name="tindakan" placeholder="..." value="<?=isset($tindakan['tindakan'])?$tindakan['tindakan']:set_value('tindakan');?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12">Gol Tindakan <span class="text-danger">*</span></label>
                    <div class="col-md-6 col-sm-12">
                        <select class="select" style="width: 100%;" data-placeholder="-- Pilih Gol Tindakan --" name="gol_tindakan_id" id="gol_tindakan_id" required>
                            <option></option>
                            <?php foreach($l_gol_tindakan as $t): ?>
                                <?php if(isset($tindakan['gol_tindakan_id']) && $tindakan['gol_tindakan_id'] == $t['gol_tindakan_id']): ?>
                                    <option value="<?=$t['gol_tindakan_id'];?>" selected><?=$t['gol_tindakan_nama'];?></option>
                                <?php else : ?>
                                    <option value="<?=$t['gol_tindakan_id'];?>" <?=set_select('gol_tindakan_id', $t['gol_tindakan_id'])?>><?=$t['gol_tindakan_nama'];?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12">Sub Gol Tindakan <span class="text-danger">*</span></label>
                    <div class="col-md-6 col-sm-12">
                        <select class="select" style="width: 100%;" data-placeholder="-- Pilih Sub Gol Tindakan --" name="sub_gol_tind_id" id="sub_gol_tind_id" required>
                            <option></option>
                            <?php foreach($l_sub_gol_tindakan as $t): ?>
                                <?php if(isset($tindakan['sub_gol_tind_id']) && $tindakan['sub_gol_tind_id'] == $t['sub_gol_tind_id']): ?>
                                    <option value="<?=$t['sub_gol_tind_id'];?>" selected><?=$t['sub_gol_tind_nama'];?></option>
                                <?php else : ?>
                                    <option value="<?=$t['sub_gol_tind_id'];?>" <?=set_select('sub_gol_tind_id', $t['sub_gol_tind_id'])?>><?=$t['sub_gol_tind_nama'];?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12">Singkatan</label>
                    <div class="col-md-6 col-sm-12">
                        <input type="text" class="form-control" id="singkatan" name="singkatan" placeholder="..." value="<?=isset($tindakan['singkatan'])?$tindakan['singkatan']:set_value('singkatan');?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12">Satuan</label>
                    <div class="col-md-2 col-sm-12">
                        <input type="text" class="form-control" id="n_rujukan" name="n_rujukan" placeholder="..." value="<?=isset($tindakan['n_rujukan'])?$tindakan['n_rujukan']:set_value('n_rujukan');?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12">Nilai Rujukan Bawah</label>
                    <div class="col-md-4 col-sm-12">
                        <input type="text" class="form-control" id="n_bawah" name="n_bawah" placeholder="..." value="<?=isset($tindakan['nilai_bawah'])?$tindakan['nilai_bawah']:set_value('nilai_bawah');?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12">Nilai Rujukan Atas</label>
                    <div class="col-md-4 col-sm-12">
                        <input type="text" class="form-control" id="n_atas" name="n_atas" placeholder="..." value="<?=isset($tindakan['nilai_atas'])?$tindakan['nilai_atas']:set_value('nilai_atas');?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12">Harga Sarana (Rp)</label>
                    <div class="col-md-4 col-sm-12">
                        <input type="text" class="form-control" id="harga_sarana" name="harga_sarana" placeholder="..." value="<?=isset($tindakan['harga_sarana'])?$tindakan['harga_sarana']:set_value('harga_sarana');?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-12">Harga Pelayanan (Rp)</label>
                    <div class="col-md-4 col-sm-12">
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="..." value="<?=isset($tindakan['harga'])?$tindakan['harga']:set_value('harga');?>">
                    </div>
                </div>
<!--                <div class="form-group">-->
<!--                    <label class="control-label col-md-4 col-sm-12">Aktif</label>-->
<!--                    <div class="col-md-4 col-sm-12">-->
<!--                        --><?php
//                        $publish = $tindakan['is_default'];
//                        if($publish==''||$publish=='0'){
//                            ?>
<!--                            <label class="radio-inline">-->
<!--                                <input type="radio"  id="publish" name="publish" value="1" > Ya-->
<!--                            </label>-->
<!--                            <label class="radio-inline">-->
<!--                                <input type="radio"  id="publish" name="publish" value="0" checked> Tidak-->
<!--                            </label>-->
<!--                        --><?php //} else { ?>
<!--                            <label class="radio-inline">-->
<!--                                <input type="radio"  id="publish" name="publish" value="1" checked> Ya-->
<!--                            </label>-->
<!--                            <label class="radio-inline">-->
<!--                                <input type="radio"  id="publish" name="publish" value="0"> Tidak-->
<!--                            </label>-->
<!--                        --><?php //} ?>
<!--                    </div>-->
<!--                </div>-->
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
            $('#frm-tindakan').submit();

        });

        $('.select').select2({width: 'resolve'});

    });
</script>


