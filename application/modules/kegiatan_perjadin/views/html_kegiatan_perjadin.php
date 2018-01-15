
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Kegiatan - Badan Ekonomi Kreatif Indonesia</title>
    <link href="<?=base_url()?>assets/images/favicon.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="<?=base_url()?>assets/images/favicon.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="<?=base_url()?>assets/images/favicon.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="<?=base_url()?>assets/images/favicon.png" rel="apple-touch-icon" type="image/png">
    <link href="<?=base_url()?>assets/images/favicon.png" rel="icon" type="image/png">
    <link href="<?=base_url()?>assets/images/favicon.png" rel="shortcut icon">

    <!-- Global stylesheets -->
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/fonts/fonts.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/icons/icomoon/icomoon.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/css/animate.min.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/css/core.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/css/layout.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-extended.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/css/components.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/css/plugins.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/css/loaders.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/css/responsive.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/css/color-system.css">
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/css/fancybox/jquery.fancybox.css">
    <!-- /global stylesheets -->
        <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/css/themes/mirage.css" id="theme" />


    <!-- Page css --><!-- /page css -->
    <script src="<?=base_url()?>assets/js/jquery.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.ui.js"></script>
    <script src="<?=base_url()?>assets/js/nav.accordion.js"></script>
    <script src="<?=base_url()?>assets/js/hammerjs.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.hammer.js"></script>
    <script src="<?=base_url()?>assets/js/scrollup.js"></script>

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



<header class="main-nav clearfix">

    <div class="navbar-left pull-left">
        <div class="clearfix">
            <ul class="left-branding pull-left">
                <li><span class="left-toggle-switch visible-handheld"><i class="icon-menu7"></i></span></li>
                <li>
                    <a href="#"><div class="logo"></div></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="navbar-right pull-right">
        <div class="clearfix">
            <ul class="pull-right top-right-icons">
                <li class="dropdown user-dropdown">
                    <a href="#" class="btn-user dropdown-toggle hidden-xs" data-toggle="dropdown">
                        <!--<img src="<?=base_url()?>assets/images/faces/default.png" class="img-circle user" alt=""/></a>-->
                        <img src="http://202.46.1.50/assets\avatar/default.png" class="img-circle user" alt=""/></a>
                    <a href="#" class="dropdown-toggle visible-xs" data-toggle="dropdown"><i class="icon-more"></i></a>
                    <div class="dropdown-menu">
                        <!--<div class="text-center"><img src="<?=base_url()?>assets/images/faces/default.png" class="img-circle img-70" alt=""/></div>-->
                        <div class="text-center"><img src="http://202.46.1.50/assets\avatar/default.png" class="img-circle img-70" alt=""/></div>
                        <h5 class="text-center"><b>Halo, Admin Bekraf!</b></h5>
                        <ul class="more-apps">
                            <li><a href="<?=base_url()?>profil"><i class="icon-profile"></i> Profil Saya</a></li>
                            <li><a href="#"><i class="icon-calendar"></i> Kegiatan Mendatang <span class="badge badge-danger pull-right">3</span></a></li>
                        </ul>
                        <div class="text-center"><a href="<?=base_url()?>logout" class="btn btn-sm btn-info"><i class="icon-exit3 i-16 position-left"></i> Keluar</a></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
<!--sidebar-->
<link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/css/fab.css">
<script src="<?=base_url()?>assets/js/pages/fab_buttons.js"></script>

