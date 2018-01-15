<script src="<?=base_url('assets/js/tables/datatables/datatables.min.js');?>"></script>
<script src="<?=base_url('assets/js/sweetalert.js');?>"></script>

<div class="header">
    <div class="header-content">
        <div class="page-title">
            <i class="icon-user-tie position-left"></i><?=$page_title;?>
        </div>
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard');?>">Home</a></li>
            <li>Kegiatan</li>
            <li>Peserta</li>
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
            
            <table id="myTable" width="100%" class="table table-striped table-responsive table-bordered datatable">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <td style="width: 5%;">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Abdul Razak</td>
                        <td>abdul@gmail.com</td>
                        <td>0899988847</td>
                        <td><ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right"><li><a href="#" data-title="$2" data-id="" class="btn-view" class="btn-view" data-toggle="modal" data-target="#myModal"><i class="icon-eye"></i> Lihat</a></li></ul></li></ul></td>
                    </tr>
                     <tr>
                        <td>Budi Pariaman</td>
                        <td>budi@gmail.com</td>
                        <td>081288999</td>
                        <td><ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right"><li><a href="#" data-title="$2" data-id="" class="btn-view" class="btn-view" data-toggle="modal" data-target="#myModal"><i class="icon-eye"></i> Lihat</a></li></ul></li></ul></td>
                    </tr>
                     <tr>
                        <td>Cantika Rizky</td>
                        <td>cantik@gmail.com</td>
                        <td>021 - 8989999</td>
                        <td><ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right"><li><a href="#" data-title="$2" data-id="" class="btn-view" class="btn-view" data-toggle="modal" data-target="#myModal"><i class="icon-eye"></i> Lihat</a></li></ul></li></ul></td>
                    </tr>
                     <tr>
                        <td>Fara Zita</td>
                        <td>fara@rocketmail.com</td>
                        <td>021 - 9900099</td>
                        <td><ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right"><li><a href="#" data-title="$2" data-id="" class="btn-view" class="btn-view" data-toggle="modal" data-target="#myModal"><i class="icon-eye"></i> Lihat</a></li></ul></li></ul></td>
                    </tr>
                     <tr>
                        <td>Gorby Aliandri</td>
                        <td>gorby@gmail.com</td>
                        <td></td>
                        <td><ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right"><li><a href="#" data-title="$2" data-id="" class="btn-view" class="btn-view" data-toggle="modal" data-target="#myModal"><i class="icon-eye"></i> Lihat</a></li></ul></li></ul></td>
                    </tr>
                     <tr>
                        <td>Hari Murti Laksono</td>
                        <td></td>
                        <td>0899988847</td>
                        <td><ul class="icons-list"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a><ul class="dropdown-menu dropdown-menu-right"><li><a href="#" data-title="$2" data-id="" class="btn-view" data-toggle="modal" data-target="#myModal"><i class="icon-eye"></i> Lihat</a></li></ul></li></ul></td>
                    </tr>
                </tbody>
            </table>
            
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <div class="tabable">
                                <ul class="nav nav-tabs nav-tabs-highlight nav-bordered tab-menu">
                                    <li class="active"><a href="#profile-tab" data-toggle="tab" aria-expanded="true"><i class="icon-calendar52 position-left"></i> Profile</a></li>
                                    <li><a href="#keikut-sertaan-tab" data-toggle="tab" aria-expanded="false"><i class="icon-cloud-upload2 position-left"></i> Keikut Sertaan</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="profile-tab">
                                        <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                            <tr>
                                                <td style="width: 28%;">Nama</td>
                                                <td style="width: 1%;">:</td>
                                                <td style="width: 76%;">Abdul Razak</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td>razak@gmail.com</td>
                                            </tr>
                                            <tr>
                                                <td>NPWP</td>
                                                <td>:</td>
                                                <td>01.123.456.7-521.000</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td>Jakarta barat, Jembatan Besi</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Instansi</td>
                                                <td>:</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Jabatan</td>
                                                <td>:</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>Golongan</td>
                                                <td>:</td>
                                                <td>-</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        </div>  
                                    </div>

                                    <div class="tab-pane" id="keikut-sertaan-tab">
                                        <div class="table-responsive">
                                        <p>Total Kegiatan <span class="label label-primary">3</span>
                                        </p>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Jenis Kegiatan</th>
                                                    <th>Tanggal</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Rapat</td>
                                                    <td>10/04/2017</td>
                                                    <td>Moderator</td>
                                                </tr>
                                                <tr>
                                                    <td>Rapat</td>
                                                    <td>01/05/2017</td>
                                                    <td>Peserta</td>
                                                </tr>
                                                <tr>
                                                    <td>FGD</td>
                                                    <td>30/08/2017</td>
                                                    <td>Peserta</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>  
                                    </div>
                                </div>

                            </div>
                            
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
    } );
</script>

