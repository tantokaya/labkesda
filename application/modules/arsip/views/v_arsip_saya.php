<script type="text/javascript" src="<?=base_url('assets/js/tables/datatables/datatables.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/sweetalert.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/fileinput.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/pnotify.min.js');?>"></script>

<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-folder position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li class="active"><?=$page_title;?></li>
        </ul>
    </div>
</div>

<div class="container-fluid page-content">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title">Arsip</h5>
            <div class="elements panel-tabs">
                <ul class="nav nav-tabs nav-sm nav-tabs-bottom">
                    <li><a href="<?=base_url('arsip');?>"><i class="icon-folder-open position-left"></i> Arsip Publik</a></li>
                    <li class="active"><a href="#arsip-saya" data-toggle="tab""><i class="icon-folder position-left"></i> Arsip Saya</a></li>
                    <li><a href="<?=base_url('arsip/kegiatan');?>"><i class="icon-folder position-left"></i> Arsip Kegiatan</a></li>
                </ul>
            </div>
        </div>

        <div class="panel-tab-content tab-content">
            <div class="tab-pane active has-padding" id="arsip-saya">
                <button type="button" id="btn-add" class="btn btn-sm btn-info">Tambah <i class="icon icon-plus2"></i></button>&nbsp;
                <button type="button" id="btn-home" data-level="<?=$level;?>" data-parent="<?=$parent;?>" data-path="<?=$path;?>" class="btn btn-sm btn-info" data-popup="tooltip" title="Ke Home Folder"><i class="icon-home2"></i></button>&nbsp;
                <button type="button" id="btn-up" class="btn btn-sm btn-info" data-popup="tooltip" title="Naik satu folder"><i class="icon-folder-upload"></i></button>&nbsp;
                <input type="hidden" name="level" id="level" value="<?=$level;?>" />
                <input type="hidden" name="parent" id="parent" value="<?=$parent;?>" />
                <input type="hidden" name="path" id="path" value="<?=$path;?>" />

                <?php echo $this->table->generate(); ?>
            </div>
        </div>
    </div>
</div>

<div id="mdl_add" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal-title" class="modal-title">Tambah Data Arsip</h4>
            </div>
            <div class="modal-body">
                <?=form_open_multipart('arsip/save', array('id' => 'frm-add', 'class' => 'form-horizontal'));?>
                <input type="hidden" name="curr_parent" id="curr_parent">
                <input type="hidden" name="curr_level" id="curr_level">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Tipe Arsip <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input type="radio" name="tipe_arsip" class="form-control tipe_arsip" value="1" checked> Publik
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="tipe_arsip" class="form-control tipe_arsip" value="0"> Privasi Saya
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4">Jenis Arsip <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input type="radio" name="jenis_arsip" class="form-control jenis_arsip" value="0" checked> File
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="jenis_arsip" class="form-control jenis_arsip" value="1" > Folder
                                </label>
                            </div>
                        </div>
                        <div class="form-group file">
                            <div class="col-sm-12">
                                <input id="lampiran" name="lampiran[]" class="file-loading" type="file" multiple data-min-file-count="1">
                                <div id="kv-error-2" style="margin-top:10px;display:none"></div>
                                <div id="kv-success-2" class="alert alert-success fade in" style="margin-top:10px;display:none"></div>
                            </div>
                        </div>
                        <div class="form-group folder" style="display: none;">
                            <label class="control-label col-sm-4">Nama Folder <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="nm_folder" class="form-control" id="nm_folder" />
                            </div>
                        </div>
                        <div class="form-group folder" style="display: none;">
                            <label class="control-label col-sm-4">Deskripsi</label>
                            <div class="col-sm-8">
                                <textarea name="deskripsi" class="form-control" id="deskripsi"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?=form_close();?>
            </div>
            <div class="modal-footer">
                <button type="button" id="simpan-arsip" class="btn bg-blue btn-sm btn-labeled" style="display:none;"><b><i class="icon-floppy-disk"></i></b>Simpan</button>
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

<div id="mdl_rename" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal-title" class="modal-title">Ganti Nama Arsip</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Nama Arsip <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="hidden" name="rename_id" class="form-control" id="rename_id" />
                                <input type="text" name="rename" class="form-control" id="rename" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="simpan-rename" class="btn bg-blue btn-sm btn-labeled"><b><i class="icon-floppy-disk"></i></b>Perbaharui</button>
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

<div id="mdl_detail" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal-title" class="modal-title">Detail Arsip</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>


<script type="text/javascript">
    'use Strict';
    var oTable, baseUrl = '<?=base_url();?>', fspath = '<?=FSPATH.'arsip/';?>', user_id = '<?=$this->session->user_id;?>', lvl = '<?=$level;?>', pth = '<?=$path;?>', prn = '<?=$parent;?>';
    <?php if($this->session->flashdata('notif')): ?>
    swal("<?=$this->session->flashdata('notif');?>", "", "<?=$this->session->flashdata('type');?>");
    <?php endif; ?>
</script>
<script type="text/javascript" src="<?=base_url('assets/js/app/arsip_saya.js');?>"></script>

