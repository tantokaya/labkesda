<p>Status TU: <?php
    if($status_tu == 0): echo 'proses';
    elseif($status_tu == -1): echo 'perbaikan';
    elseif($status_tu == 1): echo 'selesai';
    endif
    ?></p>
<p>Reply: <?=$reply_tu?></p>
<hr>
<p>Status Keuangan:<?php
    if($status_keuangan == 0): echo 'proses';
    elseif($status_keuangan == -1): echo 'perbaikan';
    elseif($status_keuangan == 1): echo 'selesai';
    endif
    ?></p>
<p>Reply: <?= $reply_keuangan ?></p>