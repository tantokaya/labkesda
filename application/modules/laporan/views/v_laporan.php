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
