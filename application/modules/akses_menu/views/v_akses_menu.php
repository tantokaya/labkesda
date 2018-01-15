<script src="<?=base_url('assets/js/tables/datatables/datatables.min.js');?>"></script>
<script src="<?=base_url('assets/js/sweetalert.js');?>"></script>

<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-key position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Pengaturan</li>
            <li>Menu</li>
            <li class="active"><?=$page_title;?></li>
        </ul>
    </div>
</div>

<div class="container-fluid page-content">
    <div class="panel panel-default panel-bordered">
        <div class="panel-heading">
            <h5 class="panel-title"><i class="icon-three-bars position-left"></i> <?=$page_title;?></h5>
        </div>

        <div class="panel-body">
            <?php echo $this->table->generate(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var oTable = $('#tbl-akses-menu').dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": '<?php echo base_url('akses_menu/dt_akses_menu'); ?>',
            "bAutoWidth": false,
            "sPaginationType": "full_numbers",
            "bSort": true,

            "dom": '<"row datatables-header form-inline" <"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 akses text-right">><"row" <"col-md-12"<"td-content"rt>>><"row" <"col-md-6"i><"col-md-6"p>>',
            "language": {
                "search": '<span>Pencarian:</span> _INPUT_',
                "lengthMenu": '<span>Show:</span> _MENU_',
                "paginate": { 'first': 'Pertama', 'last': 'Terakhir', 'next': '&rarr;', 'previous': '&larr;' }
            },
            lengthMenu: [ 50, 100 ],
            "fnInitComplete": function() {
                //oTable.fnAdjustColumnSizing();
            },
            "columns": [
                {"data":"akses_menu_id","sName":"am.akses_menu_id"},
                {
                    "data":"menu",
                    "sName":"m.menu",
                    "mRender": function(data, type, row){
                        if ( type === 'display' ) {
                            var str;
                            //console.log(data);
                            switch (row.level){
                                case "0":
                                    str = '<i class="fa fa-folder-open"></i>&nbsp;' + data;
                                    break;
                                case "1":
                                    str = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + data;
                                    break;
                                case "2":
                                    str = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + data;
                                    break;
                                case "3":
                                    str = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + data;
                                    break;
                            }
                            //console.log(str);
                            return str;
                        }
                        return data;
                    }
                },
                {"data":"level","sName":"m.level"},
                {
                    "data":"read_priv",
                    "sName":"am.read_priv",
                    "sClass": "text-center",
                    "mRender": function(data, type, row){
                        if ( type === 'display' ) {
                            //return '<div class="j-forms"><label class="checkbox"><input type="checkbox" class="editor-read" data-id="'+row.akses_menu_id+'"><i></i></label></div>';
                            return '<div class="checkbox-custom checkbox-primary"><input type="checkbox" class="editor-read" data-id="'+row.akses_menu_id+'"><label></label></div>';
                        }
                        return data;
                    }
                },
                {
                    "data":"add_priv",
                    "sName":"am.add_priv",
                    "sClass": "text-center",
                    "mRender": function(data, type, row){
                        if ( type === 'display' ) {
                            //return '<div class="j-forms"><label class="checkbox"><input type="checkbox" class="editor-add" data-id="'+row.akses_menu_id+'"><i></i></label></div>';
                            return '<div class="checkbox-custom checkbox-primary"><input type="checkbox" class="editor-add" data-id="'+row.akses_menu_id+'"><label></label></div>';
                        }
                        return data;
                    }
                },
                {
                    "data":"edit_priv",
                    "sName":"am.edit_priv",
                    "sClass": "text-center",
                    "mRender": function(data, type, row){
                        if ( type === 'display' ) {
                            //return '<div class="j-forms"><label class="checkbox"><input type="checkbox" class="editor-edit" data-id="'+row.akses_menu_id+'"><i></i></label></div>';
                            return '<div class="checkbox-custom checkbox-primary"><input type="checkbox" class="editor-edit" data-id="'+row.akses_menu_id+'"><label></label></div>';
                        }
                        return data;
                    }
                },
                {
                    "data":"delete_priv",
                    "sName":"am.delete_priv",
                    "sClass": "text-center",
                    "mRender": function(data, type, row){
                        if ( type === 'display' ) {
                            //return '<div class="j-forms"><label class="checkbox"><input type="checkbox" class="editor-delete" data-id="'+row.akses_menu_id+'"><i></i></label></div>';
                            return '<div class="checkbox-custom checkbox-primary"><input type="checkbox" class="editor-delete" data-id="'+row.akses_menu_id+'"><label></label></div>';
                        }
                        return data;
                    }
                }
            ],
            "aoColumnDefs": [
                {
                    'bSortable': false,
                    'bSearchable':false,
                    'aTargets': [ -1, -2, -3, -4, 1]
                },
                {
                    'bVisible': false,
                    'bSearchable':false,
                    'aTargets': [ 0, 2 ]
                }
            ],
            "fnServerData": function(sSource, aoData, fnCallback)
            {
                aoData.push({"name":"akses", "value":$('#akses').val()});

                $.ajax
                ({
                    'dataType': 'json',
                    'type'    : 'POST',
                    'url'     : sSource,
                    'data'    : aoData,
                    'success' : fnCallback
                });
            },
            "fnRowCallback": function ( row, data ) {
                $('input.editor-read', row).prop( 'checked', data.read_priv == 1 );
                $('input.editor-add', row).prop( 'checked', data.add_priv == 1 );
                $('input.editor-edit', row).prop( 'checked', data.edit_priv == 1 );
                $('input.editor-delete', row).prop( 'checked', data.delete_priv == 1 );
            }
        });

        $('.dataTables_filter input[type=search]').attr('placeholder','Pencarian...');

        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            width: '60px'
        });

        $('div.dataTables_length').addClass('pull-left').attr('style', 'margin-left: 0;');

        $("div.akses").html('<select name="akses" id="akses" class="form-control"></select>');

        $('#tbl-akses-menu').on( 'change', 'input.editor-read', function (e) {
            e.preventDefault();
            var akses_menu_id = $(this).data('id');
            var read_priv = $(this).prop( 'checked' ) ? 1 : 0;

            $.ajax({
                "method": "post",
                "url"     : "<?php echo base_url('akses_menu/update_read'); ?>",
                "data"    : { akses_menu_id: akses_menu_id, read_priv: read_priv },
                "success" : function(response){
                    oTable._fnAjaxUpdate();
                }
            });
        });

        $('#akses').change(function(e){
            e.preventDefault();
            var akses_id = $(this).val();

            $.ajax({
                "method"    : "post",
                "dataType"  : "json",
                "url"       : "<?php echo base_url('akses_menu/dt_akses_menu'); ?>",
                "data" : { akses: akses_id},
                "success" : function(response){
                    console.log(response);
                    oTable._fnAjaxUpdate();
                }

            });
        });

        $('#tbl-akses-menu').on( 'change', 'input.editor-add', function (e) {
            e.preventDefault();
            var akses_menu_id = $(this).data('id');
            var add_priv = $(this).prop( 'checked' ) ? 1 : 0;

            $.ajax({
                "method": "post",
                "url"     : "<?php echo base_url('akses_menu/update_add'); ?>",
                "data"    : { akses_menu_id: akses_menu_id, add_priv: add_priv },
                "success" : function(response){
                    oTable._fnAjaxUpdate();
                }
            });
        });

        $('#tbl-akses-menu').on( 'change', 'input.editor-edit', function (e) {
            e.preventDefault();
            var akses_menu_id = $(this).data('id');
            var edit_priv = $(this).prop( 'checked' ) ? 1 : 0;

            $.ajax({
                "method": "post",
                "url"     : "<?php echo base_url('akses_menu/update_edit'); ?>",
                "data"    : { akses_menu_id: akses_menu_id, edit_priv: edit_priv },
                "success" : function(response){
                    oTable._fnAjaxUpdate();
                }
            });
        });

        $('#tbl-akses-menu').on( 'change', 'input.editor-delete', function (e) {
            e.preventDefault();
            var akses_menu_id = $(this).data('id');
            var delete_priv = $(this).prop( 'checked' ) ? 1 : 0;

            $.ajax({
                "method": "post",
                "url"     : "<?php echo base_url('akses_menu/update_delete'); ?>",
                "data"    : { akses_menu_id: akses_menu_id, delete_priv: delete_priv },
                "success" : function(response){
                    oTable._fnAjaxUpdate();
                }
            });
        });

        $.getJSON("<?php echo base_url('akses_menu/get_list_akses'); ?>", function (data) {
            $.each(data, function (key,value) {
                $('#akses').append(
                    $('<option></option>').val(value.akses_id).html(value.akses)
                );
            });
        });

        <?php if($this->session->flashdata('notif')): ?>
        swal("<?=$this->session->flashdata('notif');?>", "", "<?=$this->session->flashdata('type');?>");
        <?php endif; ?>



    });
</script>



