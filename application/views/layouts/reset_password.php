<!doctype html>
<html style="height:100%">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Reset Password - Badan Ekonomi Kreatif Indonesia</title>
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
<div class="login-container">
    <!-- Page content -->
    <div class="page-content">
        <?php echo $this->load->view('v_renew_password'); ?>
        <!-- Footer -->
        <div class="footer text-size-mini">
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
<script>
    //----------------------------------
    // PRELOADER
    //----------------------------------
    $(window).load(function() { // makes sure the whole site is loaded
        $('#status').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(250).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(250).css({'overflow':'visible'});
    })
    //]]>

    $(function() {
        $('input,textarea').focus(function(){
            $(this).data('placeholder',$(this).attr('placeholder'))
                .attr('placeholder','');
        }).blur(function(){
            $(this).attr('placeholder',$(this).data('placeholder'));
        });

        var form = $('.form-validate');

        var validator = form.validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-error',
            successClass: 'validation-success',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },

            // Different components require proper error label placement
            errorPlacement: function(error, element) {

                // Styled checkboxes, radios, bootstrap switch
                if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                    if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo(element.parent().parent().parent().parent());
                    } else {
                        error.appendTo(element.parent().parent().parent().parent().parent());
                    }
                }

                // Input with icons and Select2
                else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }

                // Inline checkboxes, radios
                else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline') || element.parents('div').hasClass('checkbox-single')) {
                    error.appendTo(element.parent().parent());
                } else if (element.parents('div').hasClass('checkbox-group')) {
                    error.appendTo(element.parent().parent().parent());
                }

                // Input group, styled file input
                else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                } else {
                    error.insertAfter(element);
                }
            },
            validClass: "validation-success",
            success: function(label) {
                label.addClass("validation-success").text("OK")
            },
            rules: {
                password: {
                    required: true,
                    minlength: 8
                },
                repassword: {
                    required: true,
                    minlength: 8,
                    equalTo: '#password'
                }
            },
            messages: {
                required: "Field harus di isi!",
                minlength: "Karakter minimal %s karakter!",
                equalTo:   "Field harus sama dengan field %s!"
            }
        });

        <?php if($this->session->flashdata('error')):?>
            new PNotify({
                title: 'Terjadi Kesalahan!',
                text: '<?=$this->session->flashdata('error');?>',
                addclass: 'bg-danger'
            });
        <?php endif; ?>
    });
</script>
<!-- /global scripts -->

</body>
</html>