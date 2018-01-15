<script type="text/javascript">
    $(document).ready(function() {

        $("#pelanggan-detail").hide();
        $("#tbl_pelanggan_hide").hide();

        $("#tbl_pelanggan_hide").click(function() {
            $("#tabel").show();
            $("#tbl_pelanggan_show").show();
            $("#tbl_pelanggan_hide").hide();
            $("#pelanggan-detail").hide();
        })

        $("#tbl_pelanggan_show").click(function() {
            $("#tabel").hide();
            $("#tbl_pelanggan_show").hide();
            $("#tbl_pelanggan_hide").show();
            $("#pelanggan-detail").show();
            $("#nm_lengkap").focus();
        })

        $(".back").click(function(){
            window.location.href='<?= base_url('pos'); ?>'
        });
    });
</script>
<div class="pos-content">
    <div class="window">
        <div class="subwindow">
            <div class="subwindow-container">
                <div class="subwindow-container-fix screens">
                    <div class="clientlist-screen screen">
                        <div class="screen-content">
                            <section class="top-content">
                          <span class="button back">
                            <i class="fa fa-angle-double-left"></i>
                            Batalkan
                          </span>
                          <span class="button new-customer" id="tbl_pelanggan_show">
                            <i class="fa fa-user"></i>
                            <i class="fa fa-plus" ></i>
                          </span>
                          <span class="button new-customer" id="tbl_pelanggan_hide">
                            <i class="fa fa-user"></i>
                            <i class="fa fa-plus" ></i>
                          </span>
                            </section>
                            <section class="full-content">
                                <div class="window">
                                    <section class="subwindow collapsed" id="pelanggan-detail">
                                        <div class="subwindow-container collapsed">
                                            <div class="subwindow-container-fix client-details-contents">
                                                <?=form_open('', array('id' => 'frm-pelanggan'));?>
                                                <section class="client-details edit">
                                                    <div class="client-picture">
                                                        <i class="fa fa-camera"></i>
                                                        <!--<input class="image-uploader" type="file">-->
                                                    </div>
                                                    <input class="client-name" id="nm_lengkap" name="nm_lengkap" value="<?=isset($pelanggan['nm_lengkap'])?$pelanggan['nm_lengkap']:set_value('nm_lengkap');?>">
                                                    <div class="edit-buttons">
                                                        <!--<div class="button undo">
                                                            <i class="fa fa-undo">
                                                            </i>
                                                        </div>-->
                                                        <div class="button save btn-save">
                                                            <i class="fa fa-floppy-o">
                                                            </i>
                                                        </div>
                                                    </div>
                                                    <div class="client-details-box clearfix">
                                                        <div class="client-details-left">
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">NIK</span>
                                                                <input style="width: 40%" name="nik" id="nik" placeholder="..." value="<?=isset($pelanggan['nik'])?$pelanggan['nik']:set_value('nik');?>">
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">Tmp Lahir</span>
                                                                <input style="width: 40%" name="tmp_lahir" placeholder="..." value="<?=isset($pelanggan['tmp_lahir'])?$pelanggan['tmp_lahir']:set_value('tmp_lahir');?>">
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">Tgl Lahir</span>
                                                                <input style="width: 25%" name="tgl_lahir" id="tgl_lahir" value="<?=isset($pelanggan['tgl_lahir'])?$this->functions->convert_date_indo(array('datetime' => $pelanggan['tgl_lahir'])):'';?>">
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">Agama</span>
                                                                <select style="height: 35px;"data-placeholder="-- Pilih Agama --" name="agama_id" id="agama_id" required>
                                                                    <option></option>
                                                                    <?php foreach($l_agama as $t): ?>
                                                                        <?php if(isset($pelanggan['agama_id']) && $pelanggan['agama_id'] == $t['agama_id']): ?>
                                                                            <option value="<?=$t['agama_id'];?>" selected><?=$t['agama'];?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?=$t['agama_id'];?>" <?=set_select('agama_id', $t['agama_id'])?>><?=$t['agama'];?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">L / P</span>
                                                                <?php foreach($l_jenis_kelamin as $t): ?>
                                                                    <?php if(isset($pelanggan['jenis_kelamin_id']) && $pelanggan['jenis_kelamin_id'] == $t['jenis_kelamin_id']) : ?>
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
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">Alamat</span>
                                                                <input class="" name="alamat" placeholder="..." value="<?=isset($pelanggan['alamat'])?$pelanggan['alamat']:set_value('alamat');?>">
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">Propinsi</span>
                                                                <?php $pelanggan['propinsi_id'] = isset($pelanggan['propinsi_id'])?$pelanggan['propinsi_id']:''; ?>
                                                                <select name="propinsi_id" style="height: 35px;" id="propinsi_id" style="width:100%" class="populate" required>
                                                                    <option></option>
                                                                    <?php foreach($l_propinsi as $t): ?>
                                                                        <?php if($pelanggan['propinsi_id']==$t->propinsi_id): ?>
                                                                            <option value="<?php echo $t->propinsi_id;?>" selected="selected"><?php echo $t->propinsi;?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?php echo $t->propinsi_id;?>"><?php echo $t->propinsi;?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">Kota</span>
                                                                <select name="kota_id" id="kota_id" style="height:35px"  required>
                                                                    <option></option>
                                                                    <?php if(isset($l_kota)): ?>
                                                                        <?php foreach($l_kota as $t): ?>
                                                                            <?php if($pelanggan['kota_id']==$t->kota_id): ?>
                                                                                <option value="<?php echo $t->kota_id;?>" selected="selected"><?php echo $t->kota;?></option>
                                                                            <?php else : ?>
                                                                                <option value="<?php echo $t->kota_id;?>"><?php echo $t->kota;?></option>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">Kecamatan</span>
                                                                <select name="kecamatan_id" id="kecamatan_id" style="height: 35px" required>
                                                                    <option></option>
                                                                    <?php if(isset($l_kecamatan)): ?>
                                                                        <?php foreach($l_kecamatan as $t): ?>
                                                                            <?php if($pelanggan['kecamatan_id']==$t->kecamatan_id): ?>
                                                                                <option value="<?php echo $t->kecamatan_id;?>" selected="selected"><?php echo $t->kecamatan;?></option>
                                                                            <?php else : ?>
                                                                                <option value="<?php echo $t->kecamatan_id;?>"><?php echo $t->kecamatan;?></option>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium; width: 20%;">Kelurahan</span>
                                                                <select name="kelurahan_id" id="kelurahan_id" style="height: 35px" required>
                                                                    <option></option>
                                                                    <?php if(isset($l_kelurahan)): ?>
                                                                        <?php foreach($l_kelurahan as $t): ?>
                                                                            <?php if($pelanggan['kelurahan_id']==$t->kelurahan_id): ?>
                                                                                <option value="<?php echo $t->kelurahan_id;?>" selected="selected"><?php echo $t->kelurahan;?></option>
                                                                            <?php else : ?>
                                                                                <option value="<?php echo $t->kelurahan_id;?>"><?php echo $t->kelurahan;?></option>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="client-details-right">
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium; width: 20%">No KK</span>
                                                                <input class="detail" style="width: 40%" placeholder="..." name="no_kk" type="no_kk" value="<?=isset($pelanggan['no_kk'])?$pelanggan['no_kk']:set_value('no_kk');?>">
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium; width: 20%">Nama KK</span>
                                                                <input class="detail" style="width: 40%" name="nm_kk" type="text" value="<?=isset($pelanggan['nm_kk'])?$pelanggan['nm_kk']:set_value('nm_kk');?>">
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium; width: 20%">Goldar</span>
                                                                <select style="height: 35px; width: 20%"data-placeholder="-- Pilih Goldar --" name="goldar_id" id="goldar_id" required>
                                                                    <option></option>
                                                                    <?php foreach($l_goldar as $t): ?>
                                                                        <?php if(isset($pelanggan['goldar_id']) && $pelanggan['goldar_id'] == $t['goldar_id']): ?>
                                                                            <option value="<?=$t['goldar_id'];?>" selected><?=$t['goldar_nama'];?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?=$t['goldar_id'];?>" <?=set_select('goldar_id', $t['goldar_id'])?>><?=$t['goldar_nama'];?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium; width: 20%">Pendidikan</span>
                                                                <select style="height: 35px; width: 30%"data-placeholder="-- Pilih Pendidikan --" name="pendidikan_id" id="pendidikan_id" required>
                                                                    <option></option>
                                                                    <?php foreach($l_pendidikan as $t): ?>
                                                                        <?php if(isset($pelanggan['pendidikan_id']) && $pelanggan['pendidikan_id'] == $t['pendidikan_id']): ?>
                                                                            <option value="<?=$t['pendidikan_id'];?>" selected><?=$t['pendidikan_nama'];?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?=$t['pendidikan_id'];?>" <?=set_select('pendidikan_id', $t['pendidikan_id'])?>><?=$t['pendidikan_nama'];?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium; width: 20%">Pekerjaan</span>
                                                                <select style="height: 35px;"data-placeholder="-- Pilih Pekerjaan --" name="pekerjaan_id" id="pekerjaan_id" required>
                                                                    <option></option>
                                                                    <?php foreach($l_pekerjaan as $t): ?>
                                                                        <?php if(isset($pelanggan['pekerjaan_id']) && $pelanggan['pekerjaan_id'] == $t['pekerjaan_id']): ?>
                                                                            <option value="<?=$t['pekerjaan_id'];?>" selected><?=$t['pekerjaan_nama'];?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?=$t['pekerjaan_id'];?>" <?=set_select('pekerjaan_id', $t['pekerjaan_id'])?>><?=$t['pekerjaan_nama'];?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium; width: 20%">Status</span>
                                                                <select style="height: 35px; width: 30%"data-placeholder="-- Pilih Status --" name="stmarital_id" id="stmarital_id" required>
                                                                    <option></option>
                                                                    <?php foreach($l_stmarital as $t): ?>
                                                                        <?php if(isset($pelanggan['stmarital_id']) && $pelanggan['stmarital_id'] == $t['stmarital_id']): ?>
                                                                            <option value="<?=$t['stmarital_id'];?>" selected><?=$t['stmarital_nama'];?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?=$t['stmarital_id'];?>" <?=set_select('stmarital_id', $t['stmarital_id'])?>><?=$t['stmarital_nama'];?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <?=form_close();?>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="subwindow" id="tabel">
                                        <div class="subwindow-container">
                                            <?php echo $this->table->generate(); ?>

                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    var oTable = $('#tbl-pelanggan').dataTable( {
                                                        "bProcessing": true,
                                                        "bServerSide": true,
                                                        "sAjaxSource": '<?php echo base_url('pelanggan/dt_pelanggan'); ?>',
                                                        "bAutoWidth": false,
                                                        "sPaginationType": "full_numbers",
                                                        "bSort": true,
                                                        "dom": '<"datatable-header"fl><"datatable-scroll-lg"t><"datatable-footer"ip>',
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
                                                            {"data":"nik", "sName":"nik"},
                                                            {"data":"kd_rekmed", "sName":"kd_rekmed"},
                                                            {"data":"nm_lengkap", "sName":"nm_lengkap"},
                                                            {"data":"tgl_lahir", "sName":"tgl_Lahir"},
                                                            {"data":"alamat", "sName":"alamat"},

                                                        ],
                                                        "aoColumnDefs": [
                                                            {
                                                                'bSortable': true,
                                                                'bSearchable':true,
                                                                'aTargets': [ -1 ]
                                                            }
                                                        ],
                                                        "fnServerData": function(sSource, aoData, fnCallback)
                                                        {

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
                                            </script>
                                        </div>
                                    </section>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url('assets/js/moment.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/legacy.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/daterangepicker.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/picker.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/picker.date.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/picker.time.js');?>"></script>

<script type="text/javascript">
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

    $(document).ready(function(){

        $('.btn-save').on('click', function(e){
            e.preventDefault();
            $('#frm-pelanggan').submit();
        });

        $('#tgl_lahir').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY'
            },
            maxDate: moment(),
            opens: 'right'
        });

        $('#propinsi_id').on('change', function(){
            var prop_id = $(this).val();

            $('#kota_id').html('');
            $('#kecamatan_id').html('');
            $('#kelurahan_id').html('');

            getListKota(prop_id);
        });

        $('#kota_id').on('change', function(){
            var kota_id = $(this).val();

            $('#kecamatan_id').html('');
            $('#kelurahan_id').html('');

            getListKecamatan(kota_id);
        });

        $('#kecamatan_id').on('change', function(){
            var kecamatan_id = $(this).val();

            $('#kelurahan_id').html('');

            getListKelurahan(kecamatan_id);
        });

        $('#kelurahan_id').on('change', function(){
            var kelurahan_id = $(this).val();

            if(kelurahan_id != null && kelurahan_id.length == 10){
                getWilayahKerja(kelurahan_id);
            }
        });

        function getListKota(prop_id, kota_id = null){
            $.ajax({
                type: 'POST',
                url: baseUrl+'/pelanggan/get_list_kota',
                data: 'propinsi_id='+prop_id,
                success: function(res){
                    $('#kota_id').html(res);
                    if(kota_id != null){
                        $('#kota_id').select('val', kota_id);
                    }
                },
                error: function(e){
                    console.log('Error: '+e);
                }
            });
        }

        function getListKecamatan(kota_id, kecamatan_id = null){
            $.ajax({
                type: 'POST',
                url: baseUrl+'/pelanggan/get_list_kecamatan',
                data: 'kota_id='+kota_id,
                success: function(res){
                    $('#kecamatan_id').html(res);
                    if(kecamatan_id != null){
                        $('#kecamatan_id').select('val', kecamatan_id);
                    }
                },
                error: function(e){
                    console.log('Error: '+e);
                }
            });
        }

        function getListKelurahan(kecamatan_id, kelurahan_id = null){
            $.ajax({
                type: 'POST',
                url: baseUrl+'/pelanggan/get_list_kelurahan',
                data: 'kecamatan_id='+kecamatan_id,
                success: function(res){
                    $('#kelurahan_id').html(res);
                    if(kelurahan_id != null){
                        $('#kelurahan_id').select('val', kelurahan_id);
                    }

                    //if($('#kel_id_tmp').val())$('#kelurahan_id').val($('#kel_id_tmp').val()).trigger('change');
                },
                error: function(e){
                    console.log('Error: '+e);
                }
            });
        }

        function getWilayahKerja(kel_id){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: baseUrl+'/pelanggan/get_wilayah_kerja',
                data: 'kelurahan_id='+kel_id,
                success: function(res){
                    $('#wilayah_kerja').val(res.label);
                    $('#wilayah_kerja_id').val(res.value);
                },
                error: function(e){
                    console.log('Error: '+e);
                }
            });
        }
    });
</script>