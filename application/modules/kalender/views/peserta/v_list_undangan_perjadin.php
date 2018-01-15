<table class="table table-bordered table-hover table-striped table-togglable" id="list_undangan">
    <thead>
    <tr>
        <th data-toggle="true">No</th>
        <th data-toggle="true">Nama Peserta</th>
        <th data-hide="tablet,phone">Golongan</th>
        <th data-hide="tablet,phone">Jabatan</th>
        <th data-hide="phone">Tanggal Mulai Dinas</th>
        <th data-hide="phone">Tanggal Akhir Dinas</th>
        <th style="width: 100px;" class="text-center">Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php if(count($list_peserta) > 0): $i=1; ?>
        <?php foreach($list_peserta as $v): ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$v['nm_peserta'];?></td>
                <td class="text-center"><?=$v['golongan'];?></td>
                <td><?=$v['jabatan'];?></td>
                <td><?=$v['tanggal_mulai'];?></td>
                <td><?=$v['tanggal_akhir'];?></td>
                <td class="text-center">
                    <ul class="icons-list">
                        <li><a href="#" class="btn-view-peserta" data-id="<?=encode($v['peserta_kegiatan_id']);?>"><i class="icon-eye" data-popup="tooltip-custom" title="Lihat Data Peserta"></i></a></li>
                        <li><a href="#" class="btn-ubah-peserta" data-id="<?=encode($v['peserta_kegiatan_id']);?>"><i class="icon-pencil6"></i></a></li>
                        <li><a href="#" class="btn-delete-peserta" data-id="<?=encode($v['peserta_kegiatan_id']);?>"><i class="icon-trash"></i></a></li>
                    </ul>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7" class="text-center">Belum ada data peserta kegiatan</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<script type="text/javascript">
    $(function(){
        $('.table-togglable').footable();

        $('#list_undangan').delegate('a.btn-delete-peserta', 'click', function(e){
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
                            url: "<?=base_url('kegiatan/delete_peserta');?>",
                            data: {id: id},
                            success: function(r){
                                getListUndangan($('#kegiatan_id').val());
                                swal(r.message, "", r.type);
                            }
                        });
                    } else {
                        swal("Batal", "Hapus data dibatalkan", "error");
                    }
                }
            );
        }).delegate('a.btn-ubah-peserta', 'click', function(e){
            e.preventDefault();
            var id = $(this).data('id');

            var title = ($('#jenis_kegiatan_id').val() == '3')?'Perjadin':'FGD / Rapat / Seminar';
            $('#modal_title').html('Ubah Peserta Kegiatan ' + title);

            $.ajax({
                type: "POST",
                url: "<?=base_url('kegiatan/form_peserta_edit');?>",
                data: {id: id, jenis_kegiatan_id: $('#jenis_kegiatan_id').val()},
                success: function (result) {
                    $('#modal_content').html(result);
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
        }).delegate('a.btn-view-peserta', 'click', function(e){
            e.preventDefault();
            var id = $(this).data('id');

            var title = ($('#jenis_kegiatan_id').val() == '3')?'Perjadin':'FGD / Rapat / Seminar';
            $('#modal_title').html('Lihat Data Peserta Kegiatan ' + title);

            $.ajax({
                type: "POST",
                url: "<?=base_url('kegiatan/form_peserta_view');?>",
                data: {id: id, jenis_kegiatan_id: $('#jenis_kegiatan_id').val()},
                success: function (result) {
                    $('#modal_content').html(result);
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

        function getListUndangan(id){
            $.ajax({
                type: "POST",
                url: "<?=base_url('kegiatan/get_list_peserta');?>",
                data: {id: id},
                success: function(res){
                    $('#list-peserta').html(res).fadeIn('slow');
                }
            });
        }
    });
</script>