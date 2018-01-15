<script type="text/javascript" src="<?=base_url('assets/js/tables/footable.min.js');?>"></script>
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
                        <td style="width: 76%;"><?=$kegiatan['kegiatan'];?></td>
                    </tr>
                    <tr>
                        <td>Tipe Kegiatan</td>
                        <td>:</td>
                        <td><?=$tipe_kegiatan['tipe_kegiatan'];?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kegiatan</td>
                        <td>:</td>
                        <td><?=$jenis_kegiatan['jenis_kegiatan'];?></td>
                    </tr>
                    <tr>
                        <td>Publik</td>
                        <td>:</td>
                        <td><?=$kegiatan['is_private'] == 1?'Tidak':'Ya';?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Mulai</td>
                        <td>:</td>
                        <td><?=$this->functions->convert_date_indo(array('datetime' => $kegiatan['tanggal_mulai']));?> <?=$kegiatan['waktu_mulai'];?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Akhir</td>
                        <td>:</td>
                        <td><?=$this->functions->convert_date_indo(array('datetime' => $kegiatan['tanggal_akhir']));?> <?=$kegiatan['waktu_akhir'];?></td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>:</td>
                        <td><?=$kegiatan['lokasi'];?></td>
                    </tr>
                    <tr>
                        <td>Keterangan Kegiatan</td>
                        <td>:</td>
                        <td><?=$kegiatan['keterangan'];?></td>
                    </tr>
                    <tr>
                        <td>PIC</td>
                        <td>:</td>
                        <td><?=$kegiatan['pic'];?></td>
                    </tr>
                    <tr>
                        <td>MAK</td>
                        <td>:</td>
                        <td><?=$kegiatan['mak'];?></td>
                    </tr>
                    <tr>
                        <td>Deskripsi MAK</td>
                        <td>:</td>
                        <td><?=$kegiatan['deskripsi_mak'];?></td>
                    </tr>
                    <tr>
                        <td>Nama Pembuat</td>
                        <td>:</td>
                        <td><?=$user['nama'];?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?=$user['email'];?></td>
                    </tr>
                    <tr>
                        <td>Unit Kerja</td>
                        <td>:</td>
                        <td><?=$user['unit_kerja'];?></td>
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
                            <?php if(count($list_peserta) > 0): $i=1; ?>
                                <?php foreach($list_peserta as $v): ?>
                                    <tr>
                                        <td><?=$i;?></td>
                                        <td><?=$v['nm_peserta'];?></td>
<!--                                        <td>--><?//=$v['nm_instansi'];?><!--</td>-->
                                        <td><?php
                                            if($v['pegawai_id']){
                                                echo 'Bekraf';
                                            }elseif($v['peserta_eksternal_id']){
                                                echo 'Non-Bekraf';
                                            }else{
                                                echo $v['nm_instansi'];
                                            }
                                            ?></td>
                                        <td><?=$v['golongan'];?></td>
                                        <td><?=$v['jabatan'];?></td>
                                        <td><?=$v['status_peserta'];?></td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" class="btn-view-peserta" data-jenis-kegiatan-id="<?=$kegiatan['jenis_kegiatan_id'];?>" data-title="<?=strtoupper($kegiatan['kegiatan']);?>" data-id="<?=encode($v['peserta_kegiatan_id']);?>"><i class="icon-eye" data-popup="tooltip-custom" title="Lihat Data Peserta"></i></a></li>
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
                url: "<?=base_url('kegiatan/peserta_view');?>",
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
</script>