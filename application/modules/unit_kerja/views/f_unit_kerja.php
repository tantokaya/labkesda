<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-city position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Master</li>
            <li>Kepegawaian</li>
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
            <?=form_open('', array('id' => 'frm-unit-kerja','class' => 'form-horizontal'))?>

            <div class="form-group">
                <label class="control-label col-sm-2">Kode Unit Kerja <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="unit_kerja_id" name="unit_kerja_id" placeholder="Kode Unit Kerja..." value="<?=isset($unit_kerja['unit_kerja_id'])?$unit_kerja['unit_kerja_id']:set_value('unit_kerja_id');?>" <?=isset($unit_kerja['unit_kerja_id']) ? 'readonly' : 'required';?>>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Unit Kerja <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="unit_kerja" name="unit_kerja" placeholder="Unit Kerja..." value="<?=isset($unit_kerja['unit_kerja'])?$unit_kerja['unit_kerja']:set_value('unit_kerja');?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Eselon <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <select class="select" style="width: 100%;" data-placeholder="-- Pilih Eselon --" name="eselon" id="eselon" required>
                        <option></option>
                        <option value="1" <?=isset($unit_kerja['eselon']) && $unit_kerja['eselon'] == 1  ? 'selected':'';?> <?=set_select('eselon','1')?>>Eselon I</option>
                        <option value="2" <?=isset($unit_kerja['eselon']) && $unit_kerja['eselon'] == 2 ? 'selected':'';?> <?=set_select('eselon','2')?>>Eselon II</option>
                        <option value="3" <?=isset($unit_kerja['eselon']) && $unit_kerja['eselon'] == 3  ? 'selected':'';?> <?=set_select('eselon','3')?>>Eselon III</option>
                        <option value="4" <?=isset($unit_kerja['eselon']) && $unit_kerja['eselon'] == 4  ? 'selected':'';?> <?=set_select('eselon','4')?>>Eselon IV</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Jabatan <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <select class="select" style="width: 100%;" data-placeholder="-- Pilih Jabatan --" name="jabatan_id" id="jabatan_id" required>
                        <option></option>
                         <?php foreach($jabatan as $t): ?>
                            <?php if(isset($unit_kerja['jabatan_id']) && $unit_kerja['jabatan_id'] == $t['jabatan_id']): ?>
                                <option value="<?=$t['jabatan_id'];?>" selected> <?=$t['jabatan'];?></option>
                            <?php else : ?>
                                <option value="<?=$t['jabatan_id'];?>" <?=set_select('jabatan_id', $t['jabatan_id']);?>> <?=$t['jabatan'];?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Level <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <select class="select" style="width: 100%;" data-placeholder="-- Pilih Level --" name="level" id="level" required>
                        <option></option>
                        <option value="1" <?=isset($unit_kerja['level']) && $unit_kerja['level'] == 1  ? 'selected="selected"':'';?> <?=set_select('level','<?=$unit_kerja["1"]?>')?>>level 1</option>
                        <option value="2" <?=isset($unit_kerja['level']) && $unit_kerja['level'] == 2 ? 'selected="selected"':'';?> <?=set_select('level','<?=$unit_kerja["2"]?>')?>>level 2</option>
                        <option value="3" <?=isset($unit_kerja['level']) && $unit_kerja['level'] == 3  ? 'selected="selected"':'';?> <?=set_select('level','<?=$unit_kerja["3"]?>')?>>level 3</option>
                        <option value="3" <?=isset($unit_kerja['level']) && $unit_kerja['level'] == 4  ? 'selected="selected"':'';?> <?=set_select('level','<?=$unit_kerja["4"]?>')?>>level 4</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Parent</span></label>
                <div class="col-sm-4">
                    <select class="select" style="width: 100%;" data-placeholder="-- Pilih Parent --" name="parent" id="parent" required>
                        <option></option>
                        <?php foreach($all_unit_kerja as $t): ?>
                            <?php if(isset($unit_kerja['unit_kerja_id']) && $unit_kerja['parent'] == $t['unit_kerja_id']): ?>
                                <option value="<?=$t['unit_kerja_id'];?>" selected><?=$t['unit_kerja'];?></option>
                            <?php else : ?>
                                <option value="<?=$t['unit_kerja_id'];?>" <?=set_select('unit_kerja_id', $t['unit_kerja_id'])?>><?=$t['unit_kerja'];?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Mark <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="mark" name="mark" placeholder="Mark..." value="<?=isset($unit_kerja['mark'])?$unit_kerja['mark']:set_value('mark');?>" required>
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
            $('#frm-unit-kerja').submit();

        });

        $('.select').select2({width: 'resolve'});
    });
</script>