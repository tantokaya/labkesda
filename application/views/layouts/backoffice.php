<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?=$template['title'];?></title>
    <link href="<?=base_url('assets/images/favicon.ico');?>" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="<?=base_url('assets/images/favicon.ico');?>" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="<?=base_url('assets/images/favicon.ico');?>" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="<?=base_url('assets/images/favicon.ico');?>" rel="apple-touch-icon" type="image/png">
    <link href="<?=base_url('assets/images/favicon.ico');?>" rel="icon" type="image/png">
    <link href="<?=base_url('assets/images/favicon.ico');?>" rel="shortcut icon">

    <!-- Global stylesheets -->
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/fonts/fonts.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/icons/icomoon/icomoon.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/animate.min.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/bootstrap.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/core.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/layout.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/bootstrap-extended.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/components.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/plugins.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/loaders.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/responsive.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/color-system.css');?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/fancybox/jquery.fancybox.css');?>">

    <!-- /global stylesheets -->
    <?php $app = $this->setting_model->get_app_info(); ?>
    <link type="text/css" rel="stylesheet" href="<?=isset($app['app_theme'])?base_url('assets/css/themes/'.$app['app_theme'].'.css'):'#'; ?>" id="theme" />


    <!-- Page css --><!-- /page css -->
    <script src="<?=base_url('assets/js/jquery.js');?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.js');?>"></script>
    <script src="<?=base_url('assets/js/jquery.ui.js');?>"></script>
    <script src="<?=base_url('assets/js/nav.accordion.js');?>"></script>
    <script src="<?=base_url('assets/js/hammerjs.js');?>"></script>
    <script src="<?=base_url('assets/js/jquery.hammer.js');?>"></script>
    <script src="<?=base_url('assets/js/scrollup.js');?>"></script>

</head>
<body class="material-menu" id="top">
<div id="preloader">
    <div id="status">
        <div class="loader">
            <div class="loader-inner ball-pulse">
                <div class="bg-brown-darkest"></div>
                <div class="bg-brown-darkest"></div>
                <div class="bg-brown-darkest"></div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('partials/header');?>

<!--sidebar-->
<?php $this->load->view('partials/sidebar');?>
<!--/sidebar-->

<!--Page Container-->
<section class="main-container">
    <?=$template['body'];?>

    <!--Footer -->
    <?php $this->load->view('partials/footer');?>
    <!--/Footer-->

</section>
<!--/Page Container-->


<?php $this->load->view('partials/scripts'); ?>

<!-- Page scripts -->
<script type="text/javascript" src="<?=base_url('assets/js/app/app.js');?>"></script>
<!-- /page scripts -->
</body>
</html>