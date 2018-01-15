<script src="<?=base_url('assets/js/tables/datatables/datatables.min.js');?>"></script>

<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-user-tie position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Kegiatan</li>
            <li>Peserta</li>
            <li class="active"><?=$page_title;?></li>
        </ul>
    </div>
</div>

<div class="container-fluid page-content">
    <div class="panel panel-default panel-bordered">
        <div class="panel-heading">
            <h5 class="panel-title"><i class="icon-three-bars position-left"></i> <?=$page_title;?></h5>
            <?php $privileges = explode(',', $priv['privileges']); ?>
        </div>

        <div class="panel-body">
            <?php echo $this->table->generate(); ?>
        </div>
    </div>
</div>

<div id="mdl_peserta_internal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal_title" class="modal-title">Profile Peserta Internal</h4>
            </div>
            <div class="modal-body" id="modal_content"></div>
            <div class="modal-footer no-padding-top">
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var oTable = $('#tbl-peserta-internal').dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": '<?php echo base_url('peserta_internal/dt_peserta_internal'); ?>',
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
                {"data":"nip", "sName":"nip", "sWidth":"10%"},
                {"data":"nm_pegawai", "sName":"nm_pegawai", "sWidth":"55%"},
                {"data":"tempat_lahir", "sName":"tempat_lahir", "sWidth":"15%"},
                {"data":"tanggal_lahir", "sName":"tanggal_lahir", "sWidth":"15%"},
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
                aoData.push();

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
    });

    $(function () {
        $('#tbl-peserta-internal').delegate('a','click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            $('modal_title').html($(this).data('title').toUpperCase());

            $.ajax({
                type: 'POST',
                data: {id:id},
                url: '<?=base_url()?>peserta_internal/view',
                success: function(data) {
                    $('#modal_content').html(data);
                },
                error: function(e) {
                    new PNotify({
                        title: 'Error',
                        text: 'Terjadi kesalahan gagal load view kegiatan!',
                        icon: 'icon-blocked',
                        type: 'error',
                        addclass: 'bg-danger'
                    });
                }
            });

            $('#mdl_peserta_internal').modal('show');    
        });
    });

</script>

