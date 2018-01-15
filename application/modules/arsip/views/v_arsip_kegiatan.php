<script type="text/javascript" src="<?=base_url('assets/js/tables/datatables/datatables.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/sweetalert.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/fileinput.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/pnotify.min.js');?>"></script>

<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-folder-open position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li class="active"><?=$page_title;?></li>
        </ul>
    </div>
</div>

<div class="container-fluid page-content">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title">Arsip</h5>
            <div class="elements panel-tabs">
                <ul class="nav nav-tabs nav-sm nav-tabs-bottom">
                    <li><a href="<?=base_url('arsip');?>" data-toggle="tab"><i class="icon-folder-open position-left"></i> Arsip Publik</a></li>
                    <li><a href="<?=base_url('arsip/saya');?>"><i class="icon-folder-remove position-left"></i> Arsip Saya</a></li>
                    <li class="active"><a href="#arsip-kegiatan"><i class="icon-folder position-left"></i> Arsip Kegiatan</a></li>
                </ul>
            </div>
        </div>

        <div class="panel-tab-content tab-content">
            <div class="tab-pane active has-padding" id="arsip-publik">
<!--                <button type="button" id="btn-add" class="btn btn-sm btn-info">Tambah <i class="icon icon-plus2"></i></button>&nbsp;-->
                <button type="button" id="btn-root" data-returntype="0" data-level="0" data-parent="" class="btn btn-sm btn-info">/</button>&nbsp;
                <button type="button" id="btn-home" data-returntype="0" data-level="<?=$level;?>"  data-parent="<?=$parent;?>" data-path="<?=$path;?>" class="btn btn-sm btn-info"><i class="icon-home2"></i></button>&nbsp;
                <button type="button" id="btn-up" class="btn btn-sm btn-info"><i class="icon-folder-upload"></i></button>&nbsp;
                <input type="hidden" name="level" id="level" value="<?=$level;?>" />
                <input type="hidden" name="parent" id="parent" value="<?=$parent;?>" />
                <input type="hidden" name="returntype" id="returntype" value="" />
                <input type="hidden" name="unit_kerja_id" id="unit_kerja_id" value="" />
                <input type="hidden" name="kode" id="kode" value="" />
                <input type="hidden" name="path" id="path" value="<?=$path;?>" />

                <?php echo $this->table->generate(); ?>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    'use Strict';
    var oTable, basePath = '<?=$path;?>', baseUrl = '<?=base_url();?>', fspath = '<?=FSPATH.'lampiran_kegiatan/';?>', user_id = '<?=$this->session->user_id;?>', level = '<?=$level;?>';

    <?php if($this->session->flashdata('notif')): ?>
    swal("<?=$this->session->flashdata('notif');?>", "", "<?=$this->session->flashdata('type');?>");
    <?php endif; ?>
