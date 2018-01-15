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
    <input type="hidden" id="kegiatan_id" name="kegiatan_id" value="<?= $kegiatan_id; ?>" />
    <input type="hidden" id="jenis_kegiatan_id" name="jenis_kegiatan_id" value="<?= $jenis_kegiatan_id; ?>"/>
    <input type="hidden" id="pegawai_id" name="pegawai_id" value=""/>
    <input type="hidden" id="peserta_eksternal_id" name="peserta_eksternal_id" value="" />

    <div class="alert bg-danger" id="error_info2" style="display: none;"></div>

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label class="control-label col-sm-4">Nama Peserta <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="text" id="nm_peserta" name="nm_peserta" class="form-control"
                           value="" autocomplete="off" required />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Alamat Peserta</label>
                <div class="col-sm-8">
                    <textarea id="alamat_peserta" name="alamat_peserta" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Nama Instansi <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="text" id="nm_instansi" name="nm_instansi" class="form-control" value="" autocomplete="off" required />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Jabatan</label>
                <div class="col-sm-8">
                    <input type="text" id="jabatan" name="jabatan" class="form-control" value="" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Golongan</label>
                <div class="col-sm-8">
                    <input type="text" id="golongan" name="golongan" class="form-control" value="" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">No. Telp / HP</label>
                <div class="col-sm-8">
                    <input type="text" id="no_telepon" name="no_telepon" class="form-control" value="" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Email</label>
                <div class="col-sm-8">
                    <input type="text" id="email" name="email" class="form-control" value="" />
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label class="control-label col-sm-4">No. NPWP</label>
                <div class="col-sm-8">
                    <input type="text" id="no_npwp" name="no_npwp" class="form-control" value="" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Status <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <select name="status_peserta_id" id="status_peserta_id">
                        <option value="">-- Pilih Status Peserta --</option>
                        <?php foreach($l_status_peserta as $t) : ?>
                                <option value="<?=$t['status_peserta_id'];?>"><?=$t['status_peserta'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Uang Transport</label>
                <div class="col-sm-8">
                    <input type="text" id="total_transport" name="total_transport" onkeypress="hitung()" onkeyup="hitung()" class="form-control" value="" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Uang Saku</label>
                <div class="col-sm-8">
                    <input type="text" id="uang_saku" name="uang_saku" onkeypress="hitung()" onkeyup="hitung()" class="form-control" value="" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Honor</label>
                <div class="col-sm-8">
                    <input type="text" id="honor" name="honor" onkeypress="hitung()" onkeyup="hitung()" class="form-control" value="" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">PPN</label>
                <div class="col-sm-8">
                    <input type="text" id="ppn" name="ppn" onkeypress="hitung()" onkeyup="hitung()" class="form-control" value="" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Total</label>
                <div class="col-sm-8">
                    <input type="text" id="total" name="total" onclick="hitung()" class="form-control" value="" readonly />
                </div>
            </div>
        </div>
    </div>
<?=form_close();?>

<script src="<?=base_url('assets/js/forms/bootstrap_select.min.js');?>"></script>


<script type="text/javascript">
    $(function(){
        'use_strict';

        // Override defaults
        $.fn.selectpicker.defaults = {
            iconBase: '',
            tickIcon: 'icon-checkmark3'
        }

        $('#status_peserta_id').selectpicker();


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
    });


    function hitung(){
        var total_transport = $("#total_transport").val();
        var uang_saku = $("#uang_saku").val();
        var honor = $("#honor").val();
        var ppn = $("#ppn").val();
        var total = 0;

        total = (parseInt(total_transport) + parseInt(uang_saku) + parseInt(honor)) - parseInt(ppn);
        $("#total").val(total);
    }

</script>
