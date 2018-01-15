<script src="<?=base_url('assets/js/tables/datatables/datatables.min.js');?>"></script>
<script src="<?=base_url('assets/js/tables/datatables/extensions/buttons.min.js');?>"></script>
<script src="<?=base_url('assets/js/sweetalert.js');?>"></script>

<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-calendar2 position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Kegiatan</li>
            <li class="active"><?=$page_title;?></li>
        </ul>
    </div>
</div>

<div class="container-fluid page-content">
    <div class="panel panel-flat panel-collapsed">
        <div class="panel-heading">
            <h5 class="panel-title"><i class="icon-filter4 postition-left"></i> Filter Data <small>Kegiatan</small></h5>
            <div class="elements">
                <ul class="icons-list">
                    <li><a data-action="collapse" id="filter-collapse" data-popup="tooltip" title="" data-original-title="Filter Kegiatan" class="rotate-180"></a></li>
                </ul>
            </div>
            <a class="elements-toggle"><i class="icon-more"></i></a></div>
        <div class="panel-body" style="display: none;">
            <?=form_open('kegiatan/dt_kegiatan', array('id' => 'frm-filter'));?>
            <div class="form-group m-b-5">
                <select name="eselon1" class="select" data-placeholder="Kepala / Eselon I" id="eselon1" data-width="100%">
                    <option value=""></option>
                    <?php foreach($eselon1 as $t) : ?>
                        <?php if(isset($user['eselon1']) && $user['eselon1'] == $t['kd_satker']) : ?>
                            <option value="<?=$t['kd_satker'];?>" selected><?=$t['satker'];?></option>
                        <?php else : ?>
                            <option value="<?=$t['kd_satker'];?>"><?=$t['satker'];?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group m-b-5">
                <select name="eselon2" class="select" data-placeholder="Eselon II" id="eselon2" data-width="100%">
                    <?php if(isset($eselon2)) : ?>
                        <?=$eselon2;?>
                    <?php else : ?>
                        <option value=""></option>
                    <?php endif;?>
                </select>
            </div>

            <div class="form-group m-b-5">
                <select name="eselon3" class="select" data-placeholder="Eselon III" id="eselon3" data-width="100%">
                    <?php if(isset($eselon3)) : ?>
                        <?=$eselon3;?>
                    <?php else : ?>
                        <option value=""></option>
                    <?php endif;?>
                </select>
            </div>

            <div class="form-group m-b-5">
                <select name="eselon4" class="select" data-placeholder="Eselon IV" id="eselon4" data-width="100%">
                    <?php if(isset($eselon4)) : ?>
                        <?=$eselon4;?>
                    <?php else : ?>
                        <option value=""></option>
                    <?php endif;?>
                </select>
            </div>
            <input type="hidden" name="filter" id="filter" value="<?=$this->session->unit_kerja;?>" />
            <input type="hidden" name="eselon" id="eselon" value="<?=$eselon;?>" />
            <?=form_close();?>
        </div>
        <div class="modal-footer no-padding-top">
            <button type="button" id="submit_filter" class="btn bg-blue btn-sm btn-labeled"><b><i class="icon-filter4"></i></b>Simpan Filter</button>
        </div>
    </div>

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

<div id="mdl_kegiatan" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal_title_kegiatan" class="modal-title"></h4>
            </div>
            <div class="modal-body" id="modal_content_kegiatan"></div>
            <div class="modal-footer no-padding-top">
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="mdl_undangan" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal_title_undangan" class="modal-title"></h4>
            </div>
            <div class="modal-body" id="modal_content_undangan"></div>
            <div class="modal-footer no-padding-top">
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var baseUrl = '<?=base_url();?>', oTable;
    $(document).ready(function() {
        oTable = $('#tbl-kegiatan').dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": baseUrl + "kegiatan/dt_kegiatan",
            "bAutoWidth": false,
            //"stateSave": true,
            "sPaginationType": "full_numbers",
            "bSort": true,
            "dom": '<"datatable-header"fBl><"datatable-scroll-lg"t><"datatable-footer"ip>',
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
                {"data":"kegiatan", "sName":"kegiatan", "sWidth":"20%"},
                {"data":"jenis_kegiatan", "sName":"jenis_kegiatan", "sWidth":"15%"},
                {"data":"lokasi", "sName":"lokasi", "sWidth":"20%"},
                {"data":"satker", "sName":"satker", "sWidth":"20%"},
                {"data":"tanggal_mulai", "sName":"tanggal_mulai", "sWidth":"10%"},
                {"data":"tanggal_akhir", "sName":"tanggal_akhir", "sWidth":"10%"},
                {"data":"tu", "sName":"tu", "sWidth":"5%", render: function(data) {
                    if(data == 1) {
                        return '<label class="label label-success">Selesai</label>';
                    } else {
                        return '<label class="label label-warning">Proses</label>';
                    }
                }},
                {"data":"keuangan", "sName":"keuangan", "sWidth":"5%", render: function(data) {
                    if(data == 1) {
                        return '<label class="label label-success">Selesai</label>';
                    } else {
                        return '<label class="label label-warning">Proses</label>';
                    }
                }},
                <?php if($privileges[1] == '1' or $privileges[2] == '1'): ?>
                {
                    "data":"aksi","class": "text-center", "sWidth":"5%",
                    "render": function ( data, type, row ) {
                        var result;
                        if(row.user_id !== '<?=$this->session->user_id;?>'){
                            var btn = $(row.aksi);
                            btn.find("ul.action_menu li:not(:first)").remove();
                            result = '<ul class="icons-list">' + btn.html() + '</ul>';
                        } else {
                            result = data;
                        }

                        return result;
                    }
                }
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
                aoData.push({"name": "filter", "value": $('#filter').val()});
                aoData.push({"name": "eselon", "value": $('#eselon').val()});

                $.ajax
                ({
                    'dataType': 'json',
                    'type'    : 'POST',
                    'url'     : sSource,
                    'data'    : aoData,
                    'success' : fnCallback
                });
            },
            buttons: {
                dom: {
                    button: {
                        className: 'btn btn-primary'
                    }
                },
                buttons: [
                    {extend: 'copy', className: 'copyButton' },
                    {extend: 'csv', className: 'csvButton' },
                    {extend: 'excel', className: 'excelButton' },
                    {extend: 'pdf', className: 'pdfButton' },
                    {extend: 'print', className: 'printButton' }
                ]
            }
        });

        $('.dataTables_filter input[type=search]').attr('placeholder','Pencarian...');

        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            width: 'auto'
        });

        <?php if($this->session->flashdata('notif')): ?>
        swal("<?=$this->session->flashdata('notif');?>", "", "<?=$this->session->flashdata('type');?>");
        <?php endif; ?>

    });
</script>
<script type="text/javascript" src="<?=base_url('assets/js/app/kegiatan.js');?>"></script>

