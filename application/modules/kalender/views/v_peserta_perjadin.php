<div class="table-responsive">
    <table class="table table-striped">
        <tbody>
            <tr>
                <td style="width: 28%;">NIP</td>
                <td style="width: 1%;">:</td>
                <td style="width: 76%;"><?=$peserta['nip'];?></td>
            </tr>
            <tr>
                <td>Nama Pegawai</td>
                <td>:</td>
                <td><?=$peserta['nm_peserta'];?></td>
            </tr>
            <tr>
                <td>Golongan</td>
                <td>:</td>
                <td><?=$peserta['golongan'];?></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td><?=$peserta['jabatan'];?></td>
            </tr>
            <tr>
                <td>Tanggal Mulai Dinas</td>
                <td>:</td>
                <td><?=$this->functions->convert_date_indo(array('datetime' => $peserta['tanggal_mulai']));?></td>
            </tr>
            <tr>
                <td>Tanggal Selesai Dinas</td>
                <td>:</td>
                <td><?=$this->functions->convert_date_indo(array('datetime' => $peserta['tanggal_akhir']));?></td>
            </tr>
            <tr>
                <td>Nama Hotel / Penginapan</td>
                <td>:</td>
                <td><?=$peserta['hotel'];?></td>
            </tr>
            <tr>
                <td>Alamat Hotel / Penginapan</td>
                <td>:</td>
                <td><?=$peserta['alamat_hotel'];?></td>
            </tr>
            <tr>
                <td>Transport Pergi</td>
                <td>:</td>
                <td><?=$peserta['transport_pergi'];?></td>
            </tr>
            <tr>
                <td>Transport Pulang</td>
                <td>:</td>
                <td><?=$peserta['transport_pulang'];?></td>
            </tr>
            <tr>
                <td>Uang Harian</td>
                <td>:</td>
                <td><?=$peserta['uang_harian'];?></td>
            </tr>
            <tr>
                <td>Total Transport</td>
                <td>:</td>
                <td><?=$peserta['total_transport'];?></td>
            </tr>
            <tr>
                <td>Total Seluruhnya</td>
                <td>:</td>
                <td><?=$peserta['total'];?></td>
            </tr>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(function(){
        $('#simpan-peserta').hide();
    });
</script>