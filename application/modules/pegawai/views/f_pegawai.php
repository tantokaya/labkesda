<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-user-tie position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Master</li>
            <li>Kepegawaian</li>
            <li><a href="<?=base_url('pegawai');?>">Pegawai</a></li>
            <li class="active"><?=$page_title;?></li>
        </ul>
    </div>
</div>

<div class="container-fluid page-content">

    <?php if(validation_errors()): ?>
        <div class="alert bg-danger">
            <span class="text-semibold"><?=validation_errors();?></span>
        </div>
    <?php endif; ?>

    <div class="panel panel-default panel-bordered">
        <div class="panel-heading">
            <h5 class="panel-title"><i class="icon-three-bars position-left"></i> <?=$page_title;?></h5>
        </div>
        <div class="panel-body">
            <?=form_open('', array('id' => 'frm-pegawai','class' => 'form-horizontal'));?>

            <input type="hidden" id="prop_id_tmp" name="prop_id_tmp" value="<?=set_value('prop_id_tmp');?>">
            <input type="hidden" id="kota_id_tmp" name="kota_id_tmp" value="<?=set_value('kota_id_tmp');?>">

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-4">NIP <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="nip" name="nip" maxlength="18" placeholder="Nomor Induk Pegawai..." value="<?=isset($pegawai['nip'])?$pegawai['nip']:set_value('nip');?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Gelar Depan</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="gelar_depan" name="gelar_depan" placeholder="Gelar Depan..." value="<?=isset($pegawai['gelar_depan'])?$pegawai['gelar_depan']:set_value('gelar_depan');?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Nama Pegawai <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="nm_pegawai" name="nm_pegawai" placeholder="Nama Pegawai..." value="<?=isset($pegawai['nm_pegawai'])?$pegawai['nm_pegawai']:set_value('nm_pegawai');?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Gelar Belakang</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="gelar_belakang" name="gelar_belakang" placeholder="Gelar Belakang..." value="<?=isset($pegawai['gelar_belakang'])?$pegawai['gelar_belakang']:set_value('gelar_belakang');?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Jenis Kelamin <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <?php foreach($l_jenis_kelamin as $t): ?>
                                <?php if(isset($pegawai['jenis_kelamin_id']) && $pegawai['jenis_kelamin_id'] == $t['jenis_kelamin_id']) : ?>
                                    <label class="radio-inline">
                                        <input type="radio" name="jenis_kelamin_id" value="<?=$t['jenis_kelamin_id'];?>" checked> <?=$t['jenis_kelamin'];?>
                                    </label>
                                <?php else : ?>
                                    <label class="radio-inline">
                                        <input type="radio" name="jenis_kelamin_id" value="<?=$t['jenis_kelamin_id'];?>" <?=set_radio('jenis_kelamin_id', $t['jenis_kelamin_id']);?>> <?=$t['jenis_kelamin'];?>
                                    </label>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Tempat Lahir <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir..." value="<?=isset($pegawai['tempat_lahir'])?$pegawai['tempat_lahir']:set_value('tempat_lahir');?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Tanggal Lahir <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?=isset($pegawai['tanggal_lahir'])?$this->functions->convert_date_indo(array('datetime' => $pegawai['tanggal_lahir'])):'';?>" placeholder="" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Alamat</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="alamat" name="alamat"><?=isset($pegawai['alamat'])?$pegawai['alamat']:set_value('alamat');?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-4">No Telepon</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="No Telepon..." value="<?=isset($pegawai['no_telepon'])?$pegawai['no_telepon']:set_value('no_telepon');?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-4">NIP Lama</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="nip_lama" name="nip_lama" placeholder="NIP Lama..." value="<?=isset($pegawai['nip_lama'])?$pegawai['nip_lama']:set_value('nip_lama');?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">No. NPWP</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="no_npwp" name="no_npwp" placeholder="No. NPWP..." value="<?=isset($pegawai['no_npwp'])?$pegawai['no_npwp']:set_value('no_npwp');?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Nomor Kartu Pegawai</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="no_kartu_pegawai" name="no_kartu_pegawai" placeholder="Nomor Kartu Pegawai (Karpeg)..." value="<?=isset($pegawai['no_kartu_pegawai'])?$pegawai['no_kartu_pegawai']:set_value('no_kartu_pegawai');?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Agama <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <select class="select" style="width: 100%;" data-placeholder="-- Pilih Agama --" name="agama_id" id="agama_id" required>
                                <option></option>
                                <?php foreach($l_agama as $t): ?>
                                    <?php if(isset($pegawai['agama_id']) && $pegawai['agama_id'] == $t['agama_id']): ?>
                                        <option value="<?=$t['agama_id'];?>" selected><?=$t['agama'];?></option>
                                    <?php else : ?>
                                        <option value="<?=$t['agama_id'];?>" <?=set_select('agama_id', $t['agama_id'])?>><?=$t['agama'];?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Status Pegawai <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <select class="select" style="width: 100%;" data-placeholder="-- Pilih Status Pegawai --" name="status_pegawai_id" id="status_pegawai_id" required>
                                <option></option>
                                <?php foreach($l_speg as $t): ?>
                                    <?php if(isset($pegawai['status_pegawai_id']) && $pegawai['status_pegawai_id'] == $t['status_pegawai_id']): ?>
                                        <option value="<?=$t['status_pegawai_id'];?>" selected><?=$t['status_pegawai'];?></option>
                                    <?php else : ?>
                                        <option value="<?=$t['status_pegawai_id'];?>" <?=set_select('status_pegawai_id', $t['status_pegawai_id'])?>><?=$t['status_pegawai'];?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Status Jabatan <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <select class="select" style="width: 100%;" data-placeholder="-- Pilih Status Jabatan --" name="status_jabatan_id" id="status_jabatan_id" required>
                                <option></option>
                                <?php foreach($l_sjab as $t): ?>
                                    <?php if(isset($pegawai['status_jabatan_id']) && $pegawai['status_jabatan_id'] == $t['status_jabatan_id']): ?>
                                        <option value="<?=$t['status_jabatan_id'];?>" selected><?=$t['status_jabatan'];?></option>
                                    <?php else : ?>
                                        <option value="<?=$t['status_jabatan_id'];?>" <?=set_select('status_jabatan_id', $t['status_jabatan_id'])?>><?=$t['status_jabatan'];?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Eselon <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <select class="select" style="width: 100%;" data-placeholder="-- Pilih Eselon --" name="eselon_id" id="eselon_id" required>
                                <option></option>
                                <?php foreach($l_eselon as $t): ?>
                                    <?php if(isset($pegawai['eselon_id']) && $pegawai['eselon_id'] == $t['eselon_id']): ?>
                                        <option value="<?=$t['eselon_id'];?>" selected><?=$t['eselon'];?></option>
                                    <?php else : ?>
                                        <option value="<?=$t['eselon_id'];?>" <?=set_select('eselon_id', $t['eselon_id'])?>><?=$t['eselon'];?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Pangkat / Golongan <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <select class="select" style="width: 100%;" data-placeholder="-- Pilih Pangkat/Golongan --" name="golongan_id" id="golongan_id" required>
                                <option></option>
                                <?php foreach($l_golongan as $t): ?>
                                    <?php if(isset($pegawai['golongan_id']) && $pegawai['golongan_id'] == $t['golongan_id']): ?>
                                        <option value="<?=$t['golongan_id'];?>" selected><?=$t['deskripsi'];?> (<?=$t['golongan'];?>)</option>
                                    <?php else : ?>
                                        <option value="<?=$t['golongan_id'];?>" <?=set_select('golongan_id', $t['golongan_id'])?>><?=$t['deskripsi'];?> (<?=$t['golongan'];?>)</option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Email </label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email..." value="<?=isset($pegawai['email'])?$pegawai['email']:set_value('email');?>" required>
                        </div>
                    </div>

                </div>
            </div>

            <?=form_close();?>
        </div>
        <div class="panel-footer">
            <div class="elements">
                <button type="button" class="btn btn-info btn-save"><i class="icon-floppy-disk position-left"></i> Simpan</button>
            </div>
            <a class="elements-toggle"><i class="icon-more"></i></a>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?=base_url('assets/js/moment.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/legacy.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/daterangepicker.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/picker.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/picker.date.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/picker.time.js');?>"></script>

<script type="text/javascript">
    $(function(){
        $('.btn-save').on('click', function(e){
            e.preventDefault();
            $('#frm-pegawai').submit();
        });

        $('#tanggal_lahir').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY'
            },
            maxDate: moment(),
            opens: 'right'
        });

        $('.select').select2({width: 'resolve'});

    });
</script>


