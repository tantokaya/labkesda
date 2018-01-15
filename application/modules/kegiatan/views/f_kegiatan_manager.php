<style type="text/css">
    .non-perjadin, .perjadin{
        display: none;
    }

    .modal-open {
        overflow: hidden;
        position:fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        height: 100%;
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
                <ul class="nav nav-tabs nav-tabs-highlight nav-bordered tab-menu" id="tab-kegiatan">
                    <li class="active"><a href="#kegiatan-tab" data-toggle="tab" aria-expanded="true"><i class="icon-calendar52 position-left"></i> Kegiatan</a></li>
                    <li class="<?=$type=='add'?'disabled':'';?>"><a href="#lampiran-tab" <?=$type=='edit'?'data-toggle="tab"':'';?> aria-expanded="false"><i class="icon-cloud-upload2 position-left"></i> Lampiran</a></li>
                    <li class="<?=$type=='add'?'disabled':'';?>"><a href="#lampiran-tab2" <?=$type=='edit'?'data-toggle="tab"':'';?> aria-expanded="false"><i class="icon-cloud-upload2 position-left"></i> Lampiran2</a></li>
                    <li class="<?=$type=='add'?'disabled':'';?>"><a href="#peserta-tab" <?=$type=='edit'?'data-toggle="tab"':'';?> aria-expanded="false"><i class="icon-users2"></i> Daftar Peserta Kegiatan</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="kegiatan-tab">
                        <?=form_open('', array('id' => 'frm-kegiatan','class' => 'form-horizontal'));?>
                        <input type="hidden" id="kegiatan_id" name="kegiatan_id" value="<?=(isset($kegiatan['kegiatan_id']))?$kegiatan['kegiatan_id']:'';?>">
                        <div class="alert bg-danger" id="error_info" style="display: none;"></div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">Kegiatan <span class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <select class="select" style="width: 100%;" data-placeholder="-- Kode Satuan Kerja --" name="kode_satuan_kerja" id="kode_satuan_kerja" >
                                    <option></option>
                                    <?php foreach($l_kode_bagian as $t):?>
                                        <?php if(isset($kegiatan['kode_bagian']) && $kegiatan['kode_bagian'] == $t['kode_bagian']):?>
                                            <option value="<?=$t['kode_bagian'];?>" selected><?=$t['kode_bagian'];?></option>
                                        <?php else:?>
                                            <option value="<?=$t['kode_bagian'];?>" <?=set_select('kode_bagian', $t['kode_bagian'])?>><?=$t['kode_bagian'];?></option>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-sm-7">
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
                            <label class="control-label col-sm-2 perjadin">Tipe Perjadin <span class="text-danger">*</span></label>
                            <div class="col-sm-4 perjadin">
                                <select class="select" style="width: 100%;" data-placeholder="-- Pilih Tipe Perjadin --" name="tipe_perjadin" id="tipe_perjadin" required>
                                    <option value=""></option>
                                    <option value="Dalam Kota">Dalam Kota</option>
                                    <option value="Luar Kota">Luar Kota</option>
                                    <option value="Luar Negri">Luar Negri</option>
                                </select>
                            </div>
                            <label class="control-label col-sm-2 non-perjadin">Subsektor <span class="text-danger">*</span></label>
                            <div class="col-sm-4 non-perjadin">
                                <select class="select" style="width: 100%;" data-placeholder="-- Pilih Subsektor --" name="subsektor" id="subsektor" multiple="multiple" required>
                                    <option value=""></option>
                                    <?php foreach($l_subsektor as $t):?>
                                    <?php if($filled_subsektor):?>
                                        <option value="<?=$t['subsektor_id'];?>"
                                            <?php foreach($filled_subsektor as $fs):
                                                if($fs['subsektor_id'] == $t['subsektor_id']): ?>
                                                    selected
                                                <?php endif; endforeach;?>>
                                            <?=$t['subsektor'];?></option>
                                        <?php else:?>
                                            <option value="<?=$t['subsektor_id'];?>" <?=set_select('subsektor_id', $t['subsektor_id'])?>><?=$t['subsektor'];?></option>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </select>
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
                                <h5 class="panel-title">Upload Laporan</h5>
                            </div>
                            <div class="panel-body">
                                <form enctype="multipart/form-data" class="form-horizontal">

                                    <?php
                                    if(isset($l_pengaturan_laporan)):
                                        foreach($l_pengaturan_laporan as $pl):?>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2"><?= $pl['jenis_laporan'] ?></label>
                                                <div class="col-sm-10">
                                                    <input id="lampiran<?=$pl['jenis_laporan_id']?>" name="lampiran[]" class="file-loading" type="file" multiple data-min-file-count="1">
                                                </div>
                                            </div>
                                        <?php
                                        endforeach;
                                    endif;
                                    ?>

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

                    <div class="tab-pane" id="lampiran-tab2">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Lampiran2</h5>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" id="lampiran_manager"></div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="peserta-tab">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <button type="button" id="btn-add-peserta" class="btn btn-sm btn-info">Tambah Peserta / Undangan <i class="icon-plus2"></i></button>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" id="list-peserta"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="elements">
                <button type="button" class="btn btn-info btn-save"><i class="icon-floppy-disk position-left"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-close" onclick="window.location.href='<?=base_url("kegiatan");?>'"><i class="icon-arrow-left52 position-left"></i> Kembali</button>
            </div>
        </div>
    </div>
</div>

<div id="mdl_undangan" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal_title" class="modal-title"></h4>
            </div>
            <div class="modal-body" id="modal_content"></div>
            <div class="modal-footer no-padding-top">
                <button type="button" id="simpan-peserta" class="btn bg-blue btn-sm btn-labeled"><b><i class="icon-floppy-disk"></i></b>Simpan</button>
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>
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

        <?php if($this->uri->segment(2) == 'add') :?>
            $('input:radio[name=is_private]').filter('[value=0]').prop('checked', true);
        <?php endif; ?>

        var tanggal_mulai = $('#tanggal_mulai').pickadate({format: 'dd/mm/yyyy'});
        var tanggal_akhir = $('#tanggal_akhir').pickadate({format: 'dd/mm/yyyy'});
        var waktu_mulai = $('#waktu_mulai').pickatime({format: 'H:i A', formatSubmit: 'HH:i', min: [7,0], max:[6,30]});
        var waktu_akhir = $('#waktu_akhir').pickatime({format: 'H:i A', formatSubmit: 'HH:i', min: [7,0], max:[6,30]});

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
                            getLampiranManager(r.kegiatan_id);
                            getListUndangan(r.kegiatan_id);
                        }

                        $('ul.tab-menu li:eq(1)').removeClass('disabled', true).find('a').attr('data-toggle', 'tab');
                        $('ul.tab-menu li:eq(2)').removeClass('disabled', true).find('a').attr('data-toggle', 'tab');
                        $('.tab-menu a[href="#lampiran-tab"]').tab('show');

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

        function getListLampiran(id) {
            $.ajax({
                type: "POST",
                url: "<?=base_url('kegiatan/get_list_lampiran');?>",
                data: {id: id},
                success: function (res) {
                    $('#list-lampiran').html(res).fadeIn('slow');
                }
            });
        }
        function getLampiranManager(id){
            $.ajax({
                type: "POST",
                url: "<?=base_url('kegiatan/get_lampiran_manager');?>",
                data: {id: id},
                success: function(res){
                    $('#lampiran_manager').html(res).fadeIn('slow');
                }
            });
        }

        function getListUndangan(id){
            $.ajax({
                type: "POST",
                url: "<?=base_url('kegiatan/get_list_peserta');?>",
                data: {id: id},
                success: function(res){
                    $('#list-peserta').html(res).fadeIn('slow');
                }
            });
        }

        <?php if(isset($l_pengaturan_laporan)):
            foreach($l_pengaturan_laporan as $pl):?>

        $('#lampiran<?= $pl['jenis_laporan_id']?>').fileinput({
            uploadUrl: "<?=base_url('kegiatan/upload_lampiran');?>", // server upload action
            uploadAsync: false,
            minFileCount: 1,
            maxFileCount: 5,
            uploadExtraData: function() {
                var obj = {}
                obj['kegiatan_id'] = $('#kegiatan_id').val();
//                obj['jenis_laporan'] = $("input[name='jenis_laporan[]']").map(function(){return $(this).val();}).get();
                obj['jenis_laporan'] = <?= $pl['jenis_laporan_id']?>;
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
        <?php endforeach;
        endif;?>

        $('#peserta-tab').delegate('button#btn-add-peserta', 'click', function(e){
            e.preventDefault();
            var title = ($('#jenis_kegiatan_id').val() == '3')?'Perjadin':'FGD / Rapat / Seminar';
            $('#modal_title').html('Tambah Peserta Kegiatan ' + title);

            $.ajax({
                type: "POST",
                url: "<?=base_url('kegiatan/form_peserta_add');?>",
                data: {id: $('#kegiatan_id').val(),jenis_kegiatan_id: $('#jenis_kegiatan_id').val()},
                success: function (result) {
                    $('#modal_content').html(result);
                    if($('#jenis_kegiatan_id').val() == '3'){
                        var tanggal_mulai2 = $('#tanggal_mulai2').pickadate({format: 'dd/mm/yyyy'});
                        var tanggal_akhir2 = $('#tanggal_akhir2').pickadate({format: 'dd/mm/yyyy'});

                        tanggal_mulai2.pickadate('picker').set('select', tanggal_mulai.val(), {format: 'dd/mm/yyyy'});
                        tanggal_akhir2.pickadate('picker').set('select', tanggal_akhir.val(), {format: 'dd/mm/yyyy'});
                    }
                },
                error: function(er){
                    new PNotify({
                        title: 'Error',
                        text: 'Terjadi kesalahan gagal load form tambah peserta kegiatan!',
                        icon: 'icon-blocked',
                        type: 'error',
                        addclass: 'bg-danger'
                    });
                }
            });
            $('#mdl_undangan').modal('show');
        });

        $('#simpan-peserta').on('click', function(e){
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
                type:   "POST",
                dataType: "json",
                data: $('#frm-peserta').serializeArray(),
                url: "<?=base_url('kegiatan/save_peserta');?>",
                success: function(response){
                    if(response.error == false){
                        $('#error_info2').html('').fadeOut('slow');

                        options.title = "Sukses";
                        options.text  = response.message;
                        options.addclass = "bg-success";
                        options.type = response.type;
                        options.icon = "icon-checkmark3";

                        getListUndangan($('#kegiatan_id').val());

                        $('#mdl_undangan').modal('hide');

                        new PNotify(options);
                    } else {
                        var error_info2 = '<span class="text-semibold">Error!</span>'+ response.message;

                        $('#error_info2').html(error_info2).fadeIn('slow');
                    }
                },
                error: function(){
                    options.title       = "Error";
                    options.text        = "Data peserta kegiatan gagal disimpan!";
                    options.addclass    = "bg-danger";
                    options.type        = "error";
                    options.icon        = "icon-blocked";

                    new PNotify(options);
                }

            });
        });

        $('#tab-kegiatan a').on('shown.bs.tab', function (e) {
            var active = $.trim($('#tab-kegiatan .active').text());
            if(active === 'Kegiatan'){
                $('.btn-save').show();
            } else {
                $('.btn-save').hide();
            }
        });

        $('#mdl_undangan').on('hide.bs.modal',function(e){
            $('#simpan-peserta').show();
        });

        <?php if($this->uri->segment(2) == 'edit') : ?>
        getListLampiran('<?=$kegiatan['kegiatan_id'];?>');
        getLampiranManager('<?=$kegiatan['kegiatan_id'];?>');
        getListUndangan('<?=$kegiatan['kegiatan_id'];?>');
        $('#jenis_kegiatan_id').change();

        tanggal_mulai.pickadate('picker').set('select', '<?=date('d/m/Y', $mulai);?>', {format: 'dd/mm/yyyy'});
        tanggal_akhir.pickadate('picker').set('select', '<?=date('d/m/Y', $akhir);?>', {format: 'dd/mm/yyyy'});

        waktu_mulai.pickatime('picker').set('select', '<?=date('g:i A', $mulai);?>', {format: 'H:i A', formatSubmit: 'HH:i'});
        waktu_akhir.pickatime('picker').set('select', '<?=date('g:i A', $akhir);?>', {format: 'H:i A', formatSubmit: 'HH:i'});

        <?php endif; ?>

    });
</script>