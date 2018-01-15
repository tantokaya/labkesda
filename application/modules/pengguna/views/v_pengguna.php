<script src="<?=base_url('assets/js/tables/datatables/datatables.min.js');?>"></script>
<script src="<?=base_url('assets/js/sweetalert.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/pnotify.min.js');?>"></script>

<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-user position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Pengaturan</li>
            <li>Pengguna</li>
            <li class="active"><?=$page_title;?></li>
        </ul>
    </div>
</div>

<div class="container-fluid page-content">
    <div class="panel panel-default panel-bordered">
        <div class="panel-heading">
            <h5 class="panel-title"><i class="icon-three-bars position-left"></i> <?=$page_title;?></h5>
            <?php $privileges = explode(',', $priv['privileges']); ?>
            <?php if ($privileges[0] == 1): ?>
            <div class="elements">
                <button type="button" id="btn-add" class="btn btn-sm btn-info">Tambah <i class="icon-plus2"></i></button>
            </div>
            <?php endif; ?>
        </div>

        <div class="panel-body">
            <?php echo $this->table->generate(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var oTable = $('#tbl-pengguna').dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": '<?php echo base_url('pengguna/dt_pengguna'); ?>',
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "bSort": true,
            "dom": '<"datatable-header"fl><"datatable-scroll-lg"t><"datatable-footer"ip>',
            "language": {
                "search": '<span>Pencarian:</span> _INPUT_',
                "lengthMenu": '<span>Show:</span> _MENU_',
                "paginate": { 'first': 'Pertama', 'last': 'Terakhir', 'next': '&rarr;', 'previous': '&larr;' }
            },
            lengthMenu: [ 10, 25, 50, 75, 100 ],
            "fnInitComplete": function() {
                //oTable.fnAdjustColumnSizing();
            },
            "columns": [
                {"data":"nama", "sName":"nama"},
                {"data":"email", "sName":"email"},
                {"data":"akses","sName":"akses"},
                {"data":"jabatan","sName":"jabatan"},
                {"data":"satker","sName":"satker"},
                <?php if($privileges[1] == '1' or $privileges[2] == '1'): ?>
                {"data":"aksi","class": "text-center"}
                <?php endif; ?>
            ],
            "aoColumnDefs": [
                {
                    'bSortable': false,
                    'bSearchable':false,
                    'aTargets': [ -1 ]
                }
            ],
            "fnServerData": function(sSource, aoData, fnCallback)
            {
                aoData.push({"name": "edit_priv", "value": "<?php echo $privileges[1]; ?>"});
                aoData.push({"name": "delete_priv", "value": "<?php echo $privileges[2]; ?>"});

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

        <?php if($this->session->flashdata('notif')): ?>
        swal("<?=$this->session->flashdata('notif');?>", "", "<?=$this->session->flashdata('type');?>");
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
        new PNotify({
            title: 'Error',
            text: '<?=$this->session->flashdata('error');?>',
            icon: 'icon-blocked',
            type: 'error',
            addclass: 'bg-danger'
        });
        <?php endif; ?>

        $('#btn-add').on('click', function(e) {
            e.preventDefault();
            window.location.href = "<?=base_url('pengguna/add');?>";
        });

        $('#tbl-pengguna').delegate('a.btn-delete', 'click', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                    title: "Konfirmasi Hapus Data",
                    text: "Apakah anda yakin ingin menghapus data ini?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: 'btn-danger',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: "Batal",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm){
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "<?=base_url('pengguna/delete');?>",
                            data: {id: id},
                            success: function(r){
                                oTable._fnAjaxUpdate();
                                swal(r.message, "", r.type);
                            },
                            error: function(e){
                                console.log(e.responseText());
                            }
                        });
                    } else {
                        swal("Batal", "Hapus data dibatalkan", "error");
                    }
                });
        });

    });
</script>