<aside class="sidebar">
    <div class="left-aside-container">
        <div class="user-profile-container">
            <div class="user-profile clearfix">
                <div class="admin-user-thumb">
                                        <img src="http://202.46.1.50/assets\avatar/default.png" alt="avatar" class="img-circle">
                </div>
                <div class="admin-user-info">
                    <ul class="user-info">
                        <li><a href="#" class="text-semibold text-size-large">Admin Bekraf</a></li>
                        <li><a href="#"><small>Administrator</small></a></li>
                    </ul>
                    <div class="logout-icon"><a href="<?=base_url()?>logout"><i class="icon-exit2"></i></a></div>
                </div>

            </div>
        </div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" id="tab-menu"><a href="#menu" aria-controls="menu" role="tab" data-toggle="tab"><i class="icon-home2"></i></a></li>
            <li role="presentation" id="tab-arsip"><a href="#arsip" aria-controls="arsip" role="tab" data-toggle="tab"><i class="icon-folder-open"></i></a></li>
            <li role="presentation" class="active" id="tab-profile"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="icon-users2"></i></a></li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active fadeIn" id="menu">
                <ul class="sidebar-accordion acc-menu">

                    <li class="list-title">Menu</li>
                    <li><a href="<?=base_url()?>dashboard"><i class="icon-display4"></i> Dashboard</a>

                    <li><a href="#"><i class=" icon-file-text2"></i> Master</a><ul class="acc-menu"><li><a href="#"><!--<i class="fa fa-folder-open"></i>-->Kegiatan</a><ul class="acc-menu"><li><a href="<?=base_url()?>jenis_kegiatan"> Jenis Kegiatan</a></li><li><a href="<?=base_url()?>tipe_kegiatan"> Tipe Kegiatan</a></li><li><a href="<?=base_url()?>status_peserta_kegiatan"> Status Peserta/Undangan</a></li></ul></li><li><a href="#"><!--<i class="fa fa-folder-open"></i>-->Kepegawaian</a><ul class="acc-menu"><li><a href="<?=base_url()?>agama"> Agama</a></li><li><a href="<?=base_url()?>eselon"> Eselon</a></li><li><a href="<?=base_url()?>golongan"> Golongan</a></li><li><a href="<?=base_url()?>pegawai"> Pegawai</a></li><li><a href="<?=base_url()?>status_jabatan"> Status Jabatan</a></li><li><a href="<?=base_url()?>status_pegawai"> Status Pegawai</a></li></ul></li><li><a href="<?=base_url()?>wilayah_administrasi"> Wilayah Administrasi</a></li><li><a href="#"><!--<i class="fa fa-folder-open"></i>-->SBK</a><ul class="acc-menu"><li><a href="<?=base_url()?>sbk_fgd"> FGD</a></li><li><a href="<?=base_url()?>sbk_perjadin"> Perjadin</a></li></ul></li><li><a href="#"><!--<i class="fa fa-folder-open"></i>-->Ruang Rapat</a><ul class="acc-menu"><li><a href="<?=base_url()?>lantai"> Lantai</a></li><li><a href="<?=base_url()?>ruangan"> Ruangan</a></li></ul></li></ul></li><li><a href="#"><i class="icon-calendar52"></i> Kegiatan</a><ul class="acc-menu"><li><a href="<?=base_url()?>kegiatan"> Daftar Kegiatan</a></li><li><a href="<?=base_url()?>kalender"> Kalender</a></li><li><a href="<?=base_url()?>kegiatan_rapat"> Rapat</a></li><li><a href="<?=base_url()?>kegiatan_perjadin"> Perjadin</a></li></ul></li><li><a href="#"><i class="icon-gear"></i> Pengaturan</a><ul class="acc-menu"><li><a href="<?=base_url()?>setting_aplikasi"> Aplikasi</a></li><li><a href="#"><!--<i class="fa fa-folder-open"></i>-->Pengguna</a><ul class="acc-menu"><li><a href="<?=base_url()?>pengguna"> Daftar Pengguna</a></li><li><a href="<?=base_url()?>akses"> Grup Pengguna</a></li></ul></li><li><a href="#"><!--<i class="fa fa-folder-open"></i>-->Menu</a><ul class="acc-menu"><li><a href="<?=base_url()?>menu"> Daftar Menu</a></li><li><a href="<?=base_url()?>akses_menu"> Akses Menu</a></li></ul></li></ul></li><li><a href="<?=base_url()?>ruang_rapat"><i class="icon-table2"></i> <span>Jadwal Ruang Rapat</span></a></li><li><a href="<?=base_url()?>laporan"><i class=" icon-file-text2"></i> <span>Laporan</span></a></li>
                </ul>
            </div>

            <div role="tabpanel" class="tab-pane email fade" id="arsip">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="email-buttons">
                            <div class="row m-t-5">
                                <div class="col-xs-6 no-padding-left">
                                    <button class="btn bg-primary btn-block btn-float btn-float-lg" type="button"><i class="icon-folder"></i> <span>Publik</span></button>
                                </div>

                                <div class="col-xs-6 no-padding-right">
                                    <button class="btn bg-info btn-block btn-float btn-float-lg" type="button"><i class="icon-folder-remove"></i> <span>Privat</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="menu-list m-t-10 m-b-20">
                    <li class="list-title">Arsip</li>
                    <li><a href="#"><i class="icon-folder"></i> Publik <span class="badge badge-info">0</span></a></li>
                    <li><a href="#"><i class="icon-folder-remove"></i> Privat <span class="badge badge-warning">0</span></a></li>
                </ul>
            </div>



            <div role="tabpanel" class="tab-pane profile fade" id="profile">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="text-center">
                            <img src="http://202.46.1.50/assets\avatar/default.png" class="img-responsive img-circle user-avatar" alt=""/>
                            <h4 class="no-margin-bottom m-t-10">Halo! Admin Bekraf</h4>
                            <div class="text-light text-size-small text-white">Administrator</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</aside>
<!--/sidebar-->

<!--Page Container-->
<section class="main-container">
    <style type="text/css">
    .non-perjadin, .perjadin{
        display: none;
    }

    .modal-open {
        overflow: hidden;
        position:fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        height: 100%;
    }
</style>
<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-calendar2 position-left"></i>Tambah Kegiatan Perjadin</div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url()?>dashboard">Home</a></li>
            <li><a href="<?=base_url()?>kegiatan">Kegiatan</a></li>
            <li class="active">Tambah Kegiatan Perjadin</li>
        </ul>
    </div>
</div>


