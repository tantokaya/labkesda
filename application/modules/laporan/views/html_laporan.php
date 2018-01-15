
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Daftar Kegiatan - Badan Ekonomi Kreatif Indonesia</title>
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
            <li role="presentation" class="active" id="tab-menu"><a href="#menu" aria-controls="menu" role="tab" data-toggle="tab"><i class="icon-home2"></i></a></li>
            <li role="presentation" class="" id="tab-arsip"><a href="#arsip" aria-controls="arsip" role="tab" data-toggle="tab"><i class="icon-folder-open"></i></a></li>
            <li role="presentation" class="" id="tab-profile"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="icon-users2"></i></a></li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active fadeIn" id="menu">
                <ul class="sidebar-accordion acc-menu">

                    <li class="list-title">Menu</li>
                    <li><a href="<?=base_url()?>dashboard"><i class="icon-display4"></i> Dashboard</a>

                    <li><a href="#"><i class=" icon-file-text2"></i> Master</a><ul class="acc-menu"><li><a href="#"><!--<i class="fa fa-folder-open"></i>-->Kegiatan</a><ul class="acc-menu"><li><a href="<?=base_url()?>jenis_kegiatan"> Jenis Kegiatan</a></li><li><a href="<?=base_url()?>tipe_kegiatan"> Tipe Kegiatan</a></li><li><a href="<?=base_url()?>status_peserta_kegiatan"> Status Peserta/Undangan</a></li></ul></li><li><a href="#"><!--<i class="fa fa-folder-open"></i>-->Kepegawaian</a><ul class="acc-menu"><li><a href="<?=base_url()?>agama"> Agama</a></li><li><a href="<?=base_url()?>eselon"> Eselon</a></li><li><a href="<?=base_url()?>golongan"> Golongan</a></li><li><a href="<?=base_url()?>pegawai"> Pegawai</a></li><li><a href="<?=base_url()?>status_jabatan"> Status Jabatan</a></li><li><a href="<?=base_url()?>status_pegawai"> Status Pegawai</a></li></ul></li><li><a href="<?=base_url()?>wilayah_administrasi"> Wilayah Administrasi</a></li><li><a href="#"><!--<i class="fa fa-folder-open"></i>-->SBK</a><ul class="acc-menu"><li><a href="<?=base_url()?>sbk_fgd"> FGD</a></li><li><a href="<?=base_url()?>sbk_perjadin"> Perjadin</a></li></ul></li><li><a href="#"><!--<i class="fa fa-folder-open"></i>-->Ruang Rapat</a><ul class="acc-menu"><li><a href="<?=base_url()?>lantai"> Lantai</a></li><li><a href="<?=base_url()?>ruangan"> Ruangan</a></li></ul></li></ul></li><li><a href="#"><i class="icon-calendar52"></i> Kegiatan</a><ul class="acc-menu"><li><a href="<?=base_url()?>kegiatan"> Daftar Kegiatan</a></li><li><a href="<?=base_url()?>kalender"> Kalender</a></li></ul></li><li><a href="#"><i class="icon-gear"></i> Pengaturan</a><ul class="acc-menu"><li><a href="<?=base_url()?>setting_aplikasi"> Aplikasi</a></li><li><a href="#"><!--<i class="fa fa-folder-open"></i>-->Pengguna</a><ul class="acc-menu"><li><a href="<?=base_url()?>pengguna"> Daftar Pengguna</a></li><li><a href="<?=base_url()?>akses"> Grup Pengguna</a></li></ul></li><li><a href="#"><!--<i class="fa fa-folder-open"></i>-->Menu</a><ul class="acc-menu"><li><a href="<?=base_url()?>menu"> Daftar Menu</a></li><li><a href="<?=base_url()?>akses_menu"> Akses Menu</a></li></ul></li></ul></li><li><a href="<?=base_url()?>ruang_rapat"><i class="icon-table2"></i> <span>Jadwal Ruang Rapat</span></a></li><li><a href="<?=base_url()?>laporan"><i class=" icon-file-text2"></i> <span>Laporan</span></a></li>
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
    <script src="<?=base_url()?>assets/js/tables/datatables/datatables.min.js"></script>
