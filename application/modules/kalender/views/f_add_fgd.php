<div class="tabbable">
    <ul class="nav nav-tabs nav-tabs-highlight nav-bordered tab-menu" id="tab-kegiatan">
        <li class="active"><a href="#kegiatan-tab" data-toggle="tab" aria-expanded="true"><i class="icon-calendar52 position-left"></i> Kegiatan</a></li>
        <li class="disabled"><a href="#lampiran-tab" aria-expanded="false"><i class="icon-cloud-upload2 position-left"></i> Lampiran</a></li>
        <li class="disabled"><a href="#peserta-tab" aria-expanded="false"><i class="icon-users2"></i> Daftar Peserta Kegiatan</a></li>
        <li class="disabled"><a href="#internal-tab" aria-expanded="false"><i class="icon-users2"></i> Internal</a></li>
        <li class="disabled"><a href="#eksternal-tab" aria-expanded="false"><i class="icon-users2"></i> Eksternal</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="kegiatan-tab">
            <?=form_open('kalender/save', array('id' => 'frm-kegiatan', 'class' => 'form-horizontal'));?>
            <input type="hidden" id="kegiatan_id" name="kegiatan_id" />
            <input type="hidden" id="jenis_kegiatan_id" name="jenis_kegiatan_id" value="<?=$jenis_kegiatan_id;?>" />

            <div class="alert bg-danger" id="error_info" style="display: none;"></div>

            <div class="form-group">
                <label class="control-label col-sm-2">Kegiatan <span class="text-danger">*</span></label>
                <div class="col-sm-3">
                    <input type="text" disabled class="form-control" placeholder="Mark" value="<?php if(isset($mark)) echo $mark; ?>">
                </div>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="kegiatan" name="kegiatan" placeholder="Nama Kegiatan..." value="<?=isset($kegiatan['kegiatan'])?$kegiatan['kegiatan']:set_value('kegiatan');?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Tipe Kegiatan <span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <select name="tipe_kegiatan_id" id="tipe_kegiatan_id" class="form-control" required>
                                <option value="">-- Pilih Tipe Kegiatan --</option>
                                <?php foreach($l_tipe_kegiatan as $t): ?>
                                    <option value="<?=$t['tipe_kegiatan_id'];?>"><?=$t['tipe_kegiatan'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Publik</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input type="radio" name="is_private" value="0" checked> Ya
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="is_private" value="1"> Tidak
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Lokasi <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi Kegiatan" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">MAK <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select class="select" style="width: 100%;" data-placeholder="MAK..." name="mak" id="mak_select" required>
                                <option></option>
                                <?php foreach($l_mak as $m): ?>
                                    <?php if(isset($kegiatan['mak']) && $kegiatan['mak'] == $m['mak']): ?>
                                        <option value="<?=$m['mak'];?>" selected><?=$m['mak'];?></option>
                                    <?php else : ?>
                                        <option value="<?=$m['mak'];?>" <?=set_select('mak', $m['mak'])?>><?=$m['mak'];?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Deskripsi MAK <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <textarea name="desc_mak" id="desc_mak" style="margin: 0px -1px 0px 0px; height: 85px;" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Tanggal Mulai <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                <input type="text" id="tanggal_mulai" name="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Tanggal Akhir <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                <input type="text" id="tanggal_akhir" name="tanggal_akhir" class="form-control" placeholder="Tanggal Akhir" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Waktu Mulai <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-alarm"></i></span>
                                <input type="text" id="waktu_mulai" name="waktu_mulai" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Waktu Akhir <span class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-alarm"></i></span>
                                <input type="text" id="waktu_akhir" name="waktu_akhir" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Keterangan <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <textarea name="keterangan" id="keterangan" style="margin: 0px -1px 0px 0px; height: 83px;" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">PIC <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="hidden" id="pic" name="pic"/>
                    <select class="select" style="width: 100%;" data-placeholder="-- Pilih PIC --" name="pic_kegiatan[]" id="pic_kegiatan" multiple="multiple" required>
                        <option value=""></option>
                        <?php foreach($l_pegawai as $p):?>
                            <?php if($filled_pic):?>
                                <option value="<?=$p['pegawai_id'];?>"
                                    <?php foreach($filled_pic as $fp):
                                        if($fp['pegawai_id'] == $p['pegawai_id']): ?>
                                            selected
                                        <?php endif; endforeach;?>
                                >
                                    <?=$p['nm_pegawai'];?></option>
                            <?php else:?>
                                <option value="<?=$p['pegawai_id'];?>" <?=set_select('pegawai_id', $p['pegawai_id'])?>><?=$p['nm_pegawai'];?></option>
                            <?php endif;?>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2 non-perjadin">Subsektor <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <select class="select" style="width: 100%;" data-placeholder="-- Pilih Subsektor --" name="subsektor[]" id="subsektor" multiple="multiple" required>
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

            <?=form_close();?>
        </div>

        <div class="tab-pane" id="lampiran-tab">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Upload Lampiran</h5>
                </div>
                <div class="panel-body">
                    <form enctype="multipart/form-data">
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

        <div class="tab-pane" id="peserta-tab">
            <div class="panel panel-flat" >
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="table-responsive" id="list-peserta"></div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="internal-tab">
            <div class="panel panel-flat" id="list-internal">
            </div>
        </div>
        <div class="tab-pane" id="eksternal-tab">
            <div class="panel panel-flat" id="list-eksternal">

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $('.select').select2({
            minimumResultsForSearch: Infinity
        });
        var tanggal_mulai = $('#tanggal_mulai').pickadate({format: 'dd/mm/yyyy'});
        var tanggal_akhir = $('#tanggal_akhir').pickadate({format: 'dd/mm/yyyy'});
        var waktu_mulai = $('#waktu_mulai').pickatime({format: 'H:i A', formatSubmit: 'HH:i', min: [7,0], max:[6,30]});
        var waktu_akhir = $('#waktu_akhir').pickatime({format: 'H:i A', formatSubmit: 'HH:i', min: [7,0], max:[6,30]});

        tanggal_mulai.pickadate('picker').set('select', '<?=$start;?>', { format: 'dd-mm-yyyy' });
        tanggal_akhir.pickadate('picker').set('select', '<?=$end;?>', { format: 'dd-mm-yyyy' });

        $('[data-dismiss=modal]').on('click', function (e) {
            $('.fullcalendar-external').fullCalendar('removeEvents');
        });

        $('table.list-lampiran').footable();

        $('.select').select2({width: 'resolve'});

        function getListLampiran(id){
            $.ajax({
                type: "POST",
                url: "<?=base_url('kalender/get_list_lampiran');?>",
                data: {id: id},
                success: function(res){
                    $('#list-lampiran').html(res).fadeIn('slow');
                }
            });
        }

        function getListUndangan(id){
            $.ajax({
                type: "POST",
                url: "<?=base_url('kalender/get_list_peserta');?>",
                data: {id: id},
                success: function(res){
                    $('#list-peserta').html(res).fadeIn('slow');
                }
            });
        }

        function getListInternal(id){
            $.ajax({
                type: "POST",
                url: "<?=base_url('kegiatan/get_list_internal');?>",
                data: {id: id},
                success: function(res){
                    $('#list-internal').html(res).fadeIn('slow');
                }
            });
        }
        function getListEksternal(id){
            $.ajax({
                type: "POST",
                url: "<?=base_url('kegiatan/get_list_eksternal');?>",
                data: {id: id},
                success: function(res){
                    $('#list-eksternal').html(res).fadeIn('slow');
                }
            });
        }

        $('.file-styled').uniform({
            fileButtonClass: 'action btn bg-primary'
        });


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

        $('#tab-kegiatan a').on('shown.bs.tab', function (e) {
            var active = $.trim($('#tab-kegiatan .active').text());
            if(active === 'Kegiatan'){
                $('#simpan-kegiatan').show();
            } else {
                $('#simpan-kegiatan').hide();
            }
        });

        $('#eksternal-tab').delegate('button#btn-add-peserta', 'click', function(e){
            e.preventDefault();
            $('#mdl_kegiatan').modal('hide');
            var title = ($('#jenis_kegiatan_id').val() == '3')?'Perjadin':'FGD / Rapat / Seminar';
            $('#modal_title_undangan').html('Tambah Peserta Kegiatan ' + title);

            $.ajax({
                type: "POST",
                url: baseUrl + 'kegiatan/form_peserta_add_eksternal',
                data: {id: $('#kegiatan_id').val(),jenis_kegiatan_id:$('#jenis_kegiatan_id').val()},
                success: function (result) {
                    $('#modal_content_undangan').html(result);

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

        //NBS TAMBAHAN DINAMIS MAK UPSERT FROM TABEL
        $("#mak_select").select2({
            tags: true,
            createTag: function (params) {
                return {
                    id: params.term,
                    text: params.term,
                    newOption: true
                }
            },
            templateResult: function (data) {
                var $result = $("<span></span>");

                $result.text(data.text);

                if (data.newOption) {
                    $result.append(" <em>(CREATE BARU)</em>");
                }

                return $result;
            }
        });

        $("#mak_select").on("select2:select", function (e) {
            console.log('MAK',e.params.data.id);
            var mak = e.params.data.id;
            $.ajax({
                type: "GET",
                url: "<?=base_url('kegiatan/get_deskripsi_mak');?>/"+mak,
                success: function (result) {
                    $('#desc_mak').val(result);
                },
                error: function(er){
                    new PNotify({
                        title: 'Error',
                        text: 'Terjadi kesalahan gagal load form deskripsi MAK!',
                        icon: 'icon-blocked',
                        type: 'error',
                        addclass: 'bg-danger'
                    });
                }
            });
        });

    });
</script>