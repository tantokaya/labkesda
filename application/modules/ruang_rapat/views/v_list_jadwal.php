<div class="table-responsive">
    <table class="table table-borderless">
        <tr>
            <td style="width: 16%;">Tanggal</td>
            <td style="width: 1%;">:</td>
            <td class="text-left"><?=$this->functions->format_tgl_cetak($tanggal);?></td>
        </tr>
        <tr>
            <td>Nama Ruangan</td>
            <td>:</td>
            <td><?=$ruangan['nama_ruang'];?></td>
        </tr>
    </table>
    <br>
    <table class="table table-striped table-bordered table-hover">
        <thead>
           <tr>
               <th>No</th>
               <th>Perihal / Deskripsi Rapat</th>
               <th>Jam</th>
               <th>PIC</th>
               <th>Satker</th>
           </tr>
        </thead>
        <tbody>
            <?php if(count($list_jadwal) > 0) : ?>
                <?php $i=1; foreach($list_jadwal as $t) : ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$t['perihal'];?></td>
                        <td><?=$t['jam'];?></td>
                        <td><?=$t['pic'];?></td>
                        <td><?=$t['unit_kerja'];?></td>
                    </tr>
                <?php $i++; endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">Belum ada jadwal rapat</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>