<style type="text/css">
    .fc-day-grid-event > .fc-content {
        white-space: nowrap;
        overflow: hidden;
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
                    <br/>
                    <div id="trash">
                        <h6>Hapus Kegiatan</h6>
                        <div class="fc-events-container" id="trash">
                            <div class="alert bg-danger">
                                <span class="text-semibold"><i class="icon-close2 position-left"></i>Drag Disini</span>
                            </div>
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

<div id="mdl_kegiatan" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal_title" class="modal-title"></h4>
            </div>
            <div class="modal-body" id="modal_content"></div>
            <div class="modal-footer no-padding-top">
                <button type="button" id="simpan-kegiatan" class="btn bg-blue btn-sm btn-labeled"><b><i class="icon-floppy-disk"></i></b>Simpan</button>
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?=base_url('assets/js/sweetalert.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/full.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/interactions.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/fullcalendar-3.1.0/lib/moment.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/fullcalendar-3.1.0/fullcalendar.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/fullcalendar-3.1.0/locale/id.js');?>"></script>
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
    'use_strict';
    $(function() {
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
                        new PNotify({
                            title: 'Error',
                            text: 'Terjadi kesalahan dalam memuat data kegiatan di kalender!',
                            icon: 'icon-blocked',
                            type: 'error',
                            addclass: 'bg-danger'
                        });
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
                        new PNotify({
                            title: 'Error',
                            text: 'Terjadi kesalahan dalam memuat data kegiatan di kalender!',
                            icon: 'icon-blocked',
                            type: 'error',
                            addclass: 'bg-danger'
                        });
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

                $.ajax({
                    type: "POST",
                    data: {id: event.jenis_kegiatan_id, start: start, end: end},
                    url: "<?=base_url('kalender/form_kegiatan_add');?>",
                    success: function(data){
                        $('#modal_content').html(data);
                    },
                    error: function(e){
                        new PNotify({
                            title: 'Error',
                            text: 'Terjadi kesalahan gagal load form tambah kegiatan!',
                            icon: 'icon-blocked',
                            type: 'error',
                            addclass: 'bg-danger'
                        });
                    }
                });

                $('#mdl_kegiatan').modal('show');
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
                            new PNotify({
                                title: 'Error',
                                text: 'Terjadi kesalahan gagal memperbaharui tanggal kegiatan!',
                                icon: 'icon-blocked',
                                type: 'error',
                                addclass: 'bg-danger'
                            });
                        } else {
                            new PNotify({
                                title: 'Sukses',
                                text: 'Tanggal kegiatan berhasil diperbaharui!',
                                icon: 'icon-checkmark3',
                                type: 'success',
                                addclass: 'bg-success'
                            });
                        }
                    },
                    error: function(e){
                        revertFunc();
                        new PNotify({
                            title: 'Error',
                            text: 'Terjadi kesalahan gagal memperbaharui tanggal kegiatan!',
                            icon: 'icon-blocked',
                            type: 'error',
                            addclass: 'bg-danger'
                        });
                    }
                });
            },
            eventClick: function(event, jsEvent, view) {

                $('#modal_title').html(event.title.toUpperCase());
                $('#jenis_kegiatan_id').val(event.jenis_kegiatan_id);

                $.ajax({
                    type: "POST",
                    data: {id: event.id},
                    url: "<?=base_url('kalender/form_kegiatan_edit');?>",
                    success: function(data){
                        $('#modal_content').html(data);
                    },
                    error: function(e){
                        new PNotify({
                            title: 'Error',
                            text: 'Terjadi kesalahan gagal load form ubah kegiatan!',
                            icon: 'icon-blocked',
                            type: 'error',
                            addclass: 'bg-danger'
                        });
                    }
                });

                $('#mdl_kegiatan').modal('show');

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
                            new PNotify({
                                title: 'Error',
                                text: 'Terjadi kesalahan gagal memperbaharui tanggal kegiatan!',
                                icon: 'icon-blocked',
                                type: 'error',
                                addclass: 'bg-danger'
                            });
                        } else {
                            new PNotify({
                                title: 'Sukses',
                                text: 'Tanggal kegiatan berhasil diperbaharui!',
                                icon: 'icon-checkmark3',
                                type: 'success',
                                addclass: 'bg-success'
                            });
                        }
                    },
                    error: function(e){
                        revertFunc();
                        new PNotify({
                            title: 'Error',
                            text: 'Terjadi kesalahan gagal memperbaharui tanggal kegiatan!',
                            icon: 'icon-blocked',
                            type: 'error',
                            addclass: 'bg-danger'
                        });
                    }
                });
            },
            eventDragStop: function (event, jsEvent, ui, view) {
                if (thrash()) {
                    swal({
                        title: "Konfirmasi Hapus Data",
                        text: "Apakah anda yakin ingin menghapus kegiatan ini?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: 'btn-danger',
                        confirmButtonText: 'Hapus',
                        cancelButtonText: "Batal",
                        closeOnConfirm: true,
                        closeOnCancel: false
                    },
                    function(isConfirm){
                        if (isConfirm){
                                $.ajax({
                                    type: 'POST',
                                    dataType: 'json',
                                    url: '<?=base_url("kalender/delete_kegiatan");?>',
                                    data: {id: event.id},
                                    success: function(response){
                                        if(response.error == false){
                                            new PNotify({
                                                title: 'Sukses',
                                                text: 'Data kegiatan berhasil dihapus!',
                                                icon: 'icon-checkmark3',
                                                addclass: 'bg-success'
                                            });
                                            refreshCalendar();
                                        } else {
                                            new PNotify({
                                                title: 'Error',
                                                text: 'Data kegiatan gagal dihapus!',
                                                icon: 'icon-blocked',
                                                addclass: 'bg-danger'
                                            });
                                        }
                                    },
                                    error: function(e){
                                        new PNotify({
                                            title: 'Error',
                                            text: 'Data kegiatan gagal dihapus!',
                                            icon: 'icon-blocked',
                                            type: 'error',
                                            addclass: 'bg-danger'
                                        });
                                    }
                                });
                        } else {
                            swal("Batal", "Hapus data dibatalkan", "error");
                        }
                    });
                }
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

        var currentMousePos = {
            x: -1,
            y: -1
        };

        $(document).on("mousemove", function (event) {
            currentMousePos.x = event.pageX;
            currentMousePos.y = event.pageY;
        });

        function thrash() {
            var trashEl = $('#trash');

            var ofs = trashEl.offset();

            var x1 = ofs.left;
            var x2 = ofs.left + trashEl.outerWidth(true);
            var y1 = ofs.top;
            var y2 = ofs.top + trashEl.outerHeight(true);

            if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
                currentMousePos.y >= y1 && currentMousePos.y <= y2) {
                return true;
            }
            return false;
        }

        function refreshCalendar(){
            $('.fullcalendar-external').fullCalendar('refetchEvents');
        }

        $('[data-dismiss=modal]').on('click', function (e) {
            $('#simpan-kegiatan').show();
            refreshCalendar();
        });

        $('#simpan-kegiatan').on('click', function(ev){
            ev.preventDefault();

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
                    url: "<?=base_url('kalender/save_kegiatan');?>",
                    success: function(r){
                        if(r.error == false){
                            $('#error_info').html('').fadeOut('slow');

                            options.title = "Sukses";
                            options.text  = r.message;
                            options.addclass = "bg-success";
                            options.type = r.type;
                            options.icon = "icon-checkmark3";

                            $('#kegiatan_id').val(r.kegiatan_id);

                            $('ul.tab-menu li:eq(1)').removeClass('disabled', true).find('a').attr('data-toggle', 'tab');
                            $('ul.tab-menu li:eq(2)').removeClass('disabled', true).find('a').attr('data-toggle', 'tab');
                            $('.tab-menu a[href="#lampiran-tab"]').tab('show');
                            $('#simpan-kegiatan').hide();

                            new PNotify(options);
                        } else {
                            var error_info = '<span class="text-semibold">Error!</span>'+ r.message;

                            $('#error_info').html(error_info).fadeIn('slow');
                        }
                    },
                    error: function(e){
                        options.title       = "Error";
                        options.text        = "Data kegiatan gagal disimpan!";
                        options.addclass    = "bg-danger";
                        options.type        = "error";
                        options.icon        = "icon-blocked";

                        new PNotify(options);
                    }
                });

        });

    });
</script>


