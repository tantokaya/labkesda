<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-menu6 position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Pengaturan</li>
            <li>Menu</li>
            <li><a href="<?=base_url('menu');?>">Daftar Menu</a></li>
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
            <?=form_open('', array('id' => 'frm-akses','class' => 'form-horizontal'))?>
            <div class="form-group">
                <label class="control-label col-sm-2">Menu <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" placeholder="Menu..." name="menu" id="menu" value="<?=isset($menu['menu'])?$menu['menu']:set_value('menu');?>" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">URL / Link</label>
                <div class="col-sm-4">
                    <input type="text" placeholder="URL / Link" name="link" id="link" value="<?=isset($menu['link'])?$menu['link']:set_value('link');?>" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Parent <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <select style="width: 100%;" class="form-control populate placeholder" name="parent" id="parent" required></select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Menu Order <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" placeholder="Menu Order" name="menu_order" id="menu_order" value="<?=isset($menu['menu_order'])?$menu['menu_order']:set_value('menu_order');?>" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Published</label>
                <div class="col-sm-4">
                    <div class="checkbox-custom checkbox-primary">
                        <input type="checkbox" value="1" <?php echo isset($menu['published'])&&$menu['published']=='1'?'checked':'';?> id="published" name="published">
                        <label for="published"></label>
                    </div>
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
            $('#frm-akses').submit();

        });

        $('#parent').select2({
            width: 'resolve',
            data: <?php echo $l_menu; ?>
        });

        <?php if($this->uri->segment(2) == 'edit'): ?>
            <?php $parent = isset($menu['parent'])?$menu['parent']:'0'; ?>
            $('#parent').val(<?=$parent?>).trigger('change');
        <?php endif; ?>
    });
</script>

