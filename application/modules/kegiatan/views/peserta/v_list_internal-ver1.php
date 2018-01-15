<script src="<?=base_url('assets/js/tables/datatables/datatables.min.js');?>"></script>

<div class="panel-heading">

</div>
<div class="panel-body">
    <?php echo $this->table->generate(); ?>
</div>

<script type="text/javascript">
    function getFormAddPesertaInternal(pegawai_id) {
        var title = ($('#jenis_kegiatan_id').val() == '3')?'Perjadin':'FGD / Rapat / Seminar';
        $('#modal_title').html('Tambah Peserta Kegiatan ' + title);

        $.ajax({
            type: "POST",
            url: "<?=base_url('kegiatan/form_peserta_internal');?>",
            data: {
                kegiatan_id: $('#kegiatan_id').val(),
                jenis_kegiatan_id: $('#jenis_kegiatan_id').val(),
                pegawai_id: pegawai_id
            },
            success: function (result) {
                $('#modal_content').html(result);
                if($('#jenis_kegiatan_id').val() == '3'){
                    var tanggal_mulai2 = $('#tanggal_mulai2').pickadate({format: 'dd/mm/yyyy'});
                    var tanggal_akhir2 = $('#tanggal_akhir2').pickadate({format: 'dd/mm/yyyy'});

                    tanggal_mulai2.pickadate('picker').set('select', tanggal_mulai.val(), {format: 'dd/mm/yyyy'});
                    tanggal_akhir2.pickadate('picker').set('select', tanggal_akhir.val(), {format: 'dd/mm/yyyy'});
                }
                oTable.api().ajax.reload();
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
    };
    var baseUrl = '<?=base_url();?>', oTable;
    $(document).ready(function() {
        oTable = $('#tbl-internal').dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": baseUrl + "kegiatan/dt_internal",
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
                {"data":"no_npwp", "sName":"no_npwp"},
                {"data":"nm_pegawai", "sName":"nm_pegawai"},
                {"data":"email", "sName":"email"},
                {"data":"no_telepon", "sName":"no_telepon"},
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
                aoData.push({
                    "name" : "filter",
                    "value" : $('#filter').val()
                    },
                    {
                    "name" : "id",
                    "value" : "<?= $id ?>"
                    });
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
    });
</script>
