<div class="table-responsive">
    <table class="table table-striped">
        <tbody>
        <tr>
            <td style="width: 28%;">Nama Peserta</td>
            <td style="width: 1%;">:</td>
            <td style="width: 76%;"><?=$peserta['nm_peserta'];?></td>
        </tr>
        <tr>
            <td>Alamat Peserta</td>
            <td>:</td>
            <td><?=$peserta['alamat_peserta'];?></td>
        </tr>
        <tr>
            <td>Nama Instansi</td>
            <td>:</td>
            <td><?=$peserta['nm_instansi'];?></td>
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
            <td>No. Telepon</td>
            <td>:</td>
            <td><?=$peserta['no_telepon'];?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><?=$peserta['email'];?></td>
        </tr>
        <tr>
            <td>No. NPWP</td>
            <td>:</td>
            <td><?=$peserta['no_npwp'];?></td>
        </tr>
        <tr>
            <td>Status Peserta</td>
            <td>:</td>
            <td><?=$peserta['status_peserta'];?></td>
        </tr>
        <tr>
            <td>Uang Transport</td>
            <td>:</td>
            <td><?=$peserta['total_transport'];?></td>
        </tr>
        <tr>
            <td>Uang Saku</td>
            <td>:</td>
            <td><?=$peserta['uang_saku'];?></td>
        </tr>
        <tr>
            <td>Honor</td>
            <td>:</td>
            <td><?=$peserta['honor'];?></td>
        </tr>
        <tr>
            <td>PPN</td>
            <td>:</td>
            <td><?=$peserta['ppn'];?></td>
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