<!doctype html>
<html style="height:100%">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Penjadwalan Ruang Rapat - Badan Ekonomi Kreatif Indonesia</title>
    <link href="<?=base_url('assets/images/favicon.png');?>" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="<?=base_url('assets/images/favicon.png');?>" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="<?=base_url('assets/images/favicon.png');?>" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="<?=base_url('assets/images/favicon.png');?>" rel="apple-touch-icon" type="image/png">
    <link href="<?=base_url('assets/images/favicon.png');?>" rel="icon" type="image/png">
    <link href="<?=base_url('assets/images/favicon.png');?>" rel="shortcut icon">

    <!-- Global stylesheets -->
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/fonts/fonts.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/icons/icomoon/icomoon.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/bootstrap.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/core.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/bootstrap-extended.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/plugins.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/color-system.css');?>">

    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/animate.min.css');?>">

    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/loaders.css');?>">
    <!-- /global stylesheets -->

</head>
<body style="height:100%; background:url('<?=base_url('assets/images/assets/login_bg.jpg');?>') no-repeat 0 0; background-size:cover;">
<div id="preloader">
    <div id="status">
        <div class="loader">
            <div class="loader-inner ball-zig-zag">
                <div class="bg-brown"></div>
                <div class="bg-brown"></div>
            </div>
        </div>
    </div>
</div>
<div class="">
    <!-- Page content -->
    <div class="page-content">
        <div class="row">
            <?=form_open('', array('class' => 'frm-horizontal'));?>
            <div class="col-md-12">
                <div class="panel panel-info panel-border border-info">
                    <div class="panel-heading">
                        <h5 class="panel-title animation" data-animation="zoomIn">Jadwal Ruangan Rapat Bekraf</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-2">Nama Ruang Rapat</label>
                                    <div class="col-sm-5">
                                        <select class="select" name="ruang_id" id="ruang_id" data-placeholder="Pilih Ruangan" style="width: 100%">
                                            <option></option>
                                            <?php foreach($l_ruang as $t) : ?>
                                                <option value="<?=$t['ruang_id'];?>"><?=$t['nama_ruang'];?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover" id="tbl-jadwal" style="display:none;">
                                        <thead>
                                            <tr>
                                                <th>Hari / Tanggal</th>
                                                <th>Perihal</th>
                                                <th>Jam</th>
                                                <th>PIC</th>
                                                <th>Satuan Kerja</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td colspan="5">Belum ada jadwal rapat pada ruangan ini</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?=form_close();?>
        </div>

        <!-- Footer -->
        <div class="footer text-size-mini text-center">
            &copy; <?=date('Y');?> - Badan Ekonomi Kreatif Indonesia
        </div>
        <!-- /footer -->
    </div>
    <!-- /page content -->
</div>

<!-- Global scripts -->
<script type="text/javascript" src="<?=base_url('assets/js/jquery.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/uniform.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/jquery.validate.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/pnotify.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/forms/select2.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/full.min.js');?>"></script>

<script type="text/javascript">
    var baseUrl = '<?=base_url();?>';
    $(function() {

        var animation = $('.animation').data("animation");
        console.log(animation);
        $('.animation').parents(".panel").addClass("animated " + animation).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function () {
            $('div.panel').removeClass("animated " + animation);
        });

        $('.select').select2({width: 'resolve'});

        $('#ruang_id').on('change', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "<?=base_url('jadwal/get_jadwal_by_ruang');?>",
                data: {id: $(this).val()},
                success: function(result){
                    $('#tbl-jadwal tbody').html(result);
                    $('#tbl-jadwal').fadeIn('slow');
                }
            });
        });

        <?php if($this->session->flashdata('message')) : ?>
        new PNotify({
            title: 'Sukses!',
            text: '<?=$this->session->flashdata('message');?>',
            addclass: 'bg-success'
        });
        <?php endif; ?>
    });
</script>
<!-- /global scripts -->
<script type="text/javascript">
    $(window).load(function() { // makes sure the whole site is loaded
        $('#status').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(250).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(250).css({'overflow':'visible'});
    });
    //]]>
</script>

</body>
</html>