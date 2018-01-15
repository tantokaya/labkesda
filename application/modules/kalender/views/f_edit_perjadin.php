<div class="tabbable">
    <ul class="nav nav-tabs nav-tabs-highlight nav-bordered tab-menu" id="tab-kegiatan">
        <li class="active"><a href="#kegiatan-tab" data-toggle="tab" aria-expanded="true"><i class="icon-calendar52 position-left"></i> Kegiatan</a></li>
        <li><a href="#lampiran-tab" data-toggle="tab" aria-expanded="false"><i class="icon-cloud-upload2 position-left"></i> Lampiran</a></li>
        <li><a href="#peserta-tab" data-toggle="tab" aria-expanded="false"><i class="icon-users2"></i> Daftar Peserta Kegiatan</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="kegiatan-tab">
            <?=form_open('kalender/save', array('id' => 'frm-kegiatan', 'class' => 'form-horizontal'));?>
            <input type="hidden" id="kegiatan_id" name="kegiatan_id" value="<?=$kegiatan['kegiatan_id'];?>" />
            <input type="hidden" id="jenis_kegiatan_id" name="jenis_kegiatan_id" value="<?=$kegiatan['jenis_kegiatan_id'];?>"/>

            <div class="alert bg-danger" id="error_info" style="display: none;"></div>

            <div class="form-group">
                <label class="control-label col-sm-2">Kegiatan <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kegiatan" name="kegiatan" placeholder="Nama Kegiatan" value="<?=$kegiatan['kegiatan'];?>" required />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Tipe Kegiatan <span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <select name="tipe_kegiatan_id" id="tipe_kegiatan_id" class="form-control" required>
                                <option value="">-- Pilih Tipe Kegiatan --</option>
                                <?php foreach($l_tipe_kegiatan as $t): if($t['tipe_kegiatan_id'] == $kegiatan['tipe_kegiatan_id']): ?>
                                    <option value="<?=$t['tipe_kegiatan_id'];?>" selected><?=$t['tipe_kegiatan'];?></option>
                                <?php else: ?>
                                    <option value="<?=$t['tipe_kegiatan_id'];?>"><?=$t['tipe_kegiatan'];?></option>
                                <?php endif; endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Public</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input type="radio" name="is_private" value="0" <?=($kegiatan['is_private'] == '0')?'checked':'';?>> Ya
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="is_private" value="1" <?=($kegiatan['is_private'] == '1')?'checked':'';?>> Tidak
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Propinsi Tujuan <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="propinsi_id" id="propinsi_id" required>
                                <option value="">-- Pilih Propinsi Tujuan --</option>
                                    <?php foreach($l_propinsi as $t): if($t['propinsi_id'] == substr($kegiatan['kota_tujuan'],0,2)): ?>
                                        <option value="<?=$t['propinsi_id'];?>" selected><?=$t['propinsi'];?></option>
                                    <?php else : ?>
                                        <option value="<?=$t['propinsi_id'];?>"><?=$t['propinsi'];?></option>
                                    <?php endif; endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Kota Tujuan <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="kota_id" id="kota_id" required>
                                <option value="">-- Pilih Kota/Kab Tujuan --</option>
                                <?php foreach($l_kota as $t): if($t['kota_id'] == $kegiatan['kota_tujuan']): ?>
                                    <option value="<?=$t['kota_id'];?>" selected><?=$t['kota'];?></option>
                                <?php else : ?>
                                    <option value="<?=$t['kota_id'];?>"><?=$t['kota'];?></option>
                                <?php endif; endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">MAK <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mak" name="mak" placeholder="MAK..." value="<?=$kegiatan['mak'];?>" required />
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
                        <label class="control-label col-sm-4">Keterangan <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <textarea name="keterangan" id="keterangan" style="margin: 0px -3px 0px 0px; height: 146px;" class="form-control" required><?=$kegiatan['keterangan'];?></textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Deskripsi MAK <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <textarea name="desc_mak" id="desc_mak" class="form-control" required><?=$kegiatan['deskripsi_mak'];?></textarea>
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
                    <div class="table-responsive" id="list-lampiran">

                    </div>
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
<?php
$mulai = strtotime($kegiatan['tanggal_mulai']);
$akhir = strtotime($kegiatan['tanggal_akhir']);
?>

<script type="text/javascript">
    $(function(){
        getListLampiran('<?=$kegiatan['kegiatan_id'];?>');
        getListUndangan('<?=$kegiatan['kegiatan_id'];?>');

        var tanggal_mulai = $('#tanggal_mulai').pickadate({format: 'dd/mm/yyyy'});
        var tanggal_akhir = $('#tanggal_akhir').pickadate({format: 'dd/mm/yyyy'});

        tanggal_mulai.pickadate('picker').set('select', '<?=date('d/m/Y', $mulai);?>', {format: 'dd/mm/yyyy'});
        tanggal_akhir.pickadate('picker').set('select', '<?=date('d/m/Y', $akhir);?>', {format: 'dd/mm/yyyy'});

        $('#propinsi_id').on('change', function(){
            var prop_id = $(this).val();
            $('#kota_id').html('');

            getListKota(prop_id);
        });

        function getListKota(prop_id, kota_id){
            $.ajax({
                type: 'POST',
                url: '<?=base_url('kalender/get_list_kota'); ?>',
                data: 'propinsi_id='+prop_id+'&kota_id='+kota_id,
                success: function(res){
                    $('#kota_id').html(res);
                },
                error: function(e){
                    alert('Error: '+e);
                }
            });
        }

        $('table.list-lampiran').footable();

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

        $('.file-styled').uniform({
            fileButtonClass: 'action btn bg-primary'
        });


        $('#lampiran').fileinput({
            uploadUrl: "<?=base_url('kalender/upload_lampiran');?>", // server upload action
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

        $('#tab-kegiatan a').on('shown.bs.tab', function (e) {
            var active = $.trim($('#tab-kegiatan .active').text());
            if(active === 'Kegiatan'){
                $('#simpan-kegiatan').show();
            } else {
                $('#simpan-kegiatan').hide();
            }
        });

        $('#peserta-tab').delegate('button#btn-add-peserta', 'click', function(e){
            e.preventDefault();
            $('#mdl_kegiatan').modal('hide');
            var title = ($('#jenis_kegiatan_id').val() == '3')?'Perjadin':'FGD / Rapat / Seminar';
            $('#modal_title_undangan').html('Tambah Peserta Kegiatan ' + title);

            $.ajax({
                type: "POST",
                url: baseUrl + 'kalender/form_peserta_add',
                data: {id: $('#kegiatan_id').val(),jenis_kegiatan_id:$('#jenis_kegiatan_id').val()},
                success: function (result) {
                    $('#modal_content_undangan').html(result);
                    var tanggal_mulai2 = $('#tanggal_mulai2').pickadate({format: 'dd/mm/yyyy'});
                    var tanggal_akhir2 = $('#tanggal_akhir2').pickadate({format: 'dd/mm/yyyy'});

                    tanggal_mulai2.pickadate('picker').set('select', tanggal_mulai.val(), {format: 'dd/mm/yyyy'});
                    tanggal_akhir2.pickadate('picker').set('select', tanggal_akhir.val(), {format: 'dd/mm/yyyy'});

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

    });
</script>