<style type="text/css">
    .non-perjadin, .perjadin{
        display: none;
    }
</style>
<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-calendar2 position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li><a href="<?=base_url('kegiatan');?>">Kegiatan</a></li>
            <li class="active"><?=$page_title;?></li>
        </ul>
    </div>
</div>

<?php $type = $this->uri->segment(2) == 'add'?'add':'edit';?>

<div class="container-fluid page-content">
    <div class="panel panel-default panel-bordered">
        <div class="panel-heading">
            <h5 class="panel-title"><i class="icon-three-bars position-left"></i> <?=$page_title;?></h5>
        </div>
        <div class="panel-body">
            <div class="tabbable">
                <ul class="nav nav-tabs nav-tabs-highlight nav-bordered tab-menu">
                    <li class="active"><a href="#kegiatan-tab" data-toggle="tab" aria-expanded="true"><i class="icon-calendar52 position-left"></i> Kegiatan</a></li>
                    <li class="<?=$type=='add'?'disabled':'';?>"><a href="#lampiran-tab" <?=$type=='edit'?'data-toggle="tab"':'';?> aria-expanded="false"><i class="icon-cloud-upload2 position-left"></i> Lampiran</a></li>
                    <li class="<?=$type=='add'?'disabled':'';?>"><a href="#peserta-tab" <?=$type=='edit'?'data-toggle="tab"':'';?> aria-expanded="false"><i class="icon-users2"></i> Daftar Peserta Kegiatan</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="kegiatan-tab">
                        <?=form_open('', array('id' => 'frm-kegiatan','class' => 'form-horizontal'));?>
                        <input type="hidden" id="kegiatan_id" name="kegiatan_id" value="<?=(isset($kegiatan['kegiatan_id']))?$kegiatan['kegiatan_id']:'';?>">
                        <div class="alert bg-danger" id="error_info" style="display: none;"></div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">Kegiatan <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kegiatan" name="kegiatan" placeholder="Nama Kegiatan..." value="<?=isset($kegiatan['kegiatan'])?$kegiatan['kegiatan']:set_value('kegiatan');?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Tipe Kegiatan <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <select class="select" style="width: 100%;" data-placeholder="-- Pilih Tipe Kegiatan --" name="tipe_kegiatan_id" id="tipe_kegiatan_id" required>
                                    <option></option>
                                    <?php foreach($l_tipe_kegiatan as $t): ?>
                                        <?php if(isset($kegiatan['tipe_kegiatan_id']) && $kegiatan['tipe_kegiatan_id'] == $t['tipe_kegiatan_id']): ?>
                                            <option value="<?=$t['tipe_kegiatan_id'];?>" selected><?=$t['tipe_kegiatan'];?></option>
                                        <?php else : ?>
                                            <option value="<?=$t['tipe_kegiatan_id'];?>" <?=set_select('tipe_kegiatan_id', $t['tipe_kegiatan_id'])?>><?=$t['tipe_kegiatan'];?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label class="control-label col-sm-2">Tanggal Mulai <span class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                    <input type="text" id="tanggal_mulai" name="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Publik</label>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="is_private" value="0" <?=isset($kegiatan['is_private']) && $kegiatan['is_private'] == '0'?'checked':'';?>> Ya
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="is_private" value="1" <?=isset($kegiatan['is_private']) && $kegiatan['is_private'] == '1'?'checked':'';?>> Tidak
                                </label>
                            </div>
                            <label class="control-label col-sm-2">Tanggal Akhir <span class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                    <input type="text" id="tanggal_akhir" name="tanggal_akhir" class="form-control" placeholder="Tanggal Akhir" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Jenis Kegiatan <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <select class="select" style="width: 100%;" data-placeholder="-- Pilih Jenis Kegiatan --" name="jenis_kegiatan_id" id="jenis_kegiatan_id" required>
                                    <option></option>
                                    <?php foreach($l_jenis_kegiatan as $t): ?>
                                        <?php if(isset($kegiatan['jenis_kegiatan_id']) && $kegiatan['jenis_kegiatan_id'] == $t['jenis_kegiatan_id']): ?>
                                            <option value="<?=$t['jenis_kegiatan_id'];?>" selected><?=$t['jenis_kegiatan'];?></option>
                                        <?php else : ?>
                                            <option value="<?=$t['jenis_kegiatan_id'];?>" <?=set_select('jenis_kegiatan_id', $t['jenis_kegiatan_id'])?>><?=$t['jenis_kegiatan'];?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label class="control-label col-sm-2 non-perjadin">Waktu Mulai <span class="text-danger">*</span></label>
                            <div class="col-sm-2 non-perjadin">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-alarm"></i></span>
                                    <input type="text" id="waktu_mulai" name="waktu_mulai" class="form-control" required>
                                </div>
                            </div>
                            <label class="control-label col-sm-2 perjadin">Propinsi Tujuan <span class="text-danger">*</span></label>
                            <div class="col-sm-4 perjadin">
                                <select class="select" style="width: 100%;" data-placeholder="-- Pilih Propinsi Tujuan--" name="propinsi_id" id="propinsi_id" required>
                                    <option value=""></option>
                                    <?php foreach($l_propinsi as $t):
                                        if(isset($kegiatan['kota_tujuan']) && $t['propinsi_id'] == substr($kegiatan['kota_tujuan'],0,2)): ?>
                                            <option value="<?=$t['propinsi_id'];?>" selected><?=$t['propinsi'];?></option>
                                        <?php else : ?>
                                            <option value="<?=$t['propinsi_id'];?>"><?=$t['propinsi'];?></option>
                                    <?php endif; endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group non-perjadin">
                            <label class="control-label col-sm-2">Lokasi <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi Kegiatan" value="<?=isset($kegiatan['lokasi'])?$kegiatan['lokasi']:'';?>" required />
                            </div>
                            <label class="control-label col-sm-2">Waktu Akhir <span class="text-danger">*</span></label>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-alarm"></i></span>
                                    <input type="text" id="waktu_akhir" name="waktu_akhir" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Keterangan <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <textarea name="keterangan" id="keterangan" class="form-control" required><?=isset($kegiatan['keterangan'])?$kegiatan['keterangan']:'';?></textarea>
                            </div>
                            <label class="control-label col-sm-2 perjadin">Kota/Kab. Tujuan <span class="text-danger">*</span></label>
                            <div class="col-sm-4 perjadin">
                                <select class="select" style="width: 100%;" data-placeholder="-- Pilih Kota/Kab. Tujuan --" name="kota_id" id="kota_id" required>
                                    <option value=""></option>
                                    <?php if(isset($l_kota)): ?>
                                        <?php foreach($l_kota as $t): if($t['kota_id'] == $kegiatan['kota_tujuan']): ?>
                                            <option value="<?=$t['kota_id'];?>" selected><?=$t['kota'];?></option>
                                        <?php else : ?>
                                            <option value="<?=$t['kota_id'];?>"><?=$t['kota'];?></option>
                                        <?php endif; endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <label class="control-label col-sm-2 non-perjadin">PIC <span class="text-danger">*</span></label>
                            <div class="col-sm-4 non-perjadin">
                                <input type="text" class="form-control tokenfield-primary" id="pic" name="pic" value="<?=isset($kegiatan['pic'])?$kegiatan['pic']:set_value('pic');?>" required />
                                <span>Input diakhiri dengan tanda <code>koma (,)</code> atau tombol <code>TAB</code></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">MAK <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="mak" name="mak" placeholder="MAK..." value="<?=isset($kegiatan['mak'])?$kegiatan['mak']:set_value('mak');?>" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Deskripsi MAK <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea name="desc_mak" id="desc_mak" class="form-control" required><?=isset($kegiatan['deskripsi_mak'])?$kegiatan['deskripsi_mak']:set_value('deskripsi_mak');?></textarea>
                            </div>
                        </div>

                        <?=form_close();?>
                    </div>
                    <div class="tab-pane" id="lampiran-tab">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Upload Lampiran</h5>
                            </div>
                            <div class="panel-body">
                                <form enctype="multipart/form-data">
                                    <input id="lampiran" name="lampiran[]" class="file-loading" type="file" multiple data-min-file-count="1">
                                    <div id="kv-error-2" style="margin-top:10px;display:none"></div>
                                    <div id="kv-success-2" class="alert alert-success fade in" style="margin-top:10px;display:none"></div>
                                </form>
                            </div>
                        </div>
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Lampiran</h5>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" id="list-lampiran"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="peserta-tab">
                        Daftar Peserta
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
</div>

