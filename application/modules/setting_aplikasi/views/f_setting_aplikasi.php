<script src="<?=base_url('assets/js/sweetalert.js');?>"></script>
<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-gear position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Pengaturan</li>
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

    <?=form_open('', array('id' => 'frm-setting-aplikasi','class' => 'form-horizontal'))?>
    <div class="panel panel-default panel-bordered">
        <div class="panel-heading">
            <h5 class="panel-title"><i class="icon-three-bars position-left"></i> <?=$page_title;?></h5>
            <div class="elements panel-tabs">
                <ul class="nav nav-tabs nav-sm nav-tabs-bottom">
                    <li class="active"><a href="#setting" data-toggle="tab" aria-expanded="true"><i class="icon-gear position-left"></i> Setting Aplikasi</a></li>
                    <li class=""><a href="#tema" data-toggle="tab" aria-expanded="false"><i class="icon-color-sampler position-left"></i> Tema</a></li>
                </ul>
            </div>
            <a class="elements-toggle"><i class="icon-more"></i></a></div>
        <div class="panel-tab-content tab-content">


            <div class="tab-pane has-padding active" id="setting">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="app_name">Nama Aplikasi</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="app_name" name="app_name" value="<?=$app['app_name'];?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="app_company">Nama Instansi</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="app_company" name="app_company" value="<?=$app['app_company'];?>" required>
                    </div>
                </div>
            </div>

            <div class="tab-pane has-padding" id="tema">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Light</label>
                    <div class="col-sm-8">
                        <label class="radio-inline theme" id="light">
                            <input type="radio" name="app_theme" value="light" <?=$app['app_theme']=='light'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/light.jpg');?>" alt=""/>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Black</label>
                    <div class="col-sm-8">
                        <label class="radio-inline theme" id="mirage">
                            <input type="radio" name="app_theme" value="mirage" <?=$app['app_theme']=='mirage'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/mirage_dark.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="mirage_light">
                            <input type="radio" name="app_theme" value="mirage_light" <?=$app['app_theme']=='mirage_light'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/mirage_light.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="mirage_light_sidebar">
                            <input type="radio" name="app_theme" value="mirage_light_sidebar" <?=$app['app_theme']=='mirage_light_sidebar'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/mirage_light_sidebar.jpg');?>" alt=""/>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Red</label>
                    <div class="col-sm-8">
                        <label class="radio-inline theme" id="burnt_sienna_dark">
                            <input type="radio" name="app_theme" value="burnt_sienna_dark" <?=$app['app_theme']=='burnt_sienna_dark'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/burnt_sienna_dark.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="burnt_sienna_light">
                            <input type="radio" name="app_theme" value="burnt_sienna_light" <?=$app['app_theme']=='burnt_sienna_light'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/burnt_sienna_light.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="burnt_sienna_light_sidebar">
                            <input type="radio" name="app_theme" value="burnt_sienna_light_sidebar" <?=$app['app_theme']=='burnt_sienna_light_sidebar'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/burnt_sienna_light_sidebar.jpg');?>" alt=""/>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Purple</label>
                    <div class="col-sm-8">
                        <label class="radio-inline theme" id="amethyst_dark">
                            <input type="radio" name="app_theme" value="amethyst_dark" <?=$app['app_theme']=='amethyst_dark'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/amethyst_dark.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="amethyst_light">
                            <input type="radio" name="app_theme" value="amethyst_light" <?=$app['app_theme']=='amethyst_light'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/amethyst_light.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="amethyst_light_sidebar">
                            <input type="radio" name="app_theme" value="amethyst_light_sidebar" <?=$app['app_theme']=='amethyst_light_sidebar'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/amethyst_light_sidebar.jpg');?>" alt=""/>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Fuchsia Blue</label>
                    <div class="col-sm-8">
                        <label class="radio-inline theme" id="fuchsiablue_dark">
                            <input type="radio" name="app_theme" value="fuchsiablue_dark" <?=$app['app_theme']=='fuchsiablue_dark'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/fuchsiablue_dark.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="fuchsiablue_light">
                            <input type="radio" name="app_theme" value="fuchsiablue_light" <?=$app['app_theme']=='fuchsiablue_light'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/fuchsiablue_light.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="fuchsiablue_light_sidebar">
                            <input type="radio" name="app_theme" value="fuchsiablue_light_sidebar" <?=$app['app_theme']=='fuchsiablue_light_sidebar'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/fuchsiablue_light_sidebar.jpg');?>" alt=""/>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Blue</label>
                    <div class="col-sm-8">
                        <label class="radio-inline theme" id="pictonblue_dark">
                            <input type="radio" name="app_theme" value="pictonblue_dark" <?=$app['app_theme']=='pictonblue_dark'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/pictonblue_dark.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="pictonblue_light">
                            <input type="radio" name="app_theme" value="pictonblue_light" <?=$app['app_theme']=='pictonblue_light'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/pictonblue_light.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="pictonblue_light_sidebar">
                            <input type="radio" name="app_theme" value="pictonblue_light_sidebar" <?=$app['app_theme']=='pictonblue_light_sidebar'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/pictonblue_light_sidebar.jpg');?>" alt=""/>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Dark Green</label>
                    <div class="col-sm-8">
                        <label class="radio-inline theme" id="junglegreen_dark">
                            <input type="radio" name="app_theme" value="junglegreen_dark" <?=$app['app_theme']=='junglegreen_dark'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/junglegreen_dark.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="junglegreen_light">
                            <input type="radio" name="app_theme" value="junglegreen_light" <?=$app['app_theme']=='junglegreen_light'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/junglegreen_light.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="junglegreen_light_sidebar">
                            <input type="radio" name="app_theme" value="junglegreen_light_sidebar" <?=$app['app_theme']=='junglegreen_light_sidebar'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/junglegreen_light_sidebar.jpg');?>" alt=""/>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Green</label>
                    <div class="col-sm-8">
                        <label class="radio-inline theme" id="fern_dark">
                            <input type="radio" name="app_theme" value="fern_dark" <?=$app['app_theme']=='fern_dark'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/fern_dark.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="fern_light">
                            <input type="radio" name="app_theme" value="fern_light" <?=$app['app_theme']=='fern_light'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/fern_light.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="fern_light_sidebar">
                            <input type="radio" name="app_theme" value="fern_light_sidebar" <?=$app['app_theme']=='fern_light_sidebar'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/fern_light_sidebar.jpg');?>" alt=""/>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Yellow</label>
                    <div class="col-sm-8">
                        <label class="radio-inline theme" id="sunglow_dark">
                            <input type="radio" name="app_theme" value="sunglow_dark" <?=$app['app_theme']=='sunglow_dark'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/sunglow_dark.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="sunglow_light">
                            <input type="radio" name="app_theme" value="sunglow_light" <?=$app['app_theme']=='sunglow_light'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/sunglow_light.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="sunglow_light_sidebar">
                            <input type="radio" name="app_theme" value="sunglow_light_sidebar" <?=$app['app_theme']=='sunglow_light_sidebar'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/sunglow_light_sidebar.jpg');?>" alt=""/>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Grey</label>
                    <div class="col-sm-8">
                        <label class="radio-inline theme" id="regentgrey_dark">
                            <input type="radio" name="app_theme" value="regentgrey_dark" <?=$app['app_theme']=='regentgrey_dark'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/regentgrey_dark.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="regentgrey_light">
                            <input type="radio" name="app_theme" value="regentgrey_light" <?=$app['app_theme']=='regentgrey_light'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/regentgrey_light.jpg');?>" alt=""/>
                        </label>
                        <label class="radio-inline theme" id="regentgrey_light_sidebar">
                            <input type="radio" name="app_theme" value="regentgrey_light_sidebar" <?=$app['app_theme']=='regentgrey_light_sidebar'?'checked':'';?>>
                            <img src="<?=base_url('assets/images/themes/regentgrey_light_sidebar.jpg');?>" alt=""/>
                        </label>
                    </div>
                </div>
            </div>

        </div>

        <div class="panel-footer">
            <div class="elements">
                <button type="button" class="btn btn-info btn-save"><i class="icon-floppy-disk position-left"></i> Simpan</button>
            </div>
            <a class="elements-toggle"><i class="icon-more"></i></a>
        </div>
    </div>
    <?=form_close();?>

</div>

<script type="text/javascript">
    $(function(){
        $('#userfile').uniform({
            wrapperClass: 'bg-info',
            fileButtonHtml: '<i class="icon-plus3"></i>'
        });


        $('.btn-save').on('click', function(e){
            e.preventDefault();
            $('#frm-setting-aplikasi').submit();

        });

        $(".theme").on("click", function(){
            var theme = $(this).attr('id').toLowerCase();
            $('#theme').attr('href','assets/css'+'/themes/'+theme+'.css');
        });

        <?php if($this->session->flashdata('notif')): ?>
        swal("<?=$this->session->flashdata('notif');?>", "", "<?=$this->session->flashdata('type');?>");
        <?php endif; ?>
    });
</script>
