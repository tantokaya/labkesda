<div class="product-list" id="list-produk-finish">
<?php
if ($data->num_rows() > 0) {
foreach ($data->result_array() as $db) {
?>
    <span class="product product_btn" id="trx_product"
          data-kdtindakan="<?= $db['kd_tindakan']; ?>"
          data-tarif="<?= $db['harga']; ?>"
          data-tindakan="<?= $db['tindakan']; ?>"
          data-goltindid="<?= $db['gol_tindakan_id']; ?>"
          data-trkasirid="<?= $trkasir_id; ?>">
            <div class="product-img">
                <span class="price-tag"> Rp <?= number_format($db['harga']); ?></span>
            </div>
            <div class="product-name"><?= $db['tindakan']; ?></div>
        </span>
<?php
} }
?>
</div>

<script type="text/javascript" src="<?= base_url('assets/js/app/pos.js'); ?>"></script>