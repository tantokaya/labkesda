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
<?=form_open('kegiatan/save_peserta', array('id' => 'frm-peserta', 'class' => 'form-horizontal'));?>
    <input type="hidden" id="peserta_kegiatan_id" name="peserta_kegiatan_id" value="<?=isset($peserta['peserta_kegiatan_id'])?$peserta['peserta_kegiatan_id']:'';?>"  />
    <input type="hidden" id="kegiatan_id" name="kegiatan_id" value="<?=isset($peserta['kegiatan_id'])?$peserta['kegiatan_id']:$kegiatan_id;?>" />
    <input type="hidden" id="jenis_kegiatan_id" name="jenis_kegiatan_id" value="<?=$jenis_kegiatan_id;?>"/>
    <input type="hidden" id="pegawai_id" name="pegawai_id" value=""/>
    <input type="hidden" id="peserta_eksternal_id" name="peserta_eksternal_id" value="" />

    <div class="alert bg-danger" id="error_info2" style="display: none;"></div>

    <div class="row">
        <div class="col-md-7 col-sm-12">
            <div class="form-group">
                <label class="control-label col-sm-4">No. NPWP <span class="text-danger">*</span></label>
                <div class="col-sm-6">
                    <input type="text" id="no_npwp" name="no_npwp" class="form-control" value="" autocomplete="off" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Nama Pegawai <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="text" id="nm_peserta" name="nm_peserta" class="form-control" value="" autocomplete="off" required />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Golongan</label>
                <div class="col-sm-4">
                    <input type="text" id="golongan" name="golongan" class="form-control" value="" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Jabatan</label>
                <div class="col-sm-8">
                    <input type="text" id="jabatan" name="jabatan" class="form-control" value="" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Tanggal Mulai <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" id="tanggal_mulai2" name="tanggal_mulai" class="form-control" value="" required />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Tanggal Selesai <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input type="text" id="tanggal_akhir2" name="tanggal_akhir" class="form-control" value="" required />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Hotel / Penginapan <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="text" id="hotel" name="hotel" class="form-control" value="" required />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Alamat</label>
                <div class="col-sm-8">
                    <textarea id="alamat_hotel" name="alamat_hotel" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-sm-12">
            <div class="form-group">
                <label class="control-label col-sm-6">Transport Pergi</label>
                <div class="col-sm-6">
                    <input type="text" id="transport_pergi" name="transport_pergi" onkeypress="hitung()" onkeyup="hitung()" class="form-control" value="" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-6">Transport Pulang</label>
                <div class="col-sm-6">
                    <input type="text" id="transport_pulang" name="transport_pulang" onkeypress="hitung()" onkeyup="hitung()" class="form-control" value="" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-6">Uang Harian</label>
                <div class="col-sm-6">
                    <input type="text" id="uang_harian" name="uang_harian" onkeypress="hitung()" onkeyup="hitung()" class="form-control" value="" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-6">Total Transport</label>
                <div class="col-sm-6">
                    <input type="text" id="total_transport" name="total_transport" class="form-control" value="" readonly />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-6">Total Seluruhnya</label>
                <div class="col-sm-6">
                    <input type="text" id="total" name="total" class="form-control" value="" readonly />
                </div>
            </div>
        </div>
    </div>
<?=form_close();?>

<script type="text/javascript">
    $(function(){
        'use_strict';

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

        <?php if(isset($peserta['tanggal_mulai']) && $peserta['tanggal_mulai'] !== NULL):?>
        var tanggal_mulai2 = $('#tanggal_mulai2').pickadate({format: 'dd/mm/yyyy'});
        tanggal_mulai2.pickadate('picker').set('select', '<?=$this->functions->convert_date_indo(array('datetime' => $peserta['tanggal_mulai']));?>', {format: 'dd/mm/yyyy'});
        <?php endif; ?>

        <?php if(isset($peserta['tanggal_akhir']) && $peserta['tanggal_akhir'] !== NULL):?>
        var tanggal_akhir2 = $('#tanggal_akhir2').pickadate({format: 'dd/mm/yyyy'});
        tanggal_akhir2.pickadate('picker').set('select', '<?=$this->functions->convert_date_indo(array('datetime' => $peserta['tanggal_akhir']));?>', {format: 'dd/mm/yyyy'});
        <?php endif; ?>

    });

    function hitung(){
        var transport_pergi = $("#transport_pergi").val();
        var transport_pulang = $("#transport_pulang").val();
        var total_transport = 0;

        total_transport = parseInt(transport_pergi) + parseInt(transport_pulang);
        $("#total_transport").val(total_transport);

        var total_transport = $("#total_transport").val();
        var uang_harian = $("#uang_harian").val();
        var total = 0;

        total = parseInt(total_transport) + parseInt(uang_harian);
        $("#total").val(total);
    }
</script>
