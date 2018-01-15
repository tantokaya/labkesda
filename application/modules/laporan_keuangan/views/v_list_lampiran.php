<table class="table list-lampiran table-hover table-bordered">
    <thead>
    <tr>
        <th data-toggle="true" style="width: 15%;">Jenis Laporan</th>
        <th data-toggle="true" style="width: 20%;">Nama File</th>
        <th data-toggle="true" style="width: 30%;">Notes</th>
        <th data-toggle="true" style="width: 10%;">Tanggal Upload</th>
        <th data-toggle="true" style="width: 15%;">Status</th>
        <th class="text-center" style="width: 10%">Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php if($list_lampiran->num_rows() > 0): ?>
        <?php foreach($list_lampiran->result_array() as $t): ?>
            <tr>
                <td><?=$t['jenis_laporan'];?></td>
                <td><?=$t['title'];?></td>
                <td><?=$t['reply_keuangan']?></td>
                <td><?=$this->functions->convert_date_indo(['datetime'=> $t['ctime']])?></td>
                <td>
                    <?php if($t['status_keuangan'] == 0) {
                       echo '<label class="label label-warning">Proses</label>';
                    } elseif($t['status_keuangan'] == 1) {
                       echo '<label class="label label-success">Selesai</label>';
                    } else {
                        echo '<label class="label label-danger">Perbaikan</label>';
                    }

                    ?>
                </td>
                <td class="text-center">
                    <ul class="icons-list">
                        <li><a href="#" data-toggle="modal" data-target="#view<?=encode($t['lampiran_kegiatan_id'])?>"><i class="icon-eye"></i></a></li>
                        <li><a href="<?=FSPATH.'lampiran_kegiatan/'.$t['path_folder'].'/'.$t['file_name'];?>" download="<?=$t['title'];?>"><i class="icon-download"></i></a></li>
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
<hr/>
<h5>Lampiran kegiatan yang belum diupload</h5>
<ul>
    <?php foreach($lampiran_exist as $t):?>
    <li><?=$t['jenis_laporan']?></li>
    <?php endforeach;?>
</ul>

<?php foreach($list_lampiran->result_array() as $t):?>
<div id="view<?=encode($t['lampiran_kegiatan_id'])?>" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url()?>laporan_keuangan/notes" class="form-horizontal" method="POST">
                <input type="hidden" name="lampiran_kegiatan_id" value="<?=encode($t['lampiran_kegiatan_id'])?>">
                <input type="hidden" name="url" value="<?=encode($t['kegiatan_id'])?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 id="" class="modal-title">Status Laporan</h4>
                    <div class="alert bg-danger" id="error_info2" style="display: none;"></div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Status <span class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <select class="form-control" style="width: 100%;" name="status_keuangan" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="-1" >Perbaikan</option>
                                    <option value="1" >Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Notes</label>
                            <div class="col-sm-9">
                                <textarea name="reply_keuangan" id="" class="form-control">-</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-padding-top">
                    <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach;?>