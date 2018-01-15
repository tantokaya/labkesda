<table class="table list-lampiran table-hover table-bordered">
    <thead>
    <tr>
        <th data-toggle="true">Jenis Laporan</th>
        <th data-toggle="true">Nama File</th>
        <!--        <th data-hide="phone">Ukuran</th>-->
        <!-- <th data-hide="phone">Status</th> -->
         <th data-hide="phone">Status TU</th>
         <th data-hide="phone">Status Keuangan</th>
        <th style="width: 100px;" class="text-center">Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php if($list_lampiran->num_rows() > 0): ?>
        <?php foreach($list_lampiran->result_array() as $t): ?>
            <tr>
                <td><?=$t['jenis_laporan'];?></td>
                <td><?=$t['title'];?></td>
                <!--                    <td class="text-center"><span class="label label-danger">--><?//=$t['file_size'];?><!-- Kb</span></td>-->
                <!-- <td><span class="label label-warning">PENGECEKAN TATA USAHA</span></td> -->
                <td><?php
                    if($t['status_tu'] == 0): echo '<label class="label label-warning">Proses</label>';
                    elseif($t['status_tu'] == -1): echo '<label class="label label-danger">Perbaikan</label>';
                    elseif($t['status_tu'] == 1): echo '<label class="label label-success">Selesai</label>';
                    endif
                ?></td>
                <td><?php
                    if($t['status_keuangan'] == 0): echo '<label class="label label-warning">Proses</label>';
                    elseif($t['status_keuangan'] == -1): echo '<label class="label label-danger">Perbaikan</label>';
                    elseif($t['status_keuangan'] == 1): echo '<label class="label label-success">Selesai</label>';
                    endif
                ?></td>
                <td class="text-center">
                    <ul class="icons-list">
                        <li><a href="#" onclick="(getLampiranModalContent(<?= $t['lampiran_kegiatan_id'] ?>))"><i class="icon-eye"></i></a></li>
                        <li><a href="<?=FSPATH.'lampiran_kegiatan/'.$t['path_folder'].'/'.$t['file_name'];?>" download="<?=$t['title'];?>"><i class="icon-download"></i></a></li>
                        <li><a href="#" onclick="deleteLampiran('<?=encode($t['lampiran_kegiatan_id']);?>','<?=$id?>')"><i class="icon-trash"></i></a></li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="5" class="text-center">Belum ada lampiran kegiatan</td>
        </tr>
    <?php endif;?>
    </tbody>
</table>

<div class="modal fade" id="lampiran-modal" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 id="" class="modal-title">Status Laporan</h4>
            </div>
            <div class="modal-body" id="lampiran-content">
            </div>

            <div class="modal-footer no-padding-top">
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function deleteLampiran(lampiran_id, id){
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {lampiran_id: lampiran_id, kegiatan_id: id},
            url: "<?=base_url('kegiatan/delete_lampiran');?>",
            success: function(r){
                var options = {};
                if(r.error == false){
                    options.icon     = 'icon-checkmark3';
                    options.addclass = 'bg-success';
                } else {
                    options.icon     = 'icon-blocked';
                    options.addclass = 'bg-danger';
                }
                options.title = r.title;
                options.text  = r.message;
                options.type  = r.type;

                new PNotify(options);

                getListLampiran(r.kegiatan_id);
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
    }

    function getListLampiran(id){
        $.ajax({
            type: "POST",
            url: "<?=base_url('kegiatan/get_list_lampiran');?>",
            data: {id: id},
            success: function(res){
                $('#list-lampiran').html(res).fadeIn('slow');
            }
        });
    }

    function getLampiranModalContent(id){
        $.ajax({
            type: "POST",
            url: "<?=base_url('kegiatan/get_reply_lampiran');?>",
            data: {id: id},
            success: function(res){
                $('#lampiran-content').html(res);
                $('#lampiran-modal').modal('show');
            }
        });
    }
</script>