<div id="mdl_kegiatan" class="modal fade in" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true" style="display: block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 id="modal_title_kegiatan" class="modal-title">D1 - PENYUSUNAN MODEL EKONOMI KREATIF </h4>
            </div>
            <div class="modal-body" id="modal_content_kegiatan"><script type="text/javascript" src="http://localhost/bekraf/assets/js/tables/footable.min.js"></script>
                <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-highlight nav-bordered tab-menu" id="tab-kegiatan">
                        <li class="active"><a href="#kegiatan-tab" data-toggle="tab" aria-expanded="true"><i class="icon-calendar52 position-left"></i> Kegiatan</a></li>
                        <li><a href="#lampiran-tab" data-toggle="tab" aria-expanded="false"><i class="icon-cloud-upload2 position-left"></i> Lampiran</a></li>
                        <li><a href="#peserta-tab" data-toggle="tab" aria-expanded="false"><i class="icon-users2"></i> Daftar Peserta Kegiatan</a></li>
                    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="kegiatan-tab">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td style="width: 28%;">Kegiatan</td>
                        <td style="width: 1%;">:</td>
                        <td style="width: 76%;">Penyusunan Model Ekonomi Kreatif </td>
                    </tr>
                    <tr>
                        <td>Tipe Kegiatan</td>
                        <td>:</td>
                        <td>Grup</td>
                    </tr>
                    <tr>
                        <td>Jenis Kegiatan</td>
                        <td>:</td>
                        <td>FGD</td>
                    </tr>
                    <tr>
                        <td>Publik</td>
                        <td>:</td>
                        <td>Ya</td>
                    </tr>
                    <tr>
                        <td>Tanggal Mulai</td>
                        <td>:</td>
                        <td>30/01/2017 08:00:00</td>
                    </tr>
                    <tr>
                        <td>Tanggal Akhir</td>
                        <td>:</td>
                        <td>31/01/2017 05:00:00</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>:</td>
                        <td>Jakarta</td>
                    </tr>
                    <tr>
                        <td>Keterangan Kegiatan</td>
                        <td>:</td>
                        <td>Penyusunan Model 16 Subsektor Ekonomi Kreatif dengan metode sistem dinamik</td>
                    </tr>
                    <tr>
                        <td>PIC</td>
                        <td>:</td>
                        <td>Muhamad Harry Kurniawan</td>
                    </tr>
                    <tr>
                        <td>MAK</td>
                        <td>:</td>
                        <td>524111</td>
                    </tr>
                    <tr>
                        <td>Deskripsi MAK</td>
                        <td>:</td>
                        <td>pelaksanaan Koordinasi pengembangan model Ekonomi kreatif</td>
                    </tr>
                    <tr>
                        <td>Nama Pembuat</td>
                        <td>:</td>
                        <td>Bayu Try Nugraha Abdi</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>bayuabdi13@gmail.com</td>
                    </tr>
                    <tr>
                        <td>Unit Kerja</td>
                        <td>:</td>
                        <td>Sub Direktorat Metodologi dan Analisis Riset</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-pane" id="lampiran-tab">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Lampiran</h5>
                </div>
                <div class="panel-body">
                    <div class="table-responsive" id="list-lampiran">
                        <table class="table list-lampiran table-hover table-bordered footable-loaded footable">
                            <thead>
                            <tr>
                                <th data-toggle="true">Nama File</th>
                                <th data-hide="phone">Ukuran</th>
                                <th style="width: 80px;" class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                                            <tr>
                                    <td colspan="3" class="text-center">Belum ada lampiran kegiatan</td>
                                </tr>
                                                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="peserta-tab">
            <div class="panel panel-flat">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <div class="table-responsive" id="list-peserta">
                        <table class="table table-bordered table-striped table-hover table-togglable" id="list_undangan">
                            <thead>
                            <tr>
                                <th data-toggle="true">No</th>
                                <th data-toggle="true">Nama Peserta</th>
                                <th data-toggle="true">Nama Instansi</th>
                                <th data-hide="tablet,phone">Golongan</th>
                                <th data-hide="phone">Jabatan</th>
                                <th data-toggle="true">Status</th>
                                <th style="width: 100px;" class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                                            <tr>
                                    <td colspan="7" class="text-center">Belum ada data peserta kegiatan</td>
                                </tr>
                                                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $('table.list-lampiran').footable();

        $('#list_undangan').delegate('a.btn-view-peserta', 'click', function(e){
            e.preventDefault();
            $('#mdl_kegiatan').modal('hide');
            var id = $(this).data('id');

            $('#modal_title_undangan').html('Lihat Data Peserta Kegiatan ' + $(this).data('title'));

            $.ajax({
                type: "POST",
                url: "http://localhost/bekraf/kegiatan/peserta_view",
                data: {id: id, jenis_kegiatan_id: $(this).data('jenis-kegiatan-id')},
                success: function (result) {
                    $('#modal_content_undangan').html(result);
                },
                error: function(er){
                    new PNotify({
                        title: 'Error',
                        text: 'Terjadi kesalahan gagal load data informasi peserta kegiatan!',
                        icon: 'icon-blocked',
                        type: 'error',
                        addclass: 'bg-danger'
                    });
                }
            });
            $('#mdl_undangan').modal('show');

        });

        $('#mdl_undangan [data-dismiss=modal]').on('click', function (e) {
            $('#mdl_kegiatan').modal('show');
        });

    });
</script></div>
            <div class="modal-footer no-padding-top">
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>