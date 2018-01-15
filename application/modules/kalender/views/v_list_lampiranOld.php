<table class="table list-lampiran table-hover table-bordered">
    <thead>
    <tr>
        <th data-toggle="true">Nama File</th>
        <th data-hide="phone">Ukuran</th>
        <th style="width: 80px;" class="text-center">Aksi</th>
    </tr>
    </thead>
    <tbody>
        <?php if($list_lampiran->num_rows() > 0): ?>
            <?php foreach($list_lampiran->result_array() as $t): ?>
                <tr>
                    <td><?=$t['title'];?></td>
                    <td class="text-center"><span class="label label-danger"><?=$t['file_size'];?> Kb</span></td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li><a href="<?=FSPATH.'lampiran_kegiatan/'.$t['path_folder'].'/'.$t['file_name'];?>" download="<?=$t['title'];?>"><i class="icon-download"></i></a></li>
                            <li><a href="#" onclick="deleteLampiran('<?=encode($t['lampiran_kegiatan_id']);?>','<?=$id?>')"><i class="icon-trash"></i></a></li>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="3" class="text-center">Belum ada lampiran kegiatan</td>
            </tr>
        <?php endif;?>
    </tbody>
</table>

<script type="text/javascript">
    function deleteLampiran(lampiran_id, id){
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {lampiran_id: lampiran_id, kegiatan_id: id},
            url: "<?=base_url('kalender/delete_lampiran');?>",
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
            url: "<?=base_url('kalender/get_list_lampiran');?>",
            data: {id: id},
            success: function(res){
                $('#list-lampiran').html(res).fadeIn('slow');
            }
        });
    }
</script>