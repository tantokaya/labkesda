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
            <li>Master</li>
            <li>Ruang Rapat</li>
            <li><a href="<?=base_url('ruangan');?>">Ruangan</a></li>
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
            <?=form_open('', array('id' => 'frm-ruangan','class' => 'form-horizontal'))?>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Lantai <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <select class="select" style="width: 100%;" data-placeholder="-- Pilih Lantai --" name="lantai" id="lantai" required>
                                <option></option>
                                <?php foreach($lantai as $t): ?>
                                    <?php if(isset($ruang['lantai']) && $ruang['lantai'] == $t['lantai']): ?>
                                        <option value="<?=$t['lantai'];?>" selected><?=$t['lantai'];?></option>
                                    <?php else : ?>
                                        <option value="<?=$t['lantai'];?>" <?=set_select('lantai', $t['lantai'])?>><?=$t['lantai'];?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Nama Ruangan <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="nama_ruang" name="nama_ruang" placeholder="Nama Ruangan..." value="<?=isset($ruang['nama_ruang'])?$ruang['nama_ruang']:set_value('nama_ruang');?>" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Nama Gedung</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="nama_gedung" name="nama_gedung" placeholder="Nama Gedung..." value="<?=isset($ruang['nama_gedung'])?$ruang['nama_gedung']:set_value('nama_gedung');?>" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Deskripsi</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="deskripsi" name="deskripsi"><?=isset($ruang['deskripsi'])?$ruang['deskripsi']:set_value('deskripsi');?></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-4">PIC <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="pic" name="pic" class="form-control" placeholder="PIC" autocomplete="off" value="<?=isset($ruang['pic'])?$ruang['pic']:set_value('pic');?>" required>
                            <input type="hidden" name="user_id" id="user_id" value="<?=isset($ruang['user_id'])?$ruang['user_id']:set_value('user_id');?>">
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

<script type="text/javascript">
    $(function(){

        $('.btn-save').on('click', function(e){
            e.preventDefault();
            $('#frm-ruangan').submit();

        });

        $('.select').select2({width: 'resolve'});

    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#lantai').on('change', function(){
            var lantai = $(this).val();
            $.ajax({
                url: '<?=base_url('ruangan/get_lantai/'); ?>'+lantai,
                type: 'GET',
                dataType: 'JSON',
                success:function(e)
                {
                    console.log(e);
                    $('#nama_gedung').val(e.nama_gedung);
                }
            });
        });
    })

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
                    url: "<?=base_url('ruangan/autocomplete_pegawai_by_nama')?>",
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
                $("#user_id").val(ui.item.user_id);

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

        $('#pic').autocomplete('option', 'appendTo', '#frm-ruangan');    
</script>


