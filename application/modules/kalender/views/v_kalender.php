<style type="text/css">
    .fc-day-grid-event > .fc-content {
        white-space: nowrap;
        overflow: hidden;
    }

    .modal-open {
        overflow: hidden;
        position:fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        height: 100%;
    }
</style>

<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-calendar52 position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Kegiatan</li>
            <li class="active"><?=$page_title;?></li>
        </ul>
    </div>
</div>

<div class="container-fluid page-content">
    <div class="panel panel-flat panel-collapsed">
        <div class="panel-heading">
            <h5 class="panel-title"><i class="icon-filter4 postition-left"></i> Filter Data <small>Kegiatan</small></h5>
            <div class="elements">
                <ul class="icons-list">
                    <li><a data-action="collapse" id="filter-collapse" data-popup="tooltip" title="" data-original-title="Filter Kegiatan" class="rotate-180"></a></li>
                </ul>
            </div>
            <a class="elements-toggle"><i class="icon-more"></i></a></div>
        <div class="panel-body" style="display: none;">
            <?=form_open('kegiatan/dt_kegiatan', array('id' => 'frm-filter'));?>
            <div class="form-group m-b-5">
                <select name="eselon1" class="select" data-placeholder="Kepala / Eselon I" id="eselon1" data-width="100%">
                    <option value=""></option>
                    <?php foreach($eselon1 as $t) : ?>
                        <?php if(isset($user['eselon1']) && $user['eselon1'] == $t['kd_satker']) : ?>
                            <option value="<?=$t['kd_satker'];?>" selected><?=$t['satker'];?></option>
                        <?php else : ?>
                            <option value="<?=$t['kd_satker'];?>"><?=$t['satker'];?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group m-b-5">
                <select name="eselon2" class="select" data-placeholder="Eselon II" id="eselon2" data-width="100%">
                    <?php if(isset($eselon2)) : ?>
                        <?=$eselon2;?>
                    <?php else : ?>
                        <option value=""></option>
                    <?php endif;?>
                </select>
            </div>

            <div class="form-group m-b-5">
                <select name="eselon3" class="select" data-placeholder="Eselon III" id="eselon3" data-width="100%">
                    <?php if(isset($eselon3)) : ?>
                        <?=$eselon3;?>
                    <?php else : ?>
                        <option value=""></option>
                    <?php endif;?>
                </select>
            </div>

            <div class="form-group m-b-5">
                <select name="eselon4" class="select" data-placeholder="Eselon IV" id="eselon4" data-width="100%">
                    <?php if(isset($eselon4)) : ?>
                        <?=$eselon4;?>
                    <?php else : ?>
                        <option value=""></option>
                    <?php endif;?>
                </select>
            </div>
            <input type="hidden" name="filter" id="filter" value="<?=$this->session->unit_kerja;?>" />
            <input type="hidden" name="eselon" id="eselon" value="<?=isset($user['eselon'])?$user['eselon']:'';?>" />
            <?=form_close();?>
        </div>
        <div class="modal-footer no-padding-top">
            <button type="button" id="submit_filter" class="btn bg-blue btn-sm btn-labeled"><b><i class="icon-filter4"></i></b>Simpan Filter</button>
        </div>
    </div>

    <div class="panel panel-default panel-bordered">
        <div class="panel-heading">
            <h5 class="panel-title"><i class="icon-three-bars position-left"></i> <?=$panel_title;?></h5>
        </div>

        <div class="panel-body">
            <div class="row-fluid page-content table-responsive">
                <div class="col-md-2 col-sm-3">
                    <div id="external-events">
                        <h6>Jenis Kegiatan</h6>
                        <div class="fc-events-container">
                            <?php foreach($l_jenis_kegiatan as $t): ?>
                                <div class="fc-event" data-color="<?=$t['warna_jenis_kegiatan'];?>" data-jenis-kegiatan-id="<?=$t['jenis_kegiatan_id'];?>"><?=$t['jenis_kegiatan'];?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <br/>
                    <div id="trash">
                        <h6>Hapus Kegiatan</h6>
                        <div class="fc-events-container" id="trash">
                            <div class="alert bg-danger">
                                <span class="text-semibold"><i class="icon-close2 position-left"></i>Drag Disini</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-10 col-sm-9">
                    <div class="fullcalendar-external"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="mdl_kegiatan" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal_title_kegiatan" class="modal-title"></h4>
            </div>
            <div class="modal-body" id="modal_content_kegiatan"></div>
            <div class="modal-footer no-padding-top">
                <button type="button" id="simpan-kegiatan" class="btn bg-blue btn-sm btn-labeled"><b><i class="icon-floppy-disk"></i></b>Simpan</button>
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="mdl_undangan" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal_title_undangan" class="modal-title"></h4>
            </div>
            <div class="modal-body" id="modal_content_undangan"></div>
            <div class="modal-footer no-padding-top">
                <button type="button" id="simpan-peserta" class="btn bg-blue btn-sm btn-labeled"><b><i class="icon-floppy-disk"></i></b>Simpan</button>
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?=base_url('assets/js/sweetalert.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/full.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/interactions.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/fullcalendar-3.1.0/lib/moment.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/fullcalendar-3.1.0/fullcalendar.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/fullcalendar-3.1.0/locale/id.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/legacy.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/daterangepicker.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/picker.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/picker.date.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/picker.time.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/id_ID.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/fileinput.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/tokenfield.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/tables/footable.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/pnotify.min.js');?>"></script>

<script type="text/javascript">
    var sess_id = '<?=$this->session->user_id;?>', baseUrl = '<?=base_url();?>';
    $(function() {
        $('.select').select2({allowClear: true});

        $('#eselon1').on('change', function (e) {
            get_list_eselon2($(this).val());
        });

        $('#eselon2').on('change', function (e) {
            get_list_eselon3($(this).val());
        });

        $('#eselon3').on('change', function (e) {
            get_list_eselon4($(this).val());
        });

        function get_list_eselon2(id) {
            $.ajax({
                type: "POST",
                data: {id: id},
                url: "<?=base_url('kegiatan/get_list_eselon2');?>",
                success: function (r) {
                    $('#eselon2').html(r).trigger('change');
                }
            })
        }

        function get_list_eselon3(id) {
            $.ajax({
                type: "POST",
                data: {id: id},
                url: "<?=base_url('kegiatan/get_list_eselon3');?>",
                success: function (r) {
                    $('#eselon3').html(r).trigger('change');
                }
            })
        }

        function get_list_eselon4(id) {
            $.ajax({
                type: "POST",
                data: {id: id},
                url: "<?=base_url('kegiatan/get_list_eselon4');?>",
                success: function (r) {
                    $('#eselon4').html(r).trigger('change');
                }
            })
        }
    });
</script>
<script type="text/javascript" src="<?=base_url('assets/js/app/kalender.js');?>"></script>

