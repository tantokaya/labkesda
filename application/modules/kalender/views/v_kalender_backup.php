<style type="text/css">
    .fc-day-grid-event > .fc-content {
        white-space: nowrap;
        overflow: hidden;
    }
</style>

<script src="<?=base_url('assets/js/sweetalert.js');?>"></script>
<script src="<?=base_url('assets/js/forms/jquery.validate.js');?>"></script>
<script src="<?=base_url('assets/js/full.min.js');?>"></script>
<script src="<?=base_url('assets/js/interactions.min.js');?>"></script>
<script src="<?=base_url('assets/js/fullcalendar-3.1.0/lib/moment.min.js');?>"></script>
<script src="<?=base_url('assets/js/fullcalendar-3.1.0/fullcalendar.min.js');?>"></script>
<script src="<?=base_url('assets/js/fullcalendar-3.1.0/locale/id.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/legacy.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/daterangepicker.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/picker.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/picker.date.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/picker.time.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/id_ID.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/fileinput.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/tokenfield.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/tables/footable.min.js');?>"></script>



<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-calendar52 position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Kegiatan</li>
            <li class="active"><?=$page_title;?></li>
        </ul>
    </div>
</div>

<div class="container-fluid page-content">
    <div class="panel panel-default panel-bordered">
        <div class="panel-heading">
            <h5 class="panel-title"><i class="icon-three-bars position-left"></i> <?=$panel_title;?></h5>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-2 col-sm-3">
                    <div id="external-events">
                        <h6>Jenis Kegiatan</h6>
                        <div class="fc-events-container">
                            <?php foreach($l_jenis_kegiatan as $t): ?>
                                <div class="fc-event" data-color="<?=$t['warna_jenis_kegiatan'];?>" data-jenis-kegiatan-id="<?=$t['jenis_kegiatan_id'];?>"><?=$t['jenis_kegiatan'];?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-10 col-sm-9">
                    <div class="fullcalendar-external"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="add_kegiatan" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal_title" class="modal-title"></h4>
            </div>
            <div class="modal-body">
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
                                <input type="hidden" id="jenis_kegiatan_id" name="jenis_kegiatan_id" />
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

                                <div class="form-group non-perjadin">
                                    <label class="control-label col-sm-3">Waktu Mulai <span class="text-danger">*</span></label>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-alarm"></i></span>
                                            <input type="text" id="waktu_mulai" name="waktu_mulai" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group non-perjadin">
                                    <label class="control-label col-sm-3">Waktu Akhir <span class="text-danger">*</span></label>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-alarm"></i></span>
                                            <input type="text" id="waktu_akhir" name="waktu_akhir" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group perjadin">
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

                                <div class="form-group perjadin">
                                    <label class="control-label col-sm-3">Kota/Kab. Tujuan <span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="kota_id" id="kota_id" required>
                                            <option value="">-- Pilih Kota/Kab Tujuan --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group non-perjadin">
                                    <label class="control-label col-sm-3">Lokasi <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi Kegiatan" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3">Keterangan <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group non-perjadin">
                                    <label class="control-label col-sm-3">PIC <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control tokenfield-primary" id="pic" name="pic" required />
                                        <span>Input diakhiri dengan tanda <code>koma (,)</code> atau tombol <code>TAB</code></span>
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
            </div>
            <div class="modal-footer no-padding-top">
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
                <!--<button type="button" class="btn bg-blue btn-sm btn-labeled"><b><i class="icon-floppy-disk"></i></b>Simpan</button>-->
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    'use_strict';
    $(function() {
        var tanggal_mulai = $('#tanggal_mulai').pickadate({format: 'dd/mm/yyyy'});
        var tanggal_akhir = $('#tanggal_akhir').pickadate({format: 'dd/mm/yyyy'});
        var waktu_mulai = $('#waktu_mulai').pickatime({format: 'H:i A', formatSubmit: 'HH:i'});
        var waktu_akhir = $('#waktu_akhir').pickatime({format: 'H:i A', formatSubmit: 'HH:i'});

        $('.fullcalendar-external').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            eventLimit: true,
            editable: true,
            eventSources:[
                {
                    // my event
                    url: '<?=base_url('kalender/fetch');?>',
                    type: 'POST',
                    data: {
                        owner: '<?=$this->session->user_id;?>'
                    },
                    error: function() {
                        alert('Terjadi kesalahan dalam memuat data kegiatan di kalender!');
                    }
                },{
                    // other event public
                    url: '<?=base_url('kalender/fetch');?>',
                    type: 'POST',
                    data: {
                        owner: '<?=$this->session->user_id;?>',
                        public: true

                    },
                    error: function() {
                        alert('Terjadi kesalahan dalam memuat data kegiatan di kalender!');
                    },
                    editable: false
                }
            ],
            lang: 'id',
            droppable: true,
            eventReceive: function(event){
                var start = moment(event.start).format('DD/MM/YYYY');
                var end = (event.end == null)?start:moment(event.end).format('DD/MM/YYYY');

                $('#modal_title').html('Tambah Kegiatan ' + event.title);
                $('#jenis_kegiatan_id').val(event.jenis_kegiatan_id);
                tanggal_mulai.pickadate('picker').set('select', start, { format: 'dd-mm-yyyy' });
                tanggal_akhir.pickadate('picker').set('select', end, { format: 'dd-mm-yyyy' });

                if(event.jenis_kegiatan_id == '3') {
                    $('.perjadin').show();
                    $('.non-perjadin').hide();

                    $('#pic').removeAttr('required', 'required');
                    $('#waktu_mulai').removeAttr('required', 'required');
                    $('#waktu_akhir').removeAttr('required', 'required');
                    $('#lokasi').removeAttr('required', 'required');

                    $('#propinsi_id').attr('required', true);
                    $('#kota_id').attr('required', true);
                } else {
                    $('.perjadin').hide();
                    $('.non-perjadin').show();

                    $('#pic').attr('required', true);
                    $('#waktu_mulai').attr('required', true);
                    $('#waktu_akhir').attr('required', true);
                    $('#lokasi').attr('required', true)

                    $('#propinsi_id').removeAttr('required', 'required');
                    $('#kota_id').removeAttr('required', 'required');
                }

                $('#add_kegiatan').modal('show');
            },
            eventDrop: function(event, delta, revertFunc) {
                var start = moment(event.start).format('DD/MM/YYYY');
                var end = (event.end == null)?start:moment(event.end).format('DD/MM/YYYY');

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: {id: event.id, start: start, end: end},
                    url: "<?=base_url('kalender/update_tanggal_kegiatan');?>",
                    success: function(r){
                        if(r.error == true){
                            revertFunc();
                        }
                    },
                    error: function(e){
                        revertFunc();
                        alert('Terjadi kesalahan gagal memperbaharui tanggal kegiatan');
                    }
                });
            },
            eventClick: function(event, jsEvent, view) {
               console.log(event.id);
            },
            eventResize: function(event, delta, revertFunc) {
                var start   = moment(event.start).format('DD/MM/YYYY');
                var end     = moment(event.end).format('DD/MM/YYYY');

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: {id: event.id, start: start, end: end},
                    url: "<?=base_url('kalender/update_tanggal_kegiatan');?>",
                    success: function(r){
                        if(r.error == true){
                            revertFunc();
                        }
                    },
                    error: function(e){
                        revertFunc();
                        alert('Terjadi kesalahan gagal memperbaharui tanggal kegiatan');
                    }
                });
            }
        });
        $('#external-events .fc-event').each(function() {
            $(this).css({'backgroundColor': $(this).data('color'), 'borderColor': $(this).data('color')});
            $(this).data('event', {
                title: $.trim($(this).html()),
                color: $(this).data('color'),
                jenis_kegiatan_id: $(this).data('jenis-kegiatan-id'),
                stick: true
            });

            $(this).draggable({
                zIndex: 999,
                revert: true,
                revertDuration: 0
            });
        });

        function refreshCalendar(){
            $('.fullcalendar-external').fullCalendar('removeEvents');
            $('.fullcalendar-external').fullCalendar('refetchEvents');
        }

        $('.file-styled').uniform({
            fileButtonClass: 'action btn bg-primary'
        });

        var form_kegiatan = $('#frm-kegiatan');

        var validator = form_kegiatan.validate({
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

        $('[data-dismiss=modal]').on('click', function (e) {
            var $t = $(this),
                target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

            $(target)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();

            $(target).find("#kota_id").html('<option value="">-- Pilih Kota/Kabupaten --</option>');
            $('#pic').tokenfield('setTokens','');
            $('#list-lampiran').html('');
            validator.resetForm();

            $('ul.tab-menu li:eq(1)').addClass('disabled').find('a').removeAttr('data-toggle', true);
            $('ul.tab-menu li:eq(2)').addClass('disabled').find('a').removeAttr('data-toggle', true);
            $('.tab-menu a[href="#kegiatan-tab"]').tab('show');

            refreshCalendar();
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
                url: "<?=base_url('kalender/get_list_lampiran');?>",
                data: {id: id},
                success: function(res){
                    $('#list-lampiran').html(res).fadeIn('slow');
                }
            });
        }

    });
</script>