<div class="container-fluid page-content">
    <div class="panel panel-default panel-bordered">
        <div class="panel-heading">
            <h5 class="panel-title"><i class="icon-three-bars position-left"></i> Tambah Kegiatan Perjadin</h5>
        </div>
        <div class="panel-body">
            <div class="tabbable">
                <ul class="nav nav-tabs nav-tabs-highlight nav-bordered tab-menu" id="tab-kegiatan">
                    <li><a href="#kegiatan-tab" data-toggle="tab" aria-expanded="true"><i class="icon-calendar52 position-left"></i> Kegiatan</a></li>
                    <li class=""><a href="#lampiran-tab" data-toggle="tab" aria-expanded="false"><i class="icon-cloud-upload2 position-left"></i> Lampiran</a></li>
                    <li class="active"><a href="#peserta-tab" data-toggle="tab" aria-expanded="false"><i class="icon-users2"></i> Daftar Peserta Kegiatan</a></li>
                    <li class=""><a href="#internal-tab" data-toggle="tab" aria-expanded="false"><i class="icon-users2"></i> Internal</a></li>
                    <li class=""><a href="#eksternal-tab" data-toggle="tab" aria-expanded="false"><i class="icon-users2"></i> Eksternal</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane" id="kegiatan-tab">
                        <form action="#" id="frm-kegiatan" class="form-horizontal" method="post" accept-charset="utf-8">
                        <input type="hidden" id="kegiatan_id" name="kegiatan_id" value="">
                        <div class="alert bg-danger" id="error_info" style="display: none;"></div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">Kegiatan <span class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <select class="select" style="width: 100%;" data-placeholder="-- Kode Satuan Kerja --" name="kode_satuan_kerja" id="kode_satuan_kerja" >
                                    <option></option>
                                        <option value="1" >BEK1</option>
                                        <option value="2" >RO1</option>
                                        <option value="1" >RO2</option>
                                        <option value="2" >RO3</option>
                                        <option value="1" >RO4</option>
                                        <option value="2" >RO5</option>
                                        <option value="1" >D1</option>
                                        <option value="2" >D2</option>
                                        <option value="1" >D3</option>
                                        <option value="2" >D4</option>
                                        <option value="2" >D5</option>
                                        <option value="2" >D6</option>
                                </select>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="kegiatan" name="kegiatan" placeholder="Nama Kegiatan..." value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Tipe Kegiatan <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <select class="select" style="width: 100%;" data-placeholder="-- Pilih Tipe Kegiatan --" name="tipe_kegiatan_id" id="tipe_kegiatan_id" required>
                                    <option></option>
                                                                                                                        <option value="1" >Perorangan</option>
                                                                                                                                                                <option value="2">Grup</option>
                                                                                                            </select>
                            </div>
                            <label class="control-label col-sm-2">Tanggal Mulai <span class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                    <input type="text" id="tanggal_mulai" name="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Publik</label>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" name="is_private" value="0"> Ya
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="is_private" value="1" > Tidak
                                </label>
                            </div>
                            <label class="control-label col-sm-2">Tanggal Akhir <span class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                    <input type="text" id="tanggal_akhir" name="tanggal_akhir" class="form-control" placeholder="Tanggal Akhir" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Tipe Perjadin <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <select class="select" style="width: 100%;" data-placeholder="-- Pilih Tipe Perjadin --" >
                                    <option value=""></option>
                                    <option value="1">Dalam Kota</option>
                                    <option value="2">Luar Kota</option>
                                    <option value="3">Luar Negri</option>
                                </select>
                            </div>
                            <label class="control-label col-sm-2">Propinsi Tujuan <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <select class="select" style="width: 100%;" data-placeholder="-- Pilih Propinsi Tujuan--" name="propinsi_id" id="propinsi_id" required>
                                    <option value=""></option>
                                    <option value="11">NANGGROE ACEH DARUSSALAM</option>
                                        <option value="12">SUMATERA UTARA</option>
                                        <option value="13">SUMATERA BARAT</option>
                                        <option value="14">RIAU</option>
                                        <option value="15">JAMBI</option>
                                        <option value="16">SUMATERA SELATAN</option>
                                        <option value="17">BENGKULU</option>
                                        <option value="18">LAMPUNG</option>
                                        <option value="19">KEPULAUAN BANGKA BELITUNG</option>
                                        <option value="21">KEPULAUAN RIAU</option>
                                        <option value="31">DKI JAKARTA</option>
                                        <option value="32">JAWA BARAT</option>
                                        <option value="33">JAWA TENGAH</option>
                                        <option value="34">DAERAH ISTIMEWA YOGYAKARTA</option>
                                        <option value="35">JAWA TIMUR</option>
                                        <option value="36">BANTEN</option>
                                        <option value="51">BALI</option>
                                        <option value="52">NUSA TENGGARA BARAT</option>
                                        <option value="53">NUSA TENGGARA TIMUR</option>
                                        <option value="61">KALIMANTAN BARAT</option>
                                        <option value="62">KALIMANTAN TENGAH</option>
                                        <option value="63">KALIMANTAN SELATAN</option>
                                        <option value="64">KALIMANTAN TIMUR</option>
                                        <option value="65">KALIMANTAN UTARA</option>
                                        <option value="71">SULAWESI UTARA</option>
                                        <option value="72">SULAWESI TENGAH</option>
                                        <option value="73">SULAWESI SELATAN</option>
                                        <option value="74">SULAWESI TENGGARA</option>
                                        <option value="75">GORONTALO</option>
                                        <option value="76">SULAWESI BARAT</option>
                                        <option value="81">MALUKU</option>
                                        <option value="82">MALUKU UTARA</option>
                                        <option value="91">PAPUA</option>
                                        <option value="92">PAPUA BARAT</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Keterangan <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
                            </div>
                            <label class="control-label col-sm-2">Kota/Kab. Tujuan <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <select class="select" style="width: 100%;" data-placeholder="-- Pilih Kota/Kab. Tujuan --" name="kota_id" id="kota_id" required>
                                    <option value=""></option>
                                                                    </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">MAK <span class="text-danger">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="mak" name="mak" placeholder="MAK..." value="" required />
                            </div>
                            <label class="control-label col-sm-2 perjadin">Kota/Kab. Tujuan <span class="text-danger">*</span></label>
                            <div class="col-sm-4 perjadin">
                                <select class="select" style="width: 100%;" data-placeholder="-- Pilih Kota/Kab. Tujuan --" name="kota_id" id="kota_id" required>
                                    <option value=""></option>
                                                                    </select>
                            </div>
                        </div>
                        <div class="form-group">
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Deskripsi MAK <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea name="desc_mak" id="desc_mak" class="form-control" required></textarea>
                            </div>
                        </div>

                        </form>                    </div>
                    <div class="tab-pane" id="lampiran-tab">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Upload Lampiran Perjalanan Dinas</h5>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                <style type="text/css">
                                    .input-group .form-control:last-child, .input-group-addon:last-child, .input-group-btn:last-child>.btn, .input-group-btn:last-child>.btn-group>.btn, .input-group-btn:last-child>.dropdown-toggle, .input-group-btn:first-child>.btn:not(:first-child), .input-group-btn:first-child>.btn-group:not(:first-child)>.btn {
                                        border-bottom-left-radius: 0;
                                        border-top-left-radius: 0;
                                    }
                                     .btn-file input[type=file]{
                                            position: absolute;
                                            top: 0;
                                            right: 0;
                                            min-width: 100%;
                                            min-height: 100%;
                                            text-align: right;
                                            opacity: 0;
                                            background: none repeat scroll 0 0 transparent;
                                            cursor: inherit;
                                            display: block;

                                     }
                                </style>
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Undangan </label>
                                            <div class="col-sm-10">
                                                 <input type="file" name="" class="form-control file" multiple="true" placeholder="Undangan..." required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Surat Tugas </label>
                                            <div class="col-sm-10">
                                                 <input type="file" " name="" class="form-control file" multiple="true" placeholder="Surat Tugas..." required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Kwitansi </label>
                                            <div class="col-sm-10">
                                                 <input type="file" name="" class="form-control file" multiple="true" placeholder="Kwitansi..." required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Daftar Pengeluaran Riil </label>
                                            <div class="col-sm-10">
                                                 <input type="file" name="" class="form-control file" multiple="true" placeholder="Daftar Pengeluaran Riil..." required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">SPD </label>
                                            <div class="col-sm-10">
                                                 <input type="file" id="" name="" class="form-control file" multiple="true" placeholder="SPD..." required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Visum </label>
                                            <div class="col-sm-10">
                                                 <input type="file" id="" name="" class="form-control file" multiple="true" placeholder="Visum..." required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Kwitansi Hotel </label>
                                            <div class="col-sm-10">
                                                 <input type="file" id="" name="" class="form-control file" multiple="true" placeholder="Kwitansi Hotel..." required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Tiket Pesawat (PP & Boarding Pass) </label>
                                            <div class="col-sm-10">
                                                 <input type="file" id="" name="" class="form-control file" multiple="true" placeholder="Tiket Pesawat (PP & Boarding Pass)..." required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Laporan Perjadin </label>
                                            <div class="col-sm-10">
                                                 <input type="file" id="" name="" class="form-control file" multiple="true" placeholder="Laporan Perjadin..." required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2">DPRD </label>
                                            <div class="col-sm-10">
                                                 <input type="file" id="" name="" class="form-control file" multiple="true" placeholder="DPRD..." required />
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-sm-2">Nominatif DPRD </label>
                                            <div class="col-sm-10">
                                                 <input type="file" id="" name="" class="form-control file" multiple="true" placeholder="Nominatif DPRD..." required />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Lampiran</h5>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" id="list-lampiran"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane active" id="peserta-tab">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <label><span>Pencarian:</span> <input type="search" class="" placeholder="Pencarian..." aria-controls="tbl-agama"></label>
                                    <label style="float:right;"><span>Show:</span> <select name="tbl-agama_length" aria-controls="tbl-agama" class="select2-hidden-accessible" tabindex="-1" aria-hidden="true"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="75">75</option><option value="100">100</option></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 60px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-tbl-agama_length-0u-container"><span class="select2-selection__rendered" id="select2-tbl-agama_length-0u-container" title="10">10</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></label>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" >
                                    <table class="table list-lampiran table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Peserta</th>
                                                <th>Instansi</th>
                                                <th>Jabatan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Írene Tatyana Sabdarini</td>
                                                <td>Internal</td>
                                                <td>Staff</td>
                                                <td>Peserta</td>
                                                <td>
                                                <ul class="icons-list">
                                                    <li><a href="#" class="btn-view-peserta" data-id=""><i class="icon-eye" data-popup="tooltip-custom" title="Lihat Data Peserta"></i></a></li>
                                                    <li><a href="#" class="btn-ubah-peserta" data-id=""><i class="icon-pencil6"></i></a></li>
                                                    <li><a href="#" class="btn-delete-peserta" data-id=""><i class="icon-trash"></i></a></li>
                                                </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Dummy</td>
                                                <td>Eksternal</td>
                                                <td></td>
                                                <td>Moderator</td>
                                                <td>
                                                <ul class="icons-list">
                                                    <li><a href="#" class="btn-view-peserta" data-id=""><i class="icon-eye" data-popup="tooltip-custom" title="Lihat Data Peserta"></i></a></li>
                                                    <li><a href="#" class="btn-ubah-peserta" data-id=""><i class="icon-pencil6"></i></a></li>
                                                    <li><a href="#" class="btn-delete-peserta" data-id=""><i class="icon-trash"></i></a></li>
                                                    <!-- <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right"><li><a href="#"><i class="icon-pencil6"></i> Ubah</a></li><li class="divider"></li><li><a href="#" class="btn-delete" data-id="#"><i class="icon-trash"></i> Hapus</a></li></ul></li> -->
                                                </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="internal-tab">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <label><span>Pencarian:</span> <input type="search" class="" placeholder="Pencarian..." aria-controls="tbl-agama"></label>
                                <label style="float:right;"><span>Show:</span> <select name="tbl-agama_length" aria-controls="tbl-agama" class="select2-hidden-accessible" tabindex="-1" aria-hidden="true"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="75">75</option><option value="100">100</option></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 60px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-tbl-agama_length-0u-container"><span class="select2-selection__rendered" id="select2-tbl-agama_length-0u-container" title="10">10</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></label>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" >
                                    <table class="table list-lampiran table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>No Telp</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>19850719201503999</td>
                                                <td>Írene Tatyana Sabdarini</td>
                                                <td>irene@email.com</td>
                                                <td>0899988</td>
                                                <td>
                                                <ul class="icons-list">
                                                    <li><a href="#" class="btn-delete-peserta" data-id="" title="Tambah Peserta Kegiatan" data-toggle="modal" data-target=".internal_eksternal"><i class="icon-plus2"></i></a></li>
                                                </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>198507192015032000</td>
                                                <td>Agus Setiawan</td>
                                                <td>agus@gmail.com</td>
                                                <td>8988888</td>
                                                <td>
                                                <ul class="icons-list">
                                                    <li><a href="#" class="btn-delete-peserta" data-id="" title="Tambah Data Peserta"><i class="icon-plus2"></i></a></li>

                                                    <!-- <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right"><li><a href="#"><i class="icon-pencil6"></i> Ubah</a></li><li class="divider"></li><li><a href="#" class="btn-delete" data-id="#"><i class="icon-trash"></i> Hapus</a></li></ul></li> -->
                                                </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>1985071920150300</td>
                                                <td>Budi Sekaryadi</td>
                                                <td>budi@gmail.com</td>
                                                <td>8988888</td>
                                                <td>
                                                <ul class="icons-list">
                                                    <li><a href="#" class="btn-delete-peserta" data-id=""><i class="icon-plus2"></i></a></li>
                                                    <!-- <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right"><li><a href="#"><i class="icon-pencil6"></i> Ubah</a></li><li class="divider"></li><li><a href="#" class="btn-delete" data-id="#"><i class="icon-trash"></i> Hapus</a></li></ul></li> -->
                                                </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="eksternal-tab">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <div style="float: left;">
                                <button type="button" id="btn-add-peserta" class="btn btn-sm btn-info">Tambah Peserta Eksternal <i class="icon-plus2"></i></button>
                                </div>
                                <br/><br/>
                                <div>
                                    <label><span>Pencarian:</span> <input type="search" class="" placeholder="Pencarian..." aria-controls="tbl-agama"></label>
                                    <label style="float:right;"><span>Show:</span> <select name="tbl-agama_length" aria-controls="tbl-agama" class="select2-hidden-accessible" tabindex="-1" aria-hidden="true"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="75">75</option><option value="100">100</option></select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 60px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-tbl-agama_length-0u-container"><span class="select2-selection__rendered" id="select2-tbl-agama_length-0u-container" title="10">10</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></label>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive" >
                                    <table class="table list-lampiran table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NPWP</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>No Telp</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>01.123.456.7-521.000</td>
                                                <td>Joko Suraceng</td>
                                                <td>joko@email.com</td>
                                                <td>0899988</td>
                                                <td>
                                                <ul class="icons-list">
                                                    <li><a href="#" class="btn-delete-peserta" data-id="" title="Tambah Peserta Kegiatan"><i class="icon-plus2" data-toggle="modal" data-target=".internal_eksternal"></i></a></li>
                                                </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>01.123.456.7-521.033</td>
                                                <td>Dhani</td>
                                                <td>Dhani@gmail.com</td>
                                                <td>8988888</td>
                                                <td>
                                                <ul class="icons-list">
                                                    <li><a href="#" class="btn-delete-peserta" data-id="" title="Tambah Data Peserta"><i class="icon-plus2"></i></a></li>

                                                    <!-- <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right"><li><a href="#"><i class="icon-pencil6"></i> Ubah</a></li><li class="divider"></li><li><a href="#" class="btn-delete" data-id="#"><i class="icon-trash"></i> Hapus</a></li></ul></li> -->
                                                </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>01.123.456.7-521.330</td>
                                                <td>Ajeng Rahajeng</td>
                                                <td>ajeng@gmail.com</td>
                                                <td>8988888</td>
                                                <td>
                                                <ul class="icons-list">
                                                    <li><a href="#" class="btn-delete-peserta" data-id=""><i class="icon-plus2"></i></a></li>
                                                    <!--
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        <i class="icon-menu7"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><i class="icon-pencil6"></i> Ubah</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#" class="btn-delete" data-id="#"><i class="icon-trash"></i> Hapus</a></li>
                                                        </ul>
                                                    </li>
                                                    -->
                                                </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <!-- <div class="elements">
                <button type="submit" class="btn btn-info"><i class="icon-floppy-disk position-left"></i> Simpan</button>
            </div> -->
        </div>
    </div>
