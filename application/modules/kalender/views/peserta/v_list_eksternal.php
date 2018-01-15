<script src="<?=base_url('assets/js/tables/datatables/datatables.min.js');?>"></script>

<div class="panel-heading">
    <button type="button" id="btn-add-peserta" class="btn btn-sm btn-info">Tambah Peserta Eksternal <i class="icon-plus2"></i></button>
</div>
<div class="panel-body">
    <?php echo $this->table->generate(); ?>
</div>

<script type="text/javascript">
    var baseUrl = '<?=base_url();?>', tableEksternal;
    $(document).ready(function() {
        tableEksternal = $('#tbl-eksternal').dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": baseUrl + "kegiatan/dt_eksternal",
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
                {"data":"nm_peserta", "sName":"nm_peserta"},
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
    function getFormAddPesertaEksternal(peserta_eksternal_id) {
        var title = ($('#jenis_kegiatan_id').val() == '3')?'Perjadin':'FGD / Rapat / Seminar';
        $('#modal_title').html('Tambah Peserta Kegiatan Eksternal' + title);

        $.ajax({
            type: "POST",
            url: "<?=base_url('kegiatan/form_peserta_eksternal');?>",
            data: {
                kegiatan_id: $('#kegiatan_id').val(),
                jenis_kegiatan_id: $('#jenis_kegiatan_id').val(),
                peserta_eksternal_id: peserta_eksternal_id,
            },
            success: function (result) {
                $('#modal_content').html(result);
                if($('#jenis_kegiatan_id').val() == '3'){
                    var tanggal_mulai2 = $('#tanggal_mulai2').pickadate({format: 'dd/mm/yyyy'});
                    var tanggal_akhir2 = $('#tanggal_akhir2').pickadate({format: 'dd/mm/yyyy'});

                    tanggal_mulai2.pickadate('picker').set('select', tanggal_mulai.val(), {format: 'dd/mm/yyyy'});
                    tanggal_akhir2.pickadate('picker').set('select', tanggal_akhir.val(), {format: 'dd/mm/yyyy'});
                }
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
</script>
