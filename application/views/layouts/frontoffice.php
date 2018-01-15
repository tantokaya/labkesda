<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>T-LAB
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content=" width=1024, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <style> body {
            background: #222;
        }
    </style>
    <link rel="stylesheet" href="<?= base_url('assets/pos/font-awesome/css/font-awesome.min.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/icons/icomoon/icomoon.css');?>">
    <link href="<?= base_url('assets/pos/pos.css'); ?>" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/pos/plugins-pos.css');?>">
    <link rel="stylesheet" href="<?= base_url('assets/pos/bootstrap.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/bootstrap-extended.css');?>">
    <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="<?=base_url('assets/js/jquery.js');?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.js');?>"></script>
    <script type="application/javascript">
        $(document).ready(function(){
            $("#tutup").click(function(){
                window.location.href='<?= base_url('logout'); ?>'
            });
        });
    </script>
</head>
<body data-gr-c-s-loaded="true" class="">
<?php $user = $this->setting_model->get_user_info($this->session->user_id); ?>
<div class="o_main_content">
    <div class="o_control_panel o_hidden">
    </div>
    <div class="o_content">
        <div class="pos">
            <div class="pos-topheader">
                <div class="pos-branding">
                    <img class="pos-logo" src="<?= base_url('assets/pos/logo.png'); ?>">
                <span class="username"><?=$user['nama'];?>
                </span>
                </div>
                <div class="pos-rightheader">
                    <div class="order-selector">
                  <span class="orders touch-scrollable">
                    <span class="order-button select-order selected">
                      <span class="order-sequence">1</span>
                      <?= date("H:i") .'|'. $trkasir_id; ?> <input type="hidden" id="trkasir_id" value="<?= $trkasir_id; ?>">
                    </span>
                  </span>
                  <span class="order-button square neworder-button" onClick="window.location.reload()">
                    <i class="fa fa-plus">
                    </i>
                  </span>
                  <span class="order-button square deleteorder-button">
                    <i class="fa fa-minus">
                    </i>
                  </span>
                    </div>
                    <div class="oe_status js_synch">
                        <div class="js_connected oe_icon oe_green">
                            <i class="fa fa-fw fa-wifi">
                            </i>
                        </div>
                    </div>
                    <div class="header-button" id="tutup">Tutup</div>
                </div>
            </div>
            <?= $template['body']; ?>
        </div>
    </div>
</div>
</body>
</html>
