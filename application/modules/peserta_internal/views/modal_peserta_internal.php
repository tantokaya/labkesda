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
    						<td style="width: 28%;">NIP</td>
	                        <td style="width: 1%;">:</td>
	                        <td style="width: 76%;"><?=$pegawai['nip'];?></td>
    					</tr>
    					<tr>
    						<td>NIP Lama</td>
    						<td>:</td>
    						<td><?=$pegawai['nip_lama']?></td>
    					</tr>
    					<tr>
    						<td>NPWP</td>
    						<td>:</td>
    						<td><?=$pegawai['no_npwp']?></td>
    					</tr>
    					<tr>
    						<td>Nama</td>
    						<td>:</td>
    						<td><?=$pegawai['gelar_depan']?> <?=$pegawai['nm_pegawai']?> <?=$pegawai['gelar_belakang']?></td>
    					</tr>
    					<tr>
    						<td>Tempat, Tanggal Lahir</td>
    						<td>:</td>
    						<td><?=$pegawai['tempat_lahir']?>, <?=$this->functions->convert_date_indo(array('datetime' => $pegawai['tanggal_lahir']))?></td>
    					</tr>
    					<tr>
    						<td>Alamat</td>
    						<td>:</td>
    						<td><?=$pegawai['alamat']?></td>
    					</tr>
    					<tr>
    						<td>Status Pegawai</td>
    						<td>:</td>
    						<td>
    							<?php 
    								foreach($l_speg as $t):
    									if($pegawai['status_pegawai_id'] == $t['status_pegawai_id']):
    										echo $t['status_pegawai'];
    									endif;
									endforeach;
    							?>
    						</td>
    					</tr>
    					<tr>
    						<td>Status Jabatan</td>
    						<td>:</td>
    						<td>
    							<?php 
    								foreach($l_sjab as $t):
    									if($pegawai['status_jabatan_id'] == $t['status_jabatan_id']):
    										echo $t['status_jabatan'];
    									endif;
									endforeach;
    							?>
    						</td>
    					</tr>
    					<tr>
    						<td>Eselon</td>
    						<td>:</td>
    						<td>
    							<?php 
    								foreach($l_eselon as $t):
    									if($pegawai['eselon_id'] == $t['eselon_id']):
    										echo $t['eselon'];
    									endif;
									endforeach;
    							?>
    						</td>
    					</tr>
    					<tr>
    						<td>Pangkat/Golongan</td>
    						<td>:</td>
    						<td>
    							<?php 
    								foreach($l_golongan as $t):
    									if($pegawai['golongan_id'] == $t['golongan_id']):
    										echo $t['golongan'];
    									endif;
									endforeach;
    							?>
    						</td>
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
    							if($pegawai['pegawai_id'] == $t['pegawai_id']):?>
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