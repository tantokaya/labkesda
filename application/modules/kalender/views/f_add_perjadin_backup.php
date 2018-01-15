<div class="tabbable">
    <ul class="nav nav-tabs nav-tabs-highlight nav-bordered tab-menu">
        <li class="active"><a href="#kegiatan-tab" data-toggle="tab" aria-expanded="true"><i class="icon-calendar52 position-left"></i> Kegiatan</a></li>
        <li class="disabled"><a href="#lampiran-tab" aria-expanded="false"><i class="icon-cloud-upload2 position-left"></i> Lampiran</a></li>
        <li class="disabled"><a href="#peserta-tab" aria-expanded="false"><i class="icon-users2"></i> Daftar Peserta Kegiatan</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="kegiatan-tab">
            <?=form_open('kalender/save', array('id' => 'frm-kegiatan', 'class' => 'form-horizontal'));?>
            <input type="hidden" id="kegiatan_id" name="kegiatan_id" />
            <input type="hidden" id="jenis_kegiatan_id" name="jenis_kegiatan_id" value="<?=$jenis_kegiatan_id;?>"/>
            <div class="form-group">
                <label class="control-label col-sm-3">Kegiatan <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="kegiatan" name="kegiatan" placeholder="Nama Kegiatan" required />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Tipe Kegiatan <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <select name="tipe_kegiatan_id" id="tipe_kegiatan_id" class="form-control" required>
                        <option value="">-- Pilih Tipe Kegiatan --</option>
                        <?php foreach($l_tipe_kegiatan as $t): ?>
                            <option value="<?=$t['tipe_kegiatan_id'];?>"><?=$t['tipe_kegiatan'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Publish</label>
                <div class="col-sm-4">
                    <label class="radio-inline">
                        <input type="radio" name="is_private" value="0"> Ya
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="is_private" value="1"> Tidak
                    </label>

                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Tanggal Mulai <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        <input type="text" id="tanggal_mulai" name="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Tanggal Akhir <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        <input type="text" id="tanggal_akhir" name="tanggal_akhir" class="form-control" placeholder="Tanggal Akhir" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3">Propinsi Tujuan <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <select class="form-control" name="propinsi_id" id="propinsi_id" required>
                        <option value="">-- Pilih Propinsi Tujuan --</option>
                        <?php foreach($l_propinsi as $t): ?>
                            <option value="<?=$t['propinsi_id'];?>"><?=$t['propinsi'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3">Kota/Kab. Tujuan <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <select class="form-control" name="kota_id" id="kota_id" required>
                        <option value="">-- Pilih Kota/Kab Tujuan --</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3">Keterangan <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3">MAK <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="mak" name="mak" placeholder="MAK..." required />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Deskripsi MAK <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <textarea name="desc_mak" id="desc_mak" class="form-control" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3"></label>
                <div class="col-sm-9">
                    <button type="button" id="simpan-kegiatan" class="btn bg-blue btn-sm btn-labeled"><b><i class="icon-floppy-disk"></i></b>Simpan</button>
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

<script type="text/javascript">
    $(function(){
        var tanggal_mulai = $('#tanggal_mulai').pickadate({format: 'dd/mm/yyyy'});
        var tanggal_akhir = $('#tanggal_akhir').pickadate({format: 'dd/mm/yyyy'});
        var waktu_mulai = $('#waktu_mulai').pickatime({format: 'H:i A', formatSubmit: 'HH:i'});
        var waktu_akhir = $('#waktu_akhir').pickatime({format: 'H:i A', formatSubmit: 'HH:i'});

        tanggal_mulai.pickadate('picker').set('select', '<?=$start;?>', { format: 'dd-mm-yyyy' });
        tanggal_akhir.pickadate('picker').set('select', '<?=$end;?>', { format: 'dd-mm-yyyy' });

        var form_kegiatan = $('#frm-kegiatan');

        form_kegiatan.validate({
            ignore: 'input[type=hidden], .select2-search__field',
            errorClass: 'validation-error',
            successClass: 'validation-success',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            errorPlacement: function(error, element) {
                if (element.parents('div').hasClass('checker') || element.parents('div').hasClass('choice') || element.parent().hasClass('bootstrap-switch-container') ) {
                    if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo( element.parent().parent().parent().parent() );
                    }
                    else {
                        error.appendTo( element.parent().parent().parent().parent().parent() );
                    }
                }
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo( element.parent() );
                }
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline') || element.parents('div').hasClass('checkbox-single')) {
                    error.appendTo( element.parent().parent() );
                }

                else if (element.parents('div').hasClass('checkbox-group')) {
                    error.appendTo( element.parent().parent().parent() );
                }
                else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                    error.appendTo( element.parent().parent() );
                }
                else {
                    error.insertAfter(element);
                }
            },
            validClass: 'validation-success',
            success: function(label) {
                label.addClass('validation-success').text('OK')
            }
        });

        $('[data-dismiss=modal]').on('click', function (e) {
            $('ul.tab-menu li:eq(1)').addClass('disabled').find('a').removeAttr('data-toggle', true);
            $('ul.tab-menu li:eq(2)').addClass('disabled').find('a').removeAttr('data-toggle', true);
            $('.tab-menu a[href="#kegiatan-tab"]').tab('show');

            refreshCalendar();
        });

        function refreshCalendar(){
            $('.fullcalendar-external').fullCalendar('removeEvents');
            $('.fullcalendar-external').fullCalendar('refetchEvents');
        }

        $('#simpan-kegiatan').on('click', function(ev){
            ev.preventDefault();
            var valid = form_kegiatan.valid();
            if(valid){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: form_kegiatan.serializeArray(),
                    url: "<?=base_url('kalender/save_kegiatan');?>",
                    success: function(r){
                        if(r.error == false){
                            $('#kegiatan_id').val(r.kegiatan_id);

                            getListLampiran(r.kegiatan_id);

                            $('ul.tab-menu li:eq(1)').removeClass('disabled', true).find('a').attr('data-toggle', 'tab');
                            $('ul.tab-menu li:eq(2)').removeClass('disabled', true).find('a').attr('data-toggle', 'tab');
                            $('.tab-menu a[href="#lampiran-tab"]').tab('show');
                        }
                    },
                    error: function(e){
                        alert('Terjadi kesalahan gagal menyimpan data kegiatan');
                    }
                });
            }
        });

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

    });
</script>