<?php if($this->uri->segment(2) == 'edit'):
$mulai = strtotime($kegiatan['tanggal_mulai'].' '.$kegiatan['waktu_mulai']);
$akhir = strtotime($kegiatan['tanggal_akhir'].' '.$kegiatan['waktu_akhir']);
endif; ?>

<script type="text/javascript" src="<?=base_url('assets/js/sweetalert.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/full.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/interactions.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/fullcalendar-3.1.0/lib/moment.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/legacy.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/daterangepicker.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/picker.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/picker.date.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/picker.time.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/id_ID.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/fileinput.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/tokenfield.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/tables/footable.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/pnotify.min.js');?>"></script>

<script type="text/javascript">
    $(function(){
        $('.select').select2({
            minimumResultsForSearch: Infinity
        });

        var tanggal_mulai = $('#tanggal_mulai').pickadate({format: 'dd/mm/yyyy'});
        var tanggal_akhir = $('#tanggal_akhir').pickadate({format: 'dd/mm/yyyy'});
        var waktu_mulai = $('#waktu_mulai').pickatime({format: 'H:i A', formatSubmit: 'HH:i'});
        var waktu_akhir = $('#waktu_akhir').pickatime({format: 'H:i A', formatSubmit: 'HH:i'});

        $('.btn-save').on('click', function(e){
            e.preventDefault();

            var options = {};
            options.hide = true;
            options.buttons = {
                closer: true,
                sticker: true
            };

            options.opacity = 1;
            options.width = PNotify.prototype.options.width;

            $.ajax({
                type: "POST",
                dataType: "json",
                data: $('#frm-kegiatan').serializeArray(),
                url: "<?=base_url('kegiatan/save_kegiatan');?>",
                success: function(r){
                    if(r.error == false){
                        $('#error_info').html('').fadeOut('slow');

                        options.title = "Sukses";
                        options.text  = r.message;
                        options.addclass = "bg-success";
                        options.type = r.type;
                        options.icon = "icon-checkmark3";

                        $('#kegiatan_id').val(r.kegiatan_id);

                        if(r.flag == 'insert'){
                            getListLampiran(r.kegiatan_id);
                        }

                        $('ul.tab-menu li:eq(1)').removeClass('disabled', true).find('a').attr('data-toggle', 'tab');
                        $('ul.tab-menu li:eq(2)').removeClass('disabled', true).find('a').attr('data-toggle', 'tab');
                        $('.tab-menu a[href="#lampiran-tab"]').tab('show');

                        $('.btn-save').hide();

                        new PNotify(options);
                    } else {
                        var error_info = '<span class="text-semibold">Error!</span>'+ r.message;

                        $('#error_info').html(error_info).fadeIn('slow');
                    }
                },
                error: function(){
                    options.title       = "Error";
                    options.text        = "Data kegiatan gagal disimpan!";
                    options.addclass    = "bg-danger";
                    options.type        = "error";
                    options.icon        = "icon-blocked";

                    new PNotify(options);
                }
            });
        });

        $('#jenis_kegiatan_id').on('change', function(e){
            if($(this).val() !== '3'){
                $('.perjadin').hide();
                $('.non-perjadin').fadeIn('slow');
            } else {
                $('.non-perjadin').hide();
                $('.perjadin').fadeIn('slow');
            }
        });


        $('.select').select2({width: 'resolve'});

        $('#propinsi_id').on('change', function(){
            var prop_id = $(this).val();
            $('#prop_id_tmp').val(prop_id);
            $('#kota_id_tmp').val('');
            $('#kota_id').select2().html('').trigger('change');

            getListKota(prop_id);
        });

        $('#kota_id').on('change', function(){
            var kota_id = $(this).val();
            $('#kota_id_tmp').val(kota_id);
        });

        function getListKota(prop_id, kota_id){
            $.ajax({
                type: 'POST',
                url: '<?=base_url('kegiatan/get_list_kota'); ?>',
                data: 'propinsi_id='+prop_id+'&kota_id='+kota_id,
                success: function(res){
                    $('#kota_id').html(res).trigger('change');
                },
                error: function(e){
                    alert('Error: '+e);
                }
            });
        }

        // Add class on init
        $('.tokenfield-primary').on('tokenfield:initialize', function (e) {
            $(this).parent().find('.token').addClass('bg-primary')
        });

        // Initialize plugin
        $('.tokenfield-primary').tokenfield();

        // Add class when token is created
        $('.tokenfield-primary').on('tokenfield:createdtoken', function (e) {
            $(e.relatedTarget).addClass('bg-primary')
        });

        $('table.list-lampiran').footable();

        function getListLampiran(id){
            $.ajax({
                type: "POST",
                url: "<?=base_url('kegiatan/get_list_lampiran');?>",
                data: {id: id},
                success: function(res){
                    $('#list-lampiran').html(res).fadeIn('slow');
                }
            });
        }

        $('#lampiran').fileinput({
            uploadUrl: "<?=base_url('kegiatan/upload_lampiran');?>", // server upload action
            uploadAsync: false,
            minFileCount: 1,
            maxFileCount: 5,
            uploadExtraData: function() {
                var obj = {}
                obj['kegiatan_id'] = $('#kegiatan_id').val();
                return obj;
            },
            showPreview: false,
            allowedFileExtensions: ['jpg','png','xls','xlsx','pdf','ppt','pptx','doc','docx'],
            elErrorContainer: '#kv-error-2'
        }).on('filebatchpreupload', function(event, data, id, index) {
            $('#kv-success-2').html('<h4>Status Upload</h4><ul></ul>').hide();
        }).on('filebatchuploadsuccess', function(event, data) {
            var out = '';
            $.each(data.files, function(key, file) {
                var fname = file.name;
                out = out + '<li>' + 'File terupload file # ' + (key + 1) + ' - '  +  fname + ' dengan sukses.' + '</li>';
            });
            $('#kv-success-2 ul').append(out);
            $('#kv-success-2').fadeIn('slow');

            getListLampiran($('#kegiatan_id').val());
        });

        <?php if($this->uri->segment(2) == 'edit') : ?>
            getListLampiran('<?=$kegiatan['kegiatan_id'];?>');
            $('#jenis_kegiatan_id').change();

            tanggal_mulai.pickadate('picker').set('select', '<?=date('d/m/Y', $mulai);?>', {format: 'dd/mm/yyyy'});
            tanggal_akhir.pickadate('picker').set('select', '<?=date('d/m/Y', $akhir);?>', {format: 'dd/mm/yyyy'});

            waktu_mulai.pickatime('picker').set('select', '<?=date('g:i A', $mulai);?>', {format: 'H:i A', formatSubmit: 'HH:i'});
            waktu_akhir.pickatime('picker').set('select', '<?=date('g:i A', $akhir);?>', {format: 'H:i A', formatSubmit: 'HH:i'});

        <?php endif; ?>

    });
</script>


