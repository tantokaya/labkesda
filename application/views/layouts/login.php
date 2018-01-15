<!doctype html>
<html style="height:100%">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | Labkesda</title>
    <link href="<?=base_url('assets/images/favicon.ico');?>" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="<?=base_url('assets/images/favicon.ico');?>" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="<?=base_url('assets/images/favicon.ico');?>" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="<?=base_url('assets/images/favicon.ico');?>" rel="apple-touch-icon" type="image/png">
    <link href="<?=base_url('assets/images/favicon.ico');?>" rel="icon" type="image/png">
    <link href="<?=base_url('assets/images/favicon.ico');?>" rel="shortcut icon">

    <!-- Global stylesheets -->
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/fonts/fonts.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/icons/icomoon/icomoon.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/bootstrap.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/core.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/bootstrap-extended.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/plugins.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/color-system.css');?>">

    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/loaders.css');?>">
    <!-- /global stylesheets -->

</head>
<body style="height:100%; background:url('<?=base_url('assets/images/assets/login_bg.jpg');?>') no-repeat 0 0; background-size:cover;">
<?php  date_default_timezone_set('Asia/Jakarta');  ?>
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
<div class="login-container">
    <!-- Page content -->
    <div class="page-content">
        <?php echo $template['body']; ?>
        <!-- Footer -->
        <div class="footer text-size-mini">
            &copy; <?=date('Y');?> - Labkesda
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
<script type="text/javascript">
    var baseUrl = '<?=base_url();?>';
    $(function() {
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
<script type="text/javascript" src="<?=base_url('assets/js/app/login.js');?>"></script>

</body>
</html>