</script>
<script type="text/javascript">
    /**
     * Created by gudhel on 1/28/17.
     */
    function checkPath(path){
        var pathLength = parseInt($.trim(basePath.length)),
            destLength = parseInt($.trim(path.length));

        if(destLength >= pathLength && path.substr(0,pathLength) == basePath)
            $('#btn-add').show();
        else
            $('#btn-add').hide();
    }
    $(document).ready(function() {
        oTable = $('#tbl-arsip').dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": baseUrl + "arsip/dt_arsip_kegiatan",
            "order": [[0,'asc']],
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "bSort": true,
            "dom": '<"datatable-header"fl><"datatable-scroll-lg"t><"datatable-footer"ip>',
            "language": {
                "search": '<span>Pencarian:</span> _INPUT_',
                "lengthMenu": '<span>Show:</span> _MENU_',
                "paginate": { 'first': 'Pertama', 'last': 'Terakhir', 'next': '&rarr;', 'previous': '&larr;' }
            },
            "lengthMenu": [ 10, 25, 50, 75, 100 ],
            "fnInitComplete": function() {
            },
            "columns": [
                {"data": 'kode', "sName": 'kode', "bVisible": false, "bSearchable": false},
                {
                    "data":"arsip",
                    "sName":"arsip",
                    "width": "35%",
                    "render": function ( data, type, row ) {
                        var result;

                        if(type == 'display'){
                            if(row.returntype == '3'){
                                result = '<a href="javascript:void(0)" class="file text-info" onclick="window.open(\''+fspath+row.unit_kerja_id+'/'+row.deskripsi+'\',\'_blank\');"><i class="icon icon-file-empty"></i>&nbsp;&nbsp;&nbsp;'+data+'</a>';
                            } else {
                                result = '<a href="javascript:void(0)" ' +
                                    'class="folder text-info" ' +
                                    'data-returntype="'+row.returntype+'" ' +
                                    'data-kode="'+row.kode+'" ' +
                                    'data-unit_kerja_id="'+row.unit_kerja_id+'" ' +
                                    'data-parent="'+row.kode+'" ' +
                                    'data-level="'+(parseInt(row.level)+1)+'" ' +
                                    '>' +
                                    '<i class="icon icon-folder-open"></i>&nbsp;&nbsp;&nbsp;'+data+'</a>';
                            }
                        } else {
                            result = data;
                        }

                        return result;
                    }
                },
                {"data":"deskripsi", "sName":"deskripsi", "width": "20%"},
                {"data":"created", "sName":"created", "width": "15%"},
                {"data":"modified", "sName":"modified", "width": "15%"}
            ],
            "aoColumnDefs": [
                {
                    'bSortable': false,
                    'bSearchable':false,
                    'aTargets': [ -1 ]
                }
            ],
            "fnServerData": function(sSource, aoData, fnCallback) {
                aoData.push({"name": "level", "value": $('#level').val()});
                aoData.push({"name": "parent", "value": $('#parent').val()});
                aoData.push({"name": "returntype", "value": $('#returntype').val()});
                aoData.push({"name": "kode", "value": $('#kode').val()});
                aoData.push({"name": "unit_kerja_id", "value": $('#unit_kerja_id').val()});
                $.ajax
                ({
                    'dataType': 'json',
                    'type'    : 'POST',
                    'url'     : sSource,
                    'data'    : aoData,
                    'success' : fnCallback
                });
            }
        });

        $('.dataTables_filter input[type=search]').attr('placeholder','Pencarian...');

        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            width: '60px'
        });

        $('#tbl-arsip').delegate('a.folder', 'click', function(e){
            e.preventDefault();
            var that = $(this), path = $('#path').val();

            $('#level').val(that.data('level'));
            $('#parent').val(that.data('parent'));
            $('#returntype').val(that.data('returntype'));
            $('#unit_kerja_id').val(that.data('unit_kerja_id'));
            $('#kode').val(that.data('kode'));
            $('#path').val(path+','+that.data('parent'));

            checkPath($('#path').val());

            if(that.data('level') == '0'){
                $('#btn-up').hide();
            } else {
                $('#btn-up').show();
            }

            oTable._fnAjaxUpdate();
        }).delegate('a.rename-arsip', 'click', function(e){
            var that = $(this);
            e.preventDefault();

            $('#rename_id').val(that.data('id'));
            $('#rename').val(that.data('nama'));

            $('#mdl_rename').modal('show');

        }).delegate('a.detail-arsip', 'click', function(e){
            var that = $(this);
            e.preventDefault();

            $.ajax({
                type: "POST",
                data: {id: that.data('id')},
                url: baseUrl + "arsip/detail",
                success: function(r){
                    $('#mdl_detail').find('.modal-body').html(r);
                    $('#mdl_detail').modal('show');
                }
            });

        }).delegate('a.hapus-arsip', 'click', function(e){
            var that = $(this);
            e.preventDefault();

            swal({
                    title: "Konfirmasi Hapus Data",
                    text: "Apakah anda yakin ingin menghapus data ini?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm){
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: baseUrl + "arsip/delete",
                            data: {id: that.data('id'), jenis: that.data('jenis-arsip'), level: $('#level').val()},
                            success: function(r){
                                oTable._fnAjaxUpdate();
                                swal(r.message, "", r.type);
                            }
                        });
                    } else {
                        swal("Batal", "Hapus data dibatalkan", "error");
                    }
                }
            );
        }).delegate('a.change-arsip', 'click', function(e){
            var that = $(this);
            e.preventDefault();

            swal({
                    title: "Konfirmasi Ubah Data",
                    text: "Apakah anda yakin ingin mengubah arsip ini menjadi arsip saya?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Ubah",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm){
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: baseUrl + "arsip/change",
                            data: {id: that.data('id'), publik: that.data('publik')},
                            success: function(r){
                                oTable._fnAjaxUpdate();
                                swal(r.message, "", r.type);
                            }
                        });
                    } else {
                        swal("Batal", "Ubah data dibatalkan", "error");
                    }
                }
            );
        });



        $('#btn-add').on('click', function(e) {
            $('#mdl_add').modal('show');
        });

        $('#btn-root').on('click', function(e) {
            var that = $(this).data();
            $('#level').val('0');
            $('#returntype').val('0');
            $('#parent').val('');
            $('#path').val('');

            checkPath($('#path').val());

            if($('#level').val() == '0'){
                $('#btn-up').hide();
            } else {
                $('#btn-up').show();
            }

            oTable._fnAjaxUpdate();
        });

        $('#btn-home').on('click', function(e) {
            e.preventDefault();
            var that = $(this).data();
            $('#level').val(that.level);
            $('#parent').val(that.parent);
            $('#path').val(that.path);

            checkPath($('#path').val());

            if($('#level').val() == '0'){
                $('#btn-up').hide();
            } else {
                $('#btn-up').show();
            }

            oTable._fnAjaxUpdate();
        });

        $('#mdl_add').on('show.bs.modal', function(e){
            $('#curr_level').val($('#level').val());
            $('#curr_parent').val($('#parent').val());
        });

        $('#mdl_add').on('hidden.bs.modal', function(e){
            clearForm();
        });

        $('#tbl-arsip').delegate('a.btn-delete', 'click', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                    title: "Konfirmasi Hapus Data",
                    text: "Apakah anda yakin ingin menghapus data ini?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm){
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: baseUrl + "arsip/delete",
                            data: {id: id},
                            success: function(r){
                                oTable._fnAjaxUpdate();
                                swal(r.message, "", r.type);
                            }
                        });
                    } else {
                        swal("Batal", "Hapus data dibatalkan", "error");
                    }
                });
        });

        function clearForm(){
            $('input:radio[name=tipe_arsip][value=1]').prop('checked', true);
            $('input:radio[name=jenis_arsip][value=0]').prop('checked', true);
            $('#frm-add').find('input[type=text],textarea').val('');
            $('.fileinput-remove').click();
            $('div.file').show();
            $('div.folder').hide();
            $('#simpan-arsip').hide();
        }

    });

    $(function(){
        if($('#level').val() == '0'){
            $('#btn-up').hide();
        } else {
            $('#btn-up').show();
        }

        checkPath($('#path').val());

        $('#btn-up').on('click', function(e){
            e.preventDefault();
            var level = parseInt($('#level').val()),
                path  = $('#path').val(),
                exp = path.split(','),
                parent = exp[level-1];

            $('#level').val(level - 1);
            $('#parent').val(parent);

            if($('#level').val() == '0'){
                $('#path').val('');
                $('#btn-up').hide();
            } else {
                var lastIndex = path.lastIndexOf(","),
                    lastPath = path.substring(0, lastIndex);
                $('#path').val(lastPath);
                $('#btn-up').show();
            }

            checkPath($('#path').val());

            oTable._fnAjaxUpdate();
        });

        $('input[type=radio][name=jenis_arsip]').change(function() {
            if (this.value == '1') { // Folder
                $('div.file').hide();
                $('div.folder').show();
                $('#simpan-arsip').show();
            }
            else if (this.value == '0') {
                $('div.folder').hide();
                $('div.file').show();
                $('#simpan-arsip').hide();
            }
        });

        $('#simpan-arsip').on('click', function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {
                    parent: $('#curr_parent').val(),
                    level:  $('#curr_level').val(),
                    tipe_arsip: $('input[name=tipe_arsip]:checked').val(),
                    nm_folder: $('#nm_folder').val(),
                    deskripsi: $('#deskripsi').val()
                },
                url: $('#frm-add').attr('action'),
                success: function(r){
                    if(r.error == true){
                        new PNotify({
                            title: 'Error!',
                            text: r.message,
                            addclass: 'bg-danger'
                        });
                    } else {
                        $('#mdl_add').modal('hide');
                        oTable._fnAjaxUpdate();

                        new PNotify({
                            title: 'Sukses!',
                            text: r.message,
                            addclass: 'bg-success'
                        });
                    }
                }
            });
        });

        $('#simpan-rename').on('click', function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {id: $('#rename_id').val(), arsip: $('#rename').val()},
                url: baseUrl + "arsip/rename",
                success: function(r){
                    if(r.error == true){
                        new PNotify({
                            title: 'Error!',
                            text: r.message,
                            addclass: 'bg-danger'
                        });
                    } else {
                        $('#mdl_rename').modal('hide');

                        oTable._fnAjaxUpdate();

                        new PNotify({
                            title: 'Sukses!',
                            text: r.message,
                            addclass: 'bg-success'
                        });
                    }
                }
            });
        });

        $('#lampiran').fileinput({
            uploadUrl: baseUrl + "arsip/upload_file", // server upload action
            uploadAsync: false,
            minFileCount: 1,
            maxFileCount: 5,
            uploadExtraData: function() {
                var obj = {}
                obj['parent']       = $('#curr_parent').val();
                obj['level']        = $('#curr_level').val();
                obj['is_public']    = $('input[name=tipe_arsip]:checked').val();
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

            $('#mdl_add').modal('hide');
            oTable._fnAjaxUpdate();
        });

    });
</script>

