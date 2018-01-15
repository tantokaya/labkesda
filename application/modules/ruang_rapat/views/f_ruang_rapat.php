<style type="text/css">
    .ui-autocomplete {
        position: absolute;
        top: 100%;
        left: 0;
        /*z-index: 1000;*/
        z-index: 999999 !important;
        float: left;
        display: none;
        min-width: 160px;
        _width: 160px;
        padding: 4px 12px;
        margin: 2px 0 0 0;
        list-style: none;
        background-color: #ffffff;
        border-color: #ccc;
        border-color: rgba(0, 0, 0, 0.2);
        border-style: solid;
        border-width: 1px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        -webkit-background-clip: padding-box;
        -moz-background-clip: padding;
        background-clip: padding-box;
        *border-right-width: 2px;
        *border-bottom-width: 2px;

    .ui-menu-item > a.ui-corner-all {
        display: block;
        padding: 15px 15px;
        clear: both;
        font-weight: normal;
        line-height: 18px;
        color: #555555;
        white-space: nowrap;

    &.ui-state-hover, &.ui-state-active {
                           color: #ffffff;
                           text-decoration: none;
                           background-color: #0088cc;
                           border-radius: 0px;
                           -webkit-border-radius: 0px;
                           -moz-border-radius: 0px;
                           background-image: none;
                       }
    }
    }
    .ui-autocomplete .highlight {
        text-decoration: underline;
        color: blue;
    }
</style>

<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-city position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li><a href="<?=base_url('ruang_rapat')?>">Jadwal Ruang Rapat</a></li>
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
        	<?=form_open('', array('id'=>'frm-ruang-rapat','class'=>'form-horizontal'))?>
        		<div class="form-group">
                <label class="control-label col-sm-2">Tanggal <span class="text-danger">*</span></label>
                <div class="col-sm-2">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        <input type="text" id="tanggal" name="tanggal" class="form-control" placeholder="Tanggal" value="<?=isset($ruang_rapat['tanggal'])?$ruang_rapat['tanggal']:set_value('tanggal');?>" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Ruang Rapat <span class="text-danger">*</span></label>
                <div class="col-sm-6">
                    <select class="select form-control" data-placeholder="-- Pilih Ruang Rapat --" id="ruang_id" name="ruang_id">
                        <option></option>
                        <?php foreach($ruang as $t): ?>
                        	<?php if(isset($ruang_rapat['ruang_id']) && $ruang_rapat['ruang_id'] == $t['ruang_id']):?>
                        		<option value="<?=$t['ruang_id'];?>" selected><?=$t['nama_ruang'];?> Lt.<?=$t['lantai'];?></option>
                        	<?php else:?>
                        		<option value="<?=$t['ruang_id'];?>" <?=set_select('ruang_id', $t['ruang_id'])?>><?=$t['nama_ruang'];?> Lt.<?=$t['lantai'];?></option>
                        	<?php endif;?>
                    	<?php endforeach;?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2"></label>
                <div class="col-sm-2">
                    <button id="btn-cek" class="btn btn-primary btn-sm">Cek Jadwal</button>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Jam Mulai <span class="text-danger">*</span></label>
                <div class="col-sm-2">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-alarm"></i></span>
                        <input type="text" id="jam_mulai" name="jam_mulai" class="form-control" value="<?=isset($ruang_rapat['jam_mulai'])?$ruang_rapat['jam_mulai']:set_value('jam_mulai');?>" readonly <?=isset($ruang_rapat['jam_mulai'])? '' : 'disabled' ?>>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Jam Selesai <span class="text-danger">*</span></label>
                <div class="col-sm-2">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-alarm"></i></span>
                        <input type="text" id="jam_selesai" name="jam_selesai" class="form-control" value="<?=isset($ruang_rapat['jam_selesai'])?$ruang_rapat['jam_selesai']:set_value('jam_selesai');?>" readonly <?=isset($ruang_rapat['jam_selesai'])? '' : 'disabled' ?>>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Deskripsi Rapat <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <textarea class="form-control" id="deskripsi_rapat" name="deskripsi_rapat"><?=isset($ruang_rapat['deskripsi_rapat'])?$ruang_rapat['deskripsi_rapat']:set_value('deskripsi_rapat');?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">PIC <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" id="pic" name="pic" class="form-control" placeholder="PIC" autocomplete="off" value="<?=isset($ruang_rapat['pic'])?$ruang_rapat['pic']:set_value('pic');?>" required>
                    <input type="hidden" name="unit_kerja_id" id="unit_kerja_id" value="<?=isset($ruang_rapat['unit_kerja_id'])?$ruang_rapat['unit_kerja_id']:set_value('unit_kerja_id');?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Keterangan</label>
                <div class="col-sm-4">
                    <textarea class="form-control" id="keterangan" name="keterangan"><?=isset($ruang_rapat['keterangan'])?$ruang_rapat['keterangan']:set_value('keterangan');?></textarea>
                </div>
            </div>

            </form>        
        </div>
        <div class="panel-footer">
            <div class="elements">
                <button type="button" class="btn btn-info btn-save"><i class="icon-floppy-disk position-left"></i> Simpan</button>
                <button type="button" class="btn btn-default btn-back"><i class="icon-circle-left2 position-left"></i> Kembali</button>
            </div>
        </div>
        	<?=form_close()?>	
        </div>
    </div>
</div>

<div id="mdl_jadwal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title ruang_name"></h4>
            </div>
            <div class="modal-body" id="modal_content"></div>
            <div class="modal-footer no-padding-top">
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<?php if($this->uri->segment(2) == 'edit'):
    $mulai = strtotime($ruang_rapat['jam_mulai']);
    $akhir = strtotime($ruang_rapat['jam_selesai']);