</div>

<div id="mdl_undangan" class="modal fade" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 id="" class="modal-title">Tambah Peserta Eksternal</h4>
            </div>
            <div class="modal-body" id="" style="overflow:hidden;">
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
        <form action="#" id="" class="form-horizontal" method="post" accept-charset="utf-8">
            <input type="hidden" id="peserta_kegiatan_id" name="peserta_kegiatan_id" value="">
            <input type="hidden" id="kegiatan_id" name="kegiatan_id" value="51">
            <input type="hidden" id="jenis_kegiatan_id" name="jenis_kegiatan_id" value="1">

            <div class="alert bg-danger" id="error_info2" style="display: none;"></div>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <!-- <div class="form-group">
                        <label class="control-label col-sm-4">Instansi <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input type="radio" name="instansi" id="instansi" value="1"> Bekraf
                            </label>

                            <label class="radio-inline">
                                <input type="radio" name="instansi" id="instansi" value="0" > Non Bekraf
                            </label>
                        </div>
                    </div> -->
                    <!-- <div class="form-group">
                        <label class="control-label col-sm-4">NIP</label>
                        <div class="col-sm-8">
                            <input type="text" id="nm_peserta" name="nm_peserta" class="form-control ui-autocomplete-input" value="" autocomplete="off" required="" placeholder="">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="control-label col-sm-4">Nama Peserta</label>
                        <div class="col-sm-8">
                            <input type="text" id="nm_peserta" name="nm_peserta" class="form-control ui-autocomplete-input" value="" autocomplete="off" required="" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Email</label>
                        <div class="col-sm-8">
                            <input type="text" id="emial" name="email" class="form-control" value="" autocomplete="off" required="" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">NPWP</label>
                        <div class="col-sm-8">
                            <input type="text" id="npwp" name="npwp" class="form-control" value="" autocomplete="off" required="" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">No. Telp / HP</label>
                        <div class="col-sm-8">
                            <input type="text" id="no_telepon" name="no_telepon" class="form-control" value="" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Alamat Peserta</label>
                        <div class="col-sm-8">
                            <textarea id="alamat_peserta" name="alamat_peserta" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Nama Instansi</label>
                        <div class="col-sm-8">
                            <input type="text" id="nm_instansi" name="nm_instansi" class="form-control" value="" autocomplete="off" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Jabatan</label>
                        <div class="col-sm-8">
                            <input type="text" id="jabatan" name="jabatan" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Golongan</label>
                        <div class="col-sm-8">
                            <input type="text" id="golongan" name="golongan" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Status <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select name="status_peserta_id" id="status_peserta_id" class="bs-select-hidden">
                                <option value="">-- Pilih Status Peserta --</option>
                                <option value="1">Peserta</option>
                                <option value="2">Narasumber</option>
                                <option value="3">Moderator</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Uang Transport</label>
                        <div class="col-sm-8">
                            <input type="text" id="total_transport" name="total_transport" onkeypress="hitung()" onkeyup="hitung()" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Uang Saku</label>
                        <div class="col-sm-8">
                            <input type="text" id="uang_saku" name="uang_saku" onkeypress="hitung()" onkeyup="hitung()" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Honor</label>
                        <div class="col-sm-8">
                            <input type="text" id="honor" name="honor" onkeypress="hitung()" onkeyup="hitung()" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">PPN</label>
                        <div class="col-sm-8">
                            <input type="text" id="ppn" name="ppn" onkeypress="hitung()" onkeyup="hitung()" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Total</label>
                        <div class="col-sm-8">
                            <input type="text" id="total" name="total" onclick="hitung()" class="form-control" value="0" readonly="">
                        </div>
                    </div>
                </div>
            </div>
