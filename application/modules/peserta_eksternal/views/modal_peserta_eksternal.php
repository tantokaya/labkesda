<script type="text/javascript" src="<?=base_url('assets/js/tables/footable.min.js');?>"></script>
<div class="tabbable">
    <ul class="nav nav-tabs nav-tabs-highlight nav-bordered tab-menu" id="tab-profile">
        <li class="active"><a href="#profile-tab" data-toggle="tab" aria-expanded="true"><i class="icon-user-tie position-left"></i> Profile</a></li>
        <li><a href="#keikut-sertaan-tab" data-toggle="tab" aria-expanded="false"><i class="icon-cloud-upload2 position-left"></i> Keikut Sertaan</a></li>
    </ul>

    <div class="tab-content">
    	<div class="tab-pane active" id="profile-tab">
    		<div class="table-responsive">
    			<table class="table table-striped">
    				<tbody>
                        <tr>
                            <td style="width: 28%;">Nama</td>
                            <td style="width: 1%;">:</td>
                            <td style="width: 76%;"><?=$peserta_eksternal['nm_peserta'];?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?=$peserta_eksternal['email']?></td>
                        </tr>
                        <tr>
                            <td>Instansi</td>
                            <td>:</td>
                            <td><?=$peserta_eksternal['nm_instansi']?></td>
                        </tr>
                        <tr>
                            <td>Golongan</td>
                            <td>:</td>
                            <td><?=$peserta_eksternal['golongan']?></td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td><?=$peserta_eksternal['jabatan']?></td>
                        </tr>
                        <tr>
                            <td>NPWP</td>
                            <td>:</td>
                            <td><?=$peserta_eksternal['no_npwp']?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?=$peserta_eksternal['alamat']?></td>
                        </tr>
                        <tr>
                            <td>No Telp/HP</td>
                            <td>:</td>
                            <td><?=$peserta_eksternal['no_telepon']?></td>
                        </tr>
                    </tbody>
    			</table>
    		</div>
    	</div>
    	<div class="tab-pane" id="keikut-sertaan-tab">
    		<div class="table-responsive">
    			<h3>Jumlah Kegiatan <span class="label label-primary"><?=$jumlah_kegiatan?></span></h3>
    			<table class="table table-striped">
    				<thead>
    					<tr>
    						<th>Kegiatan</th>
                            <th>Nama Kegiatan</th>
    						<th>Tanggal</th>
    						<th>Status</th>
    					</tr>
    				</thead>
    				<tbody>
                        <?php if($cek->num_rows() > 0):?>
                            <?php foreach($l_jenis_kegiatan as $t):
                                    if($peserta_eksternal['peserta_eksternal_id'] == $t['peserta_eksternal_id']):
                            ?>
                                <tr>
                                    <td><?=$t['jenis_kegiatan']?></td>
                                    <td><?=$t['kegiatan']?></td>
                                    <td><?=$this->functions->convert_date_indo(array('datetime' => $t['tanggal_mulai']))?></td>
                                    <td><?=$t['status_peserta']?></td>
                                </tr>
                            <?php endif; endforeach; ?>
                        <?php else:?>
                            <tr>
                                <td colspan="4" class="text-center">Belum pernah mengikuti kegiatan</td>
                            </tr>
                        <?php endif;?>
                    </tbody>
    			</table>
    		</div>
    	</div>
    </div>

</div>