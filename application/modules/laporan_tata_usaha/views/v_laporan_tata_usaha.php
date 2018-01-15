<script src="<?=base_url('assets/js/tables/datatables/datatables.min.js');?>"></script>
<script src="<?=base_url('assets/js/tables/datatables/extensions/buttons.min.js');?>"></script>
<script src="<?=base_url('assets/js/sweetalert.js');?>"></script>

<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-city position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Kegiatan</li>
            <li>Laporan</li>
            <li class="active"><?=$page_title;?></li>
        </ul>
    </div>
</div>

<div class="container-fluid page-content">
    <div class="panel panel-default panel-bordered">
        <div class="panel-heading">
            <h5 class="panel-title"><i class="icon-three-bars position-left"></i> <?=$page_title;?></h5>
        </div>

        <div class="panel-body">
            <?php echo $this->table->generate(); ?>
        </div>
    </div>
</div>

<div id="mdl_selesai" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="<?=base_url()?>laporan_tata_usaha/selesai" method="POST">
                <input type="hidden" name="id" id="id">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 id="modal_title" class="modal-title">Warning</h4>
                </div>
                <div class="modal-body">
                    <h3>Apakah anda yakin?</h3>
                </div>
                <div class="modal-footer no-padding-top">
                    <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var oTable = $('#tbl-laporan-tu').dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": '<?php echo base_url('laporan_tata_usaha/dt_laporan_tu'); ?>',
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
                {"data":"kegiatan", "sName":"kegiatan", "sWidth":"10%"},
                {"data":"jenis", "sName":"jenis", "sWidth":"25%"},
                {"data":"lokasi", "sName":"lokasi", "sWidth":"5%"},
                {"data":"unit_kerja", "sName":"unit_kerja", "sWidth":"25%"},
                {"data":"tanggal_mulai", "sName":"tanggal_mulai", "sWidth":"10%"},
                {"data":"tanggal_akhir", "sName":"tanggal_akhir", "sWidth":"10%"},
                {"data": "status_tu", "sName":"status_tu", "sWidth":"10%", render: function(data) {
                    if(data == 1) {
                        return '<label class="label label-success">Selesai</label>';
                    } else {
                        return '<label class="label label-warning">Proses</label>';
                    }
                }},
                {"data":"aksi","class": "text-center", "sWidth":"5%"},

                
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

        <?php if($this->session->flashdata('notif')): ?>
        swal("<?=$this->session->flashdata('notif');?>", "", "<?=$this->session->flashdata('type');?>");
        <?php endif; ?>

        $('#mdl_selesai').on('show.bs.modal', function(event) {
            $('#id').val($(event.relatedTarget).data('id'));
        })
    });
</script>