<ul class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content" id="ui-id-2" tabindex="0" style="display: none;"></ul></form>
<script src="<?=base_url()?>assets/js/forms/bootstrap_select.min.js"></script>


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

        $("#nm_peserta").autocomplete({
            source: function(request, response){
                var nama = $("#nm_peserta").val();

                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>kegiatan/autocomplete_pegawai_by_nama",
                    data: "nama="+nama,
                    dataType: "json",
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function( event, ui) {
                $("#nm_peserta").val(ui.item.label);
                $("#nip").val(ui.item.nip);
                $("#golongan").val(ui.item.golongan);
                $("#jabatan").val(ui.item.status_jabatan);
                $("#alamat_peserta").val(ui.item.alamat);
                $("#nm_instansi").val(ui.item.instansi);
                $("#no_npwp").val(ui.item.npwp);

                $('#hotel').focus();

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

        $('#nm_peserta').autocomplete('option', 'appendTo', '#frm-peserta');

        $('#nip').on('blur', function(e){
            e.preventDefault();
            var nip = $(this).val();
            if(nip.length == '18' && $.isNumeric(nip)){
               $.ajax({
                   type: 'POST',
                   dataType: 'json',
                   url: '<?=base_url()?>kegiatan/search_pegawai_by_nip',
                   data: {nip: $(this).val()},
                   success: function (res) {
                       if(res.error == false){
                           $("#nm_peserta").val(res.pegawai.nm_pegawai);
                           $("#nip").val(res.pegawai.nip);
                           $("#golongan").val(res.pegawai.golongan);
                           $("#jabatan").val(res.pegawai.status_jabatan);
                           $("#no_npwp").val(res.pegawai.npwp);
                           $('#hotel').focus();
                       }
                   },
                   error: function (er) {
                       console.log(er.responseText());
                   }

               });
            }
        });

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
</div>
            <div class="modal-footer no-padding-top">
                <button type="button" id="simpan-peserta" class="btn bg-blue btn-sm btn-labeled"><b><i class="icon-floppy-disk"></i></b>Simpan</button>
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade internal_eksternal" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 id="" class="modal-title">Tambah Peserta Eksternal</h4>
            </div>
            <div class="modal-body" id="" style="overflow:hidden;">
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
        <form action="#" id="" class="form-horizontal" method="post" accept-charset="utf-8">
            <input type="hidden" id="peserta_kegiatan_id" name="peserta_kegiatan_id" value="">
            <input type="hidden" id="kegiatan_id" name="kegiatan_id" value="51">
            <input type="hidden" id="jenis_kegiatan_id" name="jenis_kegiatan_id" value="1">

            <div class="alert bg-danger" id="error_info2" style="display: none;"></div>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Status <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="status_peserta_id" id="status_peserta_id">
                                <option>-- Pilih Status Peserta --</option>
                                <option value="1">Peserta</option>
                                <option value="2">Narasumber</option>
                                <option value="3">Moderator</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Uang Transport</label>
                        <div class="col-sm-8">
                            <input type="text" id="total_transport" name="total_transport" onkeypress="hitung()" onkeyup="hitung()" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Uang Saku</label>
                        <div class="col-sm-8">
                            <input type="text" id="uang_saku" name="uang_saku" onkeypress="hitung()" onkeyup="hitung()" class="form-control" value="0">
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Honor</label>
                        <div class="col-sm-8">
                            <input type="text" id="honor" name="honor" onkeypress="hitung()" onkeyup="hitung()" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">PPN</label>
                        <div class="col-sm-8">
                            <input type="text" id="ppn" name="ppn" onkeypress="hitung()" onkeyup="hitung()" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Total</label>
                        <div class="col-sm-8">
                            <input type="text" id="total" name="total" onclick="hitung()" class="form-control" value="0" readonly="">
                        </div>
                    </div>
                </div>
                
            </div>
<ul class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content" id="ui-id-2" tabindex="0" style="display: none;"></ul></form>
<script src="<?=base_url()?>assets/js/forms/bootstrap_select.min.js"></script>


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

        $("#nm_peserta").autocomplete({
            source: function(request, response){
                var nama = $("#nm_peserta").val();

                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>kegiatan/autocomplete_pegawai_by_nama",
                    data: "nama="+nama,
                    dataType: "json",
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function( event, ui) {
                $("#nm_peserta").val(ui.item.label);
                $("#nip").val(ui.item.nip);
                $("#golongan").val(ui.item.golongan);
                $("#jabatan").val(ui.item.status_jabatan);
                $("#alamat_peserta").val(ui.item.alamat);
                $("#nm_instansi").val(ui.item.instansi);
                $("#no_npwp").val(ui.item.npwp);

                $('#hotel').focus();

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

        $('#nm_peserta').autocomplete('option', 'appendTo', '#frm-peserta');

        $('#nip').on('blur', function(e){
            e.preventDefault();
            var nip = $(this).val();
            if(nip.length == '18' && $.isNumeric(nip)){
               $.ajax({
                   type: 'POST',
                   dataType: 'json',
                   url: '<?=base_url()?>kegiatan/search_pegawai_by_nip',
                   data: {nip: $(this).val()},
                   success: function (res) {
                       if(res.error == false){
                           $("#nm_peserta").val(res.pegawai.nm_pegawai);
                           $("#nip").val(res.pegawai.nip);
                           $("#golongan").val(res.pegawai.golongan);
                           $("#jabatan").val(res.pegawai.status_jabatan);
                           $("#no_npwp").val(res.pegawai.npwp);
                           $('#hotel').focus();
                       }
                   },
                   error: function (er) {
                       console.log(er.responseText());
                   }

               });
            }
        });

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
</div>
            <div class="modal-footer no-padding-top">
                <button type="button" id="simpan-peserta" class="btn bg-blue btn-sm btn-labeled"><b><i class="icon-floppy-disk"></i></b>Simpan</button>
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="<?=base_url()?>assets/js/sweetalert.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/full.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/interactions.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/fullcalendar-3.1.0/lib/moment.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/legacy.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/forms/daterangepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/forms/picker.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/forms/picker.date.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/forms/picker.time.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/forms/id_ID.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/forms/fileinput.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/forms/tokenfield.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/tables/footable.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/pnotify.min.js"></script>

<script type="text/javascript">
    $(function(){
        $('.select').select2({
            minimumResultsForSearch: Infinity
        });

        
        var tanggal_mulai = $('#tanggal_mulai').pickadate({format: 'dd/mm/yyyy'});
        var tanggal_akhir = $('#tanggal_akhir').pickadate({format: 'dd/mm/yyyy'});
        var waktu_mulai = $('#waktu_mulai').pickatime({format: 'H:i A', formatSubmit: 'HH:i', min: [7,0], max:[6,30]});
        var waktu_akhir = $('#waktu_akhir').pickatime({format: 'H:i A', formatSubmit: 'HH:i', min: [7,0], max:[6,30]});

        $('.btn-save').on('click', function(e){
            e.preventDefault();

            var options = {};
            options.hide = true;
            options.buttons = {
                closer: true,
                sticker: true
            };

            options.opacity = 1;
            options.width = PNotify.prototype.options.width;

            $.ajax({
                type: "POST",
                dataType: "json",
                data: $('#frm-kegiatan').serializeArray(),
                url: "<?=base_url()?>kegiatan/save_kegiatan",
                success: function(r){
                    if(r.error == false){
                        $('#error_info').html('').fadeOut('slow');

                        options.title = "Sukses";
                        options.text  = r.message;
                        options.addclass = "bg-success";
                        options.type = r.type;
                        options.icon = "icon-checkmark3";

                        $('#kegiatan_id').val(r.kegiatan_id);

                        if(r.flag == 'insert'){
                            getListLampiran(r.kegiatan_id);
                            getListUndangan(r.kegiatan_id);
                        }

                        $('ul.tab-menu li:eq(1)').removeClass('disabled', true).find('a').attr('data-toggle', 'tab');
                        $('ul.tab-menu li:eq(2)').removeClass('disabled', true).find('a').attr('data-toggle', 'tab');
                        $('.tab-menu a[href="#lampiran-tab"]').tab('show');

                        new PNotify(options);
                    } else {
                        var error_info = '<span class="text-semibold">Error!</span>'+ r.message;

                        $('#error_info').html(error_info).fadeIn('slow');
                    }
                },
                error: function(){
                    options.title       = "Error";
                    options.text        = "Data kegiatan gagal disimpan!";
                    options.addclass    = "bg-danger";
                    options.type        = "error";
                    options.icon        = "icon-blocked";

                    new PNotify(options);
                }
            });
        });

        $('#jenis_kegiatan_id').on('change', function(e){
            if($(this).val() !== '3'){
                $('.perjadin').hide();
                $('.non-perjadin').fadeIn('slow');
            } else {
                $('.non-perjadin').hide();
                $('.perjadin').fadeIn('slow');
            }
        });

        $('.select').select2({width: 'resolve'});

        $('#propinsi_id').on('change', function(){
            var prop_id = $(this).val();
            $('#prop_id_tmp').val(prop_id);
            $('#kota_id_tmp').val('');
            $('#kota_id').select2().html('').trigger('change');

            getListKota(prop_id);
        });

        $('#kota_id').on('change', function(){
            var kota_id = $(this).val();
            $('#kota_id_tmp').val(kota_id);
        });

        function getListKota(prop_id, kota_id){
            $.ajax({
                type: 'POST',
                url: '<?=base_url()?>kegiatan/get_list_kota',
                data: 'propinsi_id='+prop_id+'&kota_id='+kota_id,
                success: function(res){
                    $('#kota_id').html(res).trigger('change');
                },
                error: function(e){
                    alert('Error: '+e);
                }
            });
        }

        // Add class on init
        $('.tokenfield-primary').on('tokenfield:initialize', function (e) {
            $(this).parent().find('.token').addClass('bg-primary')
        });

        // Initialize plugin
        $('.tokenfield-primary').tokenfield();

        // Add class when token is created
        $('.tokenfield-primary').on('tokenfield:createdtoken', function (e) {
            $(e.relatedTarget).addClass('bg-primary')
        });

        $('table.list-lampiran').footable();

        function getListLampiran(id){
            $.ajax({
                type: "POST",
                url: "<?=base_url()?>kegiatan/get_list_lampiran",
                data: {id: id},
                success: function(res){
                    $('#list-lampiran').html(res).fadeIn('slow');
                }
            });
        }

        function getListUndangan(id){
            $.ajax({
                type: "POST",
                url: "<?=base_url()?>kegiatan/get_list_peserta",
                data: {id: id},
                success: function(res){
                    $('#list-peserta').html(res).fadeIn('slow');
                }
            });
        }

        $('#lampiran').fileinput({
            uploadUrl: "<?=base_url()?>kegiatan/upload_lampiran", // server upload action
            uploadAsync: false,
            minFileCount: 1,
            maxFileCount: 5,
            uploadExtraData: function() {
                var obj = {}
                obj['kegiatan_id'] = $('#kegiatan_id').val();
                return obj;
            },
            showPreview: false,
            allowedFileExtensions: ['jpg','png','xls','xlsx','pdf','ppt','pptx','doc','docx'],
            elErrorContainer: '#kv-error-2'
        }).on('filebatchpreupload', function(event, data, id, index) {
            $('#kv-success-2').html('<h4>Status Upload</h4><ul></ul>').hide();
        }).on('filebatchuploadsuccess', function(event, data) {
            var out = '';
            $.each(data.files, function(key, file) {
                var fname = file.name;
                out = out + '<li>' + 'File terupload file # ' + (key + 1) + ' - '  +  fname + ' dengan sukses.' + '</li>';
            });
            $('#kv-success-2 ul').append(out);
            $('#kv-success-2').fadeIn('slow');

            getListLampiran($('#kegiatan_id').val());
        });

        $('#eksternal-tab').delegate('button#btn-add-peserta', 'click', function(e){
            e.preventDefault();
            var title = ($('#jenis_kegiatan_id').val() == '3')?'Perjadin':'FGD / Rapat / Seminar';
            $('#modal_title').html('Tambah Peserta Kegiatan ' + title);

            $.ajax({
                type: "POST",
                url: "<?=base_url()?>kegiatan/form_peserta_add",
                data: {id: $('#kegiatan_id').val(),jenis_kegiatan_id: $('#jenis_kegiatan_id').val()},
                success: function (result) {
                    $('#modal_content').html(result);
                    if($('#jenis_kegiatan_id').val() == '3'){
                        var tanggal_mulai2 = $('#tanggal_mulai2').pickadate({format: 'dd/mm/yyyy'});
                        var tanggal_akhir2 = $('#tanggal_akhir2').pickadate({format: 'dd/mm/yyyy'});

                        tanggal_mulai2.pickadate('picker').set('select', tanggal_mulai.val(), {format: 'dd/mm/yyyy'});
                        tanggal_akhir2.pickadate('picker').set('select', tanggal_akhir.val(), {format: 'dd/mm/yyyy'});
                    }
                },
                error: function(er){
                    new PNotify({
                        title: 'Error',
                        text: 'Terjadi kesalahan gagal load form tambah peserta kegiatan!',
                        icon: 'icon-blocked',
                        type: 'error',
                        addclass: 'bg-danger'
                    });
                }
            });
            $('#mdl_undangan').modal('show');
        });

        $('#simpan-peserta').on('click', function(e){
            e.preventDefault();

            var options = {};
            options.hide = true;
            options.buttons = {
                closer: true,
                sticker: true
            };

            options.opacity = 1;
            options.width = PNotify.prototype.options.width;


            $.ajax({
                type:   "POST",
                dataType: "json",
                data: $('#frm-peserta').serializeArray(),
                url: "<?=base_url()?>kegiatan/save_peserta",
                success: function(response){
                    if(response.error == false){
                        $('#error_info2').html('').fadeOut('slow');

                        options.title = "Sukses";
                        options.text  = response.message;
                        options.addclass = "bg-success";
                        options.type = response.type;
                        options.icon = "icon-checkmark3";

                        getListUndangan($('#kegiatan_id').val());

                        $('#mdl_undangan').modal('hide');

                        new PNotify(options);
                    } else {
                        var error_info2 = '<span class="text-semibold">Error!</span>'+ response.message;

                        $('#error_info2').html(error_info2).fadeIn('slow');
                    }
                },
                error: function(){
                    options.title       = "Error";
                    options.text        = "Data peserta kegiatan gagal disimpan!";
                    options.addclass    = "bg-danger";
                    options.type        = "error";
                    options.icon        = "icon-blocked";

                    new PNotify(options);
                }

            });
        });

        $('#tab-kegiatan a').on('shown.bs.tab', function (e) {
            var active = $.trim($('#tab-kegiatan .active').text());
            if(active === 'Kegiatan'){
                $('.btn-save').show();
            } else {
                $('.btn-save').hide();
            }
        });

        $('#mdl_undangan').on('hide.bs.modal',function(e){
            $('#simpan-peserta').show();
        });

                getListLampiran('43');
        getListUndangan('43');
        $('#jenis_kegiatan_id').change();

        // tanggal_mulai.pickadate('picker').set('select', '', {format: 'dd/mm/yyyy'});
        // tanggal_akhir.pickadate('picker').set('select', '', {format: 'dd/mm/yyyy'});

        // waktu_mulai.pickatime('picker').set('select', '', {format: 'H:i A', formatSubmit: 'HH:i'});
        // waktu_akhir.pickatime('picker').set('select', '', {format: 'H:i A', formatSubmit: 'HH:i'});

        
    });
</script>
    <!--Footer -->
    <footer class="footer-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="footer-left">
                    <span>&copy; 2017 - Badan Ekonomi Kreatif Indonesia.</span>
                </div>
            </div>
        </div>
    </div>
</footer>    <!--/Footer-->

</section>
<!--/Page Container-->

<ul class="fab-menu fab-menu-fixed fab-menu-bottom-right" data-fab-toggle="hover">
    <li>
        <a class="fab-menu-btn btn bg-info btn-float btn-rounded btn-icon">
            <i class="fab-icon-open icon-plus2"></i>
            <i class="fab-icon-close icon-cross2"></i>
        </a>

        <ul class="fab-menu-inner">
            <li>
                <div class="fab-label-visible" data-fab-label="Arsip Saya">
                    <a href="<?=base_url()?>arsip/saya" class="btn btn-default btn-rounded btn-icon btn-float">
                        <i class="icon-folder"></i>
                    </a>
                </div>
            </li>
            <li>
                <div class="fab-label-visible" data-fab-label="Arsip Publik">
                    <a href="<?=base_url()?>arsip" class="btn btn-default btn-rounded btn-icon btn-float">
                        <i class="icon-folder-open"></i>
                    </a>
                </div>
            </li>
            <li>
                <div class="fab-label-visible" data-fab-label="Tambah Kegiatan">
                    <a href="<?=base_url()?>kegiatan/add" class="btn btn-default btn-rounded btn-icon btn-float">
                        <i class="icon-calendar52"></i>
                    </a>
                </div>
            </li>
        </ul>
    </li>
</ul>

<!-- Global scripts -->
<script src="<?=base_url()?>assets/js/jquery.slimscroll.js"></script>
<script src="<?=base_url()?>assets/js/smart-resize.js"></script>
<script src="<?=base_url()?>assets/js/blockui.min.js"></script>
<script src="<?=base_url()?>assets/js/wow.min.js"></script>
<script src="<?=base_url()?>assets/js/fancybox.min.js"></script>
<script src="<?=base_url()?>assets/js/venobox.js"></script>
<script src="<?=base_url()?>assets/js/forms/uniform.min.js"></script>
<script src="<?=base_url()?>assets/js/forms/switchery.js"></script>
<script src="<?=base_url()?>assets/js/forms/select2.min.js"></script>
<script src="<?=base_url()?>assets/js/core.js"></script>
<!-- /global scripts -->
<!-- Page scripts -->
<script type="text/javascript" src="<?=base_url()?>assets/js/app/app.js"></script>
<!-- /page scripts -->
</body>
</html>

<!-- <div id="tbl-kegiatan_filter" class="dataTables_filter"><label><span>Pencarian:</span> <input type="search" class="" placeholder="Pencarian..." aria-controls="tbl-kegiatan"></label></div> -->
