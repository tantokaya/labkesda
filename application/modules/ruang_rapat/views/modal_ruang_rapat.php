<table class="table table-borderless">
    <tbody>
    <tr>
        <td style="width: 16%;">Tanggal</td>
        <td style="width: 1%;">:</td>
        <td class="text-left"><div id="mdl_tanggal"></div></td>
    </tr>
    <tr>
        <td>Nama Ruangan</td>
        <td>:</td>
        <td><div class="ruang_name"></div></td>
    </tr>
    </tbody>
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
        <?php if(isset($ruang_rapat)):?>
            <?php
                $i = 1; 
                foreach($ruang_rapat as $r):?>
            <tr>
                <td><?=$i++?></td>
                <td><?=$r['deskripsi_rapat']?></td>
                <td><?=date('H:i',strtotime($r['jam_mulai']))?> - <?=date('H:i',strtotime($r['jam_selesai']))?> WIB</td>
                <td><?=$r['pic']?></td>
                <td><?=$r['unit_kerja']?></td>
            </tr>
            <?php endforeach;?>
        <?php else:?>
            <tr>
                <td colspan="5">Belum ada jadwal rapat</td>
            </tr>    
        <?php endif;?>
    </tbody>
</table>