<script src="<?=base_url()?>assets/js/tables/datatables/extensions/buttons.min.js"></script>
<script src="<?=base_url()?>assets/js/sweetalert.js"></script>

<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-calendar2 position-left"></i>Data Laporan Kegiatan
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url()?>dashboard">Home</a></li>
            <li>Laporan</li>
            <li class="active">Data Laporan Kegiatan</li>
        </ul>
    </div>
</div>

<div class="container-fluid page-content">

    <div class="panel panel-default panel-bordered">
        <div class="panel-heading">
            <h5 class="panel-title"><i class="icon-three-bars position-left"></i> Data Laporan Kegiatan</h5>
        </div>

        <div class="panel-body">
            <table id="tbl-kegiatan" width="100%" class="table table-striped table-responsive table-bordered datatable" >
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Kegiatan</td>
                    <td>Jenis</td>
                    <td>Lokasi</td>
                    <td>Satker</td>
                    <td>Tanggal Awal</td>
                    <td>Tanggal Akhir</td>
                    <td>Status</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>D-1 FGD Persiapan Penyusunan Data Maining</td>
                    <td>FGD</td>
                    <td>Hotel Aryaduta</td>
                    <td>Deputi I</td>
                    <td>20/03/2017</td>
                    <td>20/03/2017</td>
                    <td><span class="label label-warning">Baru</span></td>
                    <td class=" text-center"><ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right"><li><a href="<?=base_url()?>laporan/ubah"><i class="icon-pencil6"></i> Ubah</a></li><li class="divider"></li><li><a href="#" class="btn-delete" data-id=""><i class="icon-trash"></i> Hapus</a></li></ul></li></ul></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>D-1 Kegiatan Kelengkapan dokumen persiapan penumbuh kembangan klaster pusat unggulan ekonomi kreatif</td>
                    <td>Rapat</td>
                    <td>Ruang Rapat D1 lt. 18</td>
                    <td>Deputi I</td>
                    <td>11/03/2017</td>
                    <td>12/03/2017</td>
                    <td><span class="label label-success">Selesai</span></td>
                    <td class=" text-center"><ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right"><li><a href=""><i class="icon-pencil6"></i> Ubah</a></li><li class="divider"></li><li><a href="#" class="btn-delete" data-id=""><i class="icon-trash"></i> Hapus</a></li></ul></li></ul></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>R01 - Keuangan Pembekalan Teknis Pertanggungjawaban keuangan</td>
                    <td>Bimbingan Teknis</td>
                    <td>Hotel Aryaduta</td>
                    <td>Deputi II</td>
                    <td>10/03/2017</td>
                    <td>11/03/2017</td>
                    <td><span class="label label-danger">Perbaikan</span></td>
                    <td class=" text-center"><ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right"><li><a href=""><i class="icon-pencil6"></i> Ubah</a></li><li class="divider"></li><li><a href="#" class="btn-delete" data-id=""><i class="icon-trash"></i> Hapus</a></li></ul></li></ul></td>
                </tr>
            </tbody>
            </table>        
        </div>
    </div>
</div>

<div id="mdl_kegiatan" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal_title_kegiatan" class="modal-title"></h4>
            </div>
            <div class="modal-body" id="modal_content_kegiatan"></div>
            <div class="modal-footer no-padding-top">
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="mdl_undangan" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="modal_title_undangan" class="modal-title"></h4>
            </div>
            <div class="modal-body" id="modal_content_undangan"></div>
            <div class="modal-footer no-padding-top">
                <button type="button" class="btn btn-default btn-sm" id="btn-batal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

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