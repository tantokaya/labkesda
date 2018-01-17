<table class="table table-transaksi">
    <thead>
    <tr>
        <th>Qty</th>
        <th>Nama</th>
        <th>Harga</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($data->num_rows() > 0) {
        $g_total = 0;
        foreach ($data->result_array() as $db) {
            $total = $db['produk_jml'] * $db['harga'];

            ?>
            <tr>
                <td><?= $db['produk_jml']; ?></td>
                <td><?= $db['tindakan']; ?></td>
                <td align="right"><?= 'Rp ' . number_format($total); ?></td>
            </tr>

            <?php $g_total = $g_total + $total;
        }
    }
    ?>
    </tbody>
    <tr>
        <td colspan="2" align="center" style="font-weight: bold">Total</td>
        <td align="right" name="total_beli" id="total_beli" style="font-weight: bold; font-style: italic"
            data-gtotal="<?= $g_total; ?>"><?= 'Rp ' . number_format($g_total); ?></td>
    </tr>
</table>