endif; ?>

<script type="text/javascript" src="<?=base_url()?>assets/js/full.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/interactions.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/fullcalendar-3.1.0/lib/moment.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/legacy.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/forms/daterangepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/forms/picker.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/forms/picker.date.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/forms/picker.time.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/forms/id_ID.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/pnotify.min.js"></script>

<script type="text/javascript">
	$(function(){
        $('.select').select2();

        $('.btn-save').on('click', function(e){
            e.preventDefault();
            $('#frm-ruang-rapat').submit();
        });

        $('.btn-back').on('click', function(e){
            e.preventDefault();
            window.location.href = '<?=base_url()?>ruang_rapat';
        });

        $('#btn-cek').on('click', function(e){
            e.preventDefault();
            if($('#tanggal').val() == ''){
                new PNotify({
                    title: 'Error',
                    text: 'Pilih tanggal terlebih dahulu!',
                    icon: 'icon-blocked',
                    type: 'error',
                    addclass: 'bg-danger'
                });
            } else if($('#ruang_id').val() == ''){
                new PNotify({
                    title: 'Error',
                    text: 'Pilih ruang rapat terlebih dahulu!',
                    icon: 'icon-blocked',
                    type: 'error',
                    addclass: 'bg-danger'
                });
            } else {
                var data = $('#ruang_id').select2('data');

                // console.log(data);
                $.ajax({
                    type: "POST",
                    url: "<?=base_url('ruang_rapat/get_jadwal_ruangan')?>",
                    data: {tanggal: $('#tanggal').val(), id: $('#ruang_id').val()},
                    success: function(r){
                        $('#modal_content').html(r);
                        $('#mdl_tanggal').text($('#tanggal').val());
                        $('#mdl_jadwal').modal('show');          
                        $('.ruang_name').html($('#ruang_id :selected').text());          
                    }
                });
            }

        });

        var tanggal     = $('#tanggal').pickadate({format: 'dd/mm/yyyy'});
        var setTanggal  = new Date();

        tanggal.pickadate('picker').set('select', setTanggal, { format: 'y-m-d' });

        var jam_mulai = $('#jam_mulai').pickatime({format: 'H:i A', formatSubmit: 'HH:i', interval: 60, min: [8,0], max: [7,0]});
        var jam_selesai = $('#jam_selesai').pickatime({format: 'H:i A', formatSubmit: 'HH:i', interval: 60, min: [8,0], max: [7,0]});

        <?php if($this->uri->segment(2) == 'edit'): ?>
        jam_mulai.pickatime('picker').set('select', '<?=date('g:i A', $mulai);?>', {format: 'H:i A', formatSubmit: 'HH:i'});
        jam_selesai.pickatime('picker').set('select', '<?=date('g:i A', $akhir);?>', {format: 'H:i A', formatSubmit: 'HH:i'});
        <?php endif;?>
        // jam_mulai.pickatime('picker').set('disable', true);
        // jam_selesai.pickatime('picker').set('disable', true);

        function highlightText(text, $node) {
            var searchText = $.trim(text).toLowerCase(), currentNode = $node.get(0).firstChild, matchIndex, newTextNode, newSpanNode;
            while ((matchIndex = currentNode.data.toLowerCase().indexOf(searchText)) >= 0) {
                newTextNode = currentNode.splitText(matchIndex);
                currentNode = newTextNode.splitText(searchText.length);
                newSpanNode = document.createElement("span");
                newSpanNode.className = "highlight";
                currentNode.parentNode.insertBefore(newSpanNode, currentNode);
                newSpanNode.appendChild(newTextNode);
            }
        }

        $("#pic").autocomplete({
            source: function(request, response){
                var nama = $("#pic").val();

                $.ajax({
                    type: "POST",
                    url: "<?=base_url('ruang_rapat/autocomplete_pegawai_by_nama')?>",
                    data: "nama="+nama,
                    dataType: "json",
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                console.log(ui);
                $("#pic").val(ui.item.label);
                $("#unit_kerja_id").val(ui.item.unit_kerja_id);

                return false;
            },
            minLength : 2,
            autofocus:true,
            messages: {
                noResults: '',
                results: function() {}
            }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
            var $a = $("<a></a>").text(item.label);
            highlightText(this.term, $a);
            return $("<li></li>").append($a).appendTo(ul);
        };

        $('#pic').autocomplete('option', 'appendTo', '#frm-ruang-rapat');

        $('#ruang_id').on('change', function(e){
            e.preventDefault();
            if($('#tanggal').val() !== ''){
                $('#jam_mulai, #jam_selesai').removeAttr('disabled', true);
                cekWaktu($(this).val(), $('#tanggal').val());
            }
        });

        $('#tanggal').on('blur', function(e){
            e.preventDefault();
            if($('#ruang_id').val() !== ''){
                $('#jam_mulai, #jam_selesai').removeAttr('disabled', true);
                cekWaktu($(this).val(), $('#tanggal').val());
            }
        });

        function cekWaktu(ruang_id, tanggal){
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?=base_url('ruang_rapat/get_available_time')?>",
                data: {tanggal: tanggal, id: ruang_id},
                success: function(r){
                    // enable all time first
                    jam_mulai.pickatime('picker').set('enable', true);
                    jam_selesai.pickatime('picker').set('enable', true);

                    if(r.process == true){
                        var start = r.dis_mulai, end = r.dis_selesai;

                        jam_mulai.pickatime('picker').set('disable', start);
                        jam_selesai.pickatime('picker').set('disable', end);
                    }
                }
            });
        }

    });
</script>

