<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-city position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Master</li>
            <li>Kepegawaian</li>
            <li><a href="<?=base_url('golongan');?>">Golongan</a></li>
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
            <?=form_open('', array('id' => 'frm-golongan','class' => 'form-horizontal'))?>
            <div class="form-group">
                <label class="control-label col-sm-2">Golongan <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="golongan" name="golongan" placeholder="Golongan..." value="<?=isset($golongan['golongan'])?$golongan['golongan']:set_value('golongan');?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Deskripsi <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi..." value="<?=isset($golongan['deskripsi'])?$golongan['deskripsi']:set_value('deskripsi');?>" required>
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
            $('#frm-golongan').submit();

        });

    });
</script>


