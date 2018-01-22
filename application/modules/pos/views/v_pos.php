<style media="all" type="text/css">
    .alignCenter {
        text-align: center;
    }

    .namaPelanggan {
        background-color: cornsilk;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {

        //view pelanggan
        $("#pelanggan-view").hide();
        $("#struk-kasir").hide();
        $(".payment-buttons").hide();

        $("#pelanggan-btn-view").click(function () {
            $("#pelanggan-view").show();
            $("#kasir-view").hide();
        })

        $("#pelanggan-btn-hide").click(function () {
            $("#pelanggan-view").hide();
            $("#kasir-view").show();
        })


        $("#pelanggan-btn-view").html("<i class='fa fa-user'></i>Pelanggan");
        $("#pelanggan-btn-view").val();

        //view Pembayaran
        $('#pembayaran-view').hide();

        $("#pembayaran-btn-view").click(function () {
            $("#pelanggan-view").hide();
            $("#kasir-view").hide();
            $("#pembayaran-view").show();

            $(".total").html($('#total_beli').html());
            $('#nm-pelanggan').html($('#pelanggan-btn-view').html());

        })

        $("#pembayaran-btn-hide").click(function () {
            $("#pelanggan-view").hide();
            $("#kasir-view").show();
            $("#pembayaran-view").hide();
        })
        $('#pembayaran').hide();
        $('.paymentmethods').click(function(){
            $('.paymentlines-empty').hide() ;
            $('#pembayaran').show();
            $('#metode').html($('.paymentmethod').html());
            $('#ttl_bayar').html($('.total').html());
            $('#ttl_bayar_input').focus();
            $('.payment-buttons').show();
        });

        $('#next_order').click(function(){
           window.location.reload();
        });

        //data per Kategori
        $('.kategori').click(function(){
            $('#list-produk-start').hide();
            $('#tampil_perkategori').show();
        })

    });
</script>

<!--  View Transaksi kasir  -->
<div class="pos-content" id="kasir-view">
    <div class="window">
        <div class="subwindow">
            <div class="subwindow-container">
                <div class="subwindow-container-fix screens">
                    <div class="product-screen screen">
                        <div class="leftpane">
                            <div class="window">
                                <div class="subwindow">
                                    <div class="subwindow-container">
                                        <div class="subwindow-container-fix">
                                            <div class="order-container">
                                                <div class="order-scroller touch-scrollable">
                                                    <div class="order" id="jualan">
                                                        <div class="order-empty">
                                                            <i class="fa fa-shopping-cart"></i>
                                                            <h1>Transaksi Anda masih kosong</h1>
                                                        </div>
                                                        <div class="order-ok">
                                                            <div id="tampil_data"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="subwindow collapsed">
                                    <div class="subwindow-container">
                                        <div class="subwindow-container-fix pads">
                                            <div class="actionpad">
                                                <button class="button set-customer" id="pelanggan-btn-view"></button>
                                                <button class="button pay" id="pembayaran-btn-view">
                                                    <div class="pay-circle">
                                                        <i class="fa fa-chevron-right"></i>
                                                    </div>Pembayaran
                                                </button>
                                            </div>
                                            <div class="numpad">
                                                <button class="input-button number-char">1</button>
                                                <button class="input-button number-char">2</button>
                                                <button class="input-button number-char">3</button>
                                                <button class="mode-button selected-mode" data-mode="quantity">Qty</button>
                                                <br/>
                                                <button class="input-button number-char">4</button>
                                                <button class="input-button number-char">5</button>
                                                <button class="input-button number-char">6</button>
                                                <button class="mode-button" data-mode="discount">Diskon</button>
                                                <br/>
                                                <button class="input-button number-char">7</button>
                                                <button class="input-button number-char">8</button>
                                                <button class="input-button number-char">9</button>
                                                <button class="mode-button" data-mode="price">Harga</button>
                                                <br/>
                                                <button class="input-button numpad-minus">+/-</button>
                                                <button class="input-button number-char">0</button>
                                                <button class="input-button number-char">.</button>
                                                <button class="input-button numpad-backspace">
                                                    <img height="21" src="<?= base_url('assets/pos/backspace.png'); ?>" style="pointer-events: none;" width="24">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="rightpane">
                            <table class="layout-table">
                                <tbody>
                                <tr class="header-row">
                                    <td class="header-cell">
                                        <div>
                                            <header class="rightpane-header">
                                                <div class="breadcrumbs">
                                                <span class="breadcrumb">
                                                  <span class=" breadcrumb-button breadcrumb-home">
                                                    <i class="fa fa-home"></i>
                                                  </span>
                                                </span>
                                                </div>
                                                <div class="searchbox">
                                                    <input placeholder="Cari Produk">
                                                    <span class="search-clear"></span>
                                                </div>
                                            </header>
                                            <div class="categories">
                                                <div class="category-list-scroller touch-scrollable">
                                                    <div class="category-list simple">
                                                        <?php foreach ($gol_tindakan as $gt): ?>
                                                            <span class="category-simple-button js-category-switch kategori" data-goltind="<?= $gt->gol_tindakan_id; ?>" data-trkasirid="<?= $trkasir_id; ?>"><?= $gt->gol_tindakan_nama; ?></span>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="content-row">
                                    <td class="content-cell">
                                        <div class="content-container">
                                            <div class="product-list-container">
                                                <div class="product-list-scroller touch-scrollable">
                                                    <div class="product-list" id="list-produk-start">
                                                        <?php foreach ($tindakan as $td): ?>
                                                            <span class="product product_btn" id="trx_product"
                                                                  data-kdtindakan="<?= $td->kd_tindakan; ?>"
                                                                  data-tarif="<?= $td->harga; ?>"
                                                                  data-tindakan="<?= $td->tindakan; ?>"
                                                                  data-goltindid="<?= $td->gol_tindakan_id; ?>"
                                                                  data-trkasirid="<?= $trkasir_id; ?>">
                                                        <div class="product-img">
                                                            <!--                                                            <img src="-->
                                                            <? //= base_url('assets/pos/kosong.png'); ?><!--">-->
                                                            <span class="price-tag"> Rp <?= number_format($td->harga); ?></span>
                                                        </div>
                                                        <div class="product-name"><?= $td->tindakan; ?></div>
                                                      </span>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <div id="tampil_perkategori"></div>
                                                </div>
                                      <span class="placeholder-ScrollbarWidget">
                                      </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!--  End of View Transaksi Kasir  -->

<!--  View Pelanggan  -->

<div class="pos-content" id="pelanggan-view">
    <script type="text/javascript">
        $(document).ready(function () {

            $("#pelanggan-detail").hide();
            $("#tbl_pelanggan_hide").hide();

            $("#tbl_pelanggan_hide").click(function () {
                $("#tabel").show();
                $("#tbl_pelanggan_show").show();
                $("#tbl_pelanggan_hide").hide();
                $("#pelanggan-detail").hide();
            })

            $("#tbl_pelanggan_show").click(function () {
                $("#tabel").hide();
                $("#tbl_pelanggan_show").hide();
                $("#tbl_pelanggan_hide").show();
                $("#pelanggan-detail").show();
                $("#nm_lengkap").focus();
            })
        });
    </script>

    <div class="window">
        <div class="subwindow">
            <div class="subwindow-container">
                <div class="subwindow-container-fix screens">
                    <div class="clientlist-screen screen">
                        <div class="screen-content">
                            <section class="top-content">
                          <span class="button back" id="pelanggan-btn-hide">
                            <i class="fa fa-angle-double-left"></i> Kembali
                          </span>
                          <span class="button new-customer-kesmas" id="tbl_pelanggan_show_k">
                            <i class="fa fa-user"></i><i class="fa fa-plus"></i> Kesmas
                          </span>
                          <span class="button new-customer" id="tbl_pelanggan_show">
                            <i class="fa fa-user"></i><i class="fa fa-plus"></i> Lab
                          </span>
                          <span class="button new-customer" id="tbl_pelanggan_hide">
                            <i class="fa fa-user"></i><i class="fa fa-plus"></i>
                          </span>
                            </section>
                            <section class="full-content">
                                <div class="window">
                                    <section class="subwindow collapsed" id="pelanggan-detail">
                                        <div class="subwindow-container collapsed">
                                            <div class="subwindow-container-fix client-details-contents">
                                                <?= form_open('', array('id' => 'frm-pelanggan')); ?>
                                                <section class="client-details edit">
                                                    <div class="client-picture">
                                                        <i class="fa fa-camera"></i>
                                                        <!--<input class="image-uploader" type="file">-->
                                                    </div>
                                                    <input class="client-name" id="nm_lengkap" name="nm_lengkap"
                                                           value="<?= isset($pelanggan['nm_lengkap']) ? $pelanggan['nm_lengkap'] : set_value('nm_lengkap'); ?>">

                                                    <div class="edit-buttons">
                                                        <!--<div class="button undo">
                                                            <i class="fa fa-undo">
                                                            </i>
                                                        </div>-->
                                                        <div class="button save" id="btn-save-pelanggan">
                                                            <i class="fa fa-floppy-o">
                                                            </i>
                                                        </div>
                                                    </div>
                                                    <div class="client-details-box clearfix">
                                                        <div class="client-details-left">
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">NIK</span>
                                                                <?php if ($this->uri->segment(3) == '') { ?>
                                                                    <input style="text: 40%" type="hidden" name="kd_rekmed" id="kd_rekmed" value="<?= $kd_rekmed; ?>">
                                                                <?php } else { ?>
                                                                    <input style="width: 40%" type="hidden" name="nik" id="nik" value="<?= isset($pelanggan['kd_rekmed']) ? $pelanggan['kd_rekmed'] : set_value('kd_rekmed'); ?>">
                                                                <?php } ?>
                                                                <input style="width: 40%" type="text" name="nik" id="nik" value="<?= isset($pelanggan['nik']) ? $pelanggan['nik'] : set_value('nik'); ?>">
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">Tmp Lahir</span>
                                                                <input style="width: 40%" name="tmp_lahir" id="tmp_lahir" value="<?= isset($pelanggan['tmp_lahir']) ? $pelanggan['tmp_lahir'] : set_value('tmp_lahir'); ?>">
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">Tgl Lahir</span>
                                                                <input style="width: 25%" name="tgl_lahir" id="tgl_lahir" value="<?= isset($pelanggan['tgl_lahir']) ? $this->functions->convert_date_indo(array('datetime' => $pelanggan['tgl_lahir'])) : ''; ?>">
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">Agama</span>
                                                                <select style="height: 35px;" data-placeholder="-- Pilih Agama --" name="agama_id" id="agama_id" required>
                                                                    <option></option>
                                                                    <?php foreach ($l_agama as $t): ?>
                                                                        <?php if (isset($pelanggan['agama_id']) && $pelanggan['agama_id'] == $t['agama_id']): ?>
                                                                            <option value="<?= $t['agama_id']; ?>" selected><?= $t['agama']; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $t['agama_id']; ?>" <?= set_select('agama_id', $t['agama_id']) ?>><?= $t['agama']; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">L / P</span>
                                                                <?php foreach ($l_jenis_kelamin as $t): ?>
                                                                    <?php if (isset($pelanggan['jenis_kelamin_id']) && $pelanggan['jenis_kelamin_id'] == $t['jenis_kelamin_id']) : ?>
                                                                        <label class="radio-inline">
                                                                            <input type="radio" name="jenis_kelamin_id" id="jenis_kelamin_id" value="<?= $t['jenis_kelamin_id']; ?>" checked> <?= $t['jenis_kelamin']; ?>
                                                                        </label>
                                                                    <?php else : ?>
                                                                        <label class="radio-inline">
                                                                            <input type="radio" name="jenis_kelamin_id" id="jenis_kelamin_id" value="<?= $t['jenis_kelamin_id']; ?>" <?= set_radio('jenis_kelamin_id', $t['jenis_kelamin_id']); ?>> <?= $t['jenis_kelamin']; ?>
                                                                        </label>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">Alamat</span>
                                                                <input class="" name="alamat" id="alamat" value="<?= isset($pelanggan['alamat']) ? $pelanggan['alamat'] : set_value('alamat'); ?>">
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">Propinsi</span>
                                                                <?php $pelanggan['propinsi_id'] = isset($pelanggan['propinsi_id']) ? $pelanggan['propinsi_id'] : ''; ?>
                                                                <select name="propinsi_id" style="height: 35px; width:100%" id="propinsi_id" class="populate" required>
                                                                    <option></option>
                                                                    <?php foreach ($l_propinsi as $t): ?>
                                                                        <?php if ($pelanggan['propinsi_id'] == $t->propinsi_id): ?>
                                                                            <option value="<?php echo $t->propinsi_id; ?>" selected="selected"><?php echo $t->propinsi; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?php echo $t->propinsi_id; ?>"><?php echo $t->propinsi; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">Kota</span>
                                                                <select name="kota_id" id="kota_id" style="height:35px" required>
                                                                    <option></option>
                                                                    <?php if (isset($l_kota)): ?>
                                                                        <?php foreach ($l_kota as $t): ?>
                                                                            <?php if ($pelanggan['kota_id'] == $t->kota_id): ?>
                                                                                <option value="<?php echo $t->kota_id; ?>" selected="selected"><?php echo $t->kota; ?></option>
                                                                            <?php else : ?>
                                                                                <option value="<?php echo $t->kota_id; ?>"><?php echo $t->kota; ?></option>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium;width: 20%;">Kecamatan</span>
                                                                <select name="kecamatan_id" id="kecamatan_id" style="height: 35px" required>
                                                                    <option></option>
                                                                    <?php if (isset($l_kecamatan)): ?>
                                                                        <?php foreach ($l_kecamatan as $t): ?>
                                                                            <?php if ($pelanggan['kecamatan_id'] == $t->kecamatan_id): ?>
                                                                                <option value="<?php echo $t->kecamatan_id; ?>" selected="selected"><?php echo $t->kecamatan; ?></option>
                                                                            <?php else : ?>
                                                                                <option value="<?php echo $t->kecamatan_id; ?>"><?php echo $t->kecamatan; ?></option>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium; width: 20%;">Kelurahan</span>
                                                                <select name="kelurahan_id" id="kelurahan_id" style="height: 35px" required>
                                                                    <option></option>
                                                                    <?php if (isset($l_kelurahan)): ?>
                                                                        <?php foreach ($l_kelurahan as $t): ?>
                                                                            <?php if ($pelanggan['kelurahan_id'] == $t->kelurahan_id): ?>
                                                                                <option value="<?php echo $t->kelurahan_id; ?>" selected="selected"><?php echo $t->kelurahan; ?></option>
                                                                            <?php else : ?>
                                                                                <option value="<?php echo $t->kelurahan_id; ?>"><?php echo $t->kelurahan; ?></option>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="client-details-right">
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium; width: 20%">No KK</span>
                                                                <input class="detail" style="width: 40%" id="no_kk" name="no_kk" type="no_kk" value="<?= isset($pelanggan['no_kk']) ? $pelanggan['no_kk'] : set_value('no_kk'); ?>">
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium; width: 20%">Nama KK</span>
                                                                <input class="detail" style="width: 40%" name="nm_kk" id="nm_kk" type="text" value="<?= isset($pelanggan['nm_kk']) ? $pelanggan['nm_kk'] : set_value('nm_kk'); ?>">
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium; width: 20%">Goldar</span>
                                                                <select style="height: 35px; width: 20%" data-placeholder="-- Pilih Goldar --" name="goldar_id" id="goldar_id">
                                                                    <option></option>
                                                                    <?php foreach ($l_goldar as $t): ?>
                                                                        <?php if (isset($pelanggan['goldar_id']) && $pelanggan['goldar_id'] == $t['goldar_id']): ?>
                                                                            <option value="<?= $t['goldar_id']; ?>" selected><?= $t['goldar_nama']; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $t['goldar_id']; ?>" <?= set_select('goldar_id', $t['goldar_id']) ?>><?= $t['goldar_nama']; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium; width: 20%">Pendidikan</span>
                                                                <select style="height: 35px; width: 30%" data-placeholder="-- Pilih Pendidikan --" name="pendidikan_id" id="pendidikan_id">
                                                                    <option></option>
                                                                    <?php foreach ($l_pendidikan as $t): ?>
                                                                        <?php if (isset($pelanggan['pendidikan_id']) && $pelanggan['pendidikan_id'] == $t['pendidikan_id']): ?>
                                                                            <option value="<?= $t['pendidikan_id']; ?>" selected><?= $t['pendidikan_nama']; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $t['pendidikan_id']; ?>" <?= set_select('pendidikan_id', $t['pendidikan_id']) ?>><?= $t['pendidikan_nama']; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium; width: 20%">Pekerjaan</span>
                                                                <select style="height: 35px;" data-placeholder="-- Pilih Pekerjaan --" name="pekerjaan_id" id="pekerjaan_id" required>
                                                                    <option></option>
                                                                    <?php foreach ($l_pekerjaan as $t): ?>
                                                                        <?php if (isset($pelanggan['pekerjaan_id']) && $pelanggan['pekerjaan_id'] == $t['pekerjaan_id']): ?>
                                                                            <option value="<?= $t['pekerjaan_id']; ?>" selected><?= $t['pekerjaan_nama']; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $t['pekerjaan_id']; ?>" <?= set_select('pekerjaan_id', $t['pekerjaan_id']) ?>><?= $t['pekerjaan_nama']; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="client-detail">
                                                                <span class="label" style="color: grey; font-size: medium; width: 20%">Status</span>
                                                                <select style="height: 35px; width: 30%" data-placeholder="-- Pilih Status --" name="stmarital_id" id="stmarital_id" required>
                                                                    <option></option>
                                                                    <?php foreach ($l_stmarital as $t): ?>
                                                                        <?php if (isset($pelanggan['stmarital_id']) && $pelanggan['stmarital_id'] == $t['stmarital_id']): ?>
                                                                            <option value="<?= $t['stmarital_id']; ?>" selected><?= $t['stmarital_nama']; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $t['stmarital_id']; ?>" <?= set_select('stmarital_id', $t['stmarital_id']) ?>><?= $t['stmarital_nama']; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <?= form_close(); ?>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="subwindow" id="tabel">
                                        <div class="subwindow-container">
                                            <?php echo $this->table->generate(); ?>

                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    var oTable = $('#tbl-pelanggan').dataTable({
                                                        "bProcessing": true,
                                                        "bServerSide": true,
                                                        "sAjaxSource": '<?php echo base_url('pos/dt_pelanggan'); ?>',
                                                        "bAutoWidth": false,
                                                        "sPaginationType": "full_numbers",
                                                        "bSort": true,
                                                        "dom": '<"datatable-header"fl><"datatable-scroll-lg"t><"datatable-footer"ip>',
                                                        "language": {
                                                            "search": '<span>Pencarian:</span> _INPUT_',
                                                            "lengthMenu": '<span>Show:</span> _MENU_',
                                                            "paginate": {
                                                                'first': 'Pertama',
                                                                'last': 'Terakhir',
                                                                'next': '&rarr;',
                                                                'previous': '&larr;'
                                                            }
                                                        },
                                                        lengthMenu: [10, 25, 50, 75, 100],
                                                        "fnInitComplete": function () {
                                                            //oTable.fnAdjustColumnSizing();
                                                        },
                                                        "columns": [
                                                            {
                                                                "data": "nik",
                                                                "sName": "nik",
                                                                "sClass": "alignCenter",
                                                                "sWidth": "5%"
                                                            },
                                                            {"data": "kode", "sName": "kode"},
                                                            {
                                                                "data": "nm_lengkap",
                                                                "sName": "nm_lengkap",
                                                                "sClass": "namaPelanggan"
                                                            },
                                                            {"data": "tgl_lahir", "sName": "tgl_Lahir"},
                                                            {"data": "alamat", "sName": "alamat"},

                                                        ],
                                                        "aoColumnDefs": [
                                                            {
                                                                'bSortable': true,
                                                                'bSearchable': true,
                                                                'aTargets': [-1]
                                                            }
                                                        ],
                                                        "fnServerData": function (sSource, aoData, fnCallback) {

                                                            $.ajax
                                                            ({
                                                                'dataType': 'json',
                                                                'type': 'POST',
                                                                'url': sSource,
                                                                'data': aoData,
                                                                'success': fnCallback
                                                            });
                                                        }
                                                    });

                                                    $('.dataTables_filter input[type=search]').attr('placeholder', 'Pencarian...');

                                                    $('#tbl-pelanggan').delegate('span.btn-plg', 'click', function (e) {
                                                        e.preventDefault();
                                                        var that = $(this);

                                                        $("#pelanggan-detail").hide();
                                                        $("#tabel").show();
                                                        $("#pelanggan-btn-view").html("<i class='fa fa-user'></i>" + that.data('nama'));
                                                        $("#pelanggan-btn-view").val(that.data('kdrekmed'));
                                                        $("#pelanggan-view").hide();
                                                        $("#kasir-view").show();
                                                    });

                                                    $('#tbl-pelanggan').delegate('a.btn-delete', 'click', function (e) {
                                                        e.preventDefault();
                                                        var id = $(this).data('id');
                                                        $.ajax({
                                                            type: "POST",
                                                            dataType: "json",
                                                            url: "<?=base_url('pos/del_pelanggan');?>",
                                                            data: {id: id},
                                                            success: function (r) {
                                                                oTable._fnAjaxUpdate();
                                                                alert(r.message);
                                                            },
                                                            error: function (e) {
                                                                console.log(e.responseText());
                                                            }
                                                        });

                                                    });

                                                });
                                            </script>
                                        </div>
                                    </section>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  End of View Pelanggan  -->

<!--  View Transaksi  -->
<div class="pos-content" id="pembayaran-view">
    <div class="window">
        <div class="subwindow">
            <div class="subwindow-container">
                <div class="subwindow-container-fix screens">
                    <div class="payment-screen screen">
                        <div class="screen-content">
                            <div class="top-content">
                            <span class="button back" id="pembayaran-btn-hide">
                                <i class="fa fa-angle-double-left"></i>Kembali
                            </span>
                                <h1>Pembayaran &nbsp;<span id="nm-pelanggan" style="font-size: 12pt;"></span></h1>
                            <span class="button next highlight" id="validasi">Validasi
                                <i class="fa fa-angle-double-right"></i>
                            </span>
                            </div>
                            <div class="left-content pc40 touch-scrollable scrollable-y">
                                <div class="paymentmethods-container">
                                    <div class="paymentmethods">
                                        <?php foreach ($crbayar as $byr): ?>
                                        <div class="button paymentmethod"><?= $byr->crbayar_nama; ?></div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="right-content pc60 touch-scrollable scrollable-y">
                            <section class="paymentlines-container">
                                <div class="paymentlines-empty">
                                    <div class="total">Rp 0</div>
                                    <div class="message">
                                        Silahkan Pilih metode pembayaran.
                                    </div>
                                </div>
                                <div id="pembayaran">
                                    <table class="table">
                                        <tr style="font-weight: bold;">
                                            <td>Total</td><td>Dibayar</td><td>Kembali</td><td>Metode</td><td>Jenis</td>
                                        </tr>
                                        <tr style="background-color: mediumseagreen; color: whitesmoke;">
                                            <td id="ttl_bayar"></td>
                                            <td id="ttl_dibayar"><input type="text" id="ttl_bayar_input"></td>
                                            <td id="kembalian"></td>
                                            <td id="metode"></td>
                                            <td id="gol_tindakan"></td>
                                        </tr>
                                    </table>
                                </div>
                            </section>
                                <section class="payment-numpad">
                                    <div class="numpad" style="width: 98%">
                                        <button class="input-button number-char" data-action="1">1</button>
                                        <button class="input-button number-char" data-action="2">2</button>
                                        <button class="input-button number-char" data-action="3">3</button>
                                        <button class="mode-button" data-action="+10">+10</button>
                                        <br>
                                        <button class="input-button number-char" data-action="4">4</button>
                                        <button class="input-button number-char" data-action="5">5</button>
                                        <button class="input-button number-char" data-action="6">6</button>
                                        <button class="mode-button" data-action="+20">+20</button>
                                        <br>
                                        <button class="input-button number-char" data-action="7">7</button>
                                        <button class="input-button number-char" data-action="8">8</button>
                                        <button class="input-button number-char" data-action="9">9</button>
                                        <button class="mode-button" data-action="+50">+50</button>
                                        <br>
                                        <button class="input-button numpad-char" data-action="CLEAR">C</button>
                                        <button class="input-button number-char" data-action="0">0</button>
                                        <button class="input-button number-char" data-action=",">,</button>
                                        <button class="input-button numpad-backspace" data-action="BACKSPACE">
                                            <img height="21" src="<?= base_url('assets/images/backspace.png') ?>" width="24">
                                        </button>
                                    </div>
                                </section>

                                <div class="payment-buttons">
                                    <?php foreach ($gol_tindakan as $gt): ?>
                                    <div class="button js_set_customer">
                                        <i class='fa fa-file-text-0'></i>
                                        <span class='gol_id' data-golid="<?= $gt->gol_tindakan_id; ?>"><?= $gt->gol_tindakan_nama; ?></span>
                                    </div>
                                    <?php endforeach ?>
                                    <!--<div class="button js_invoice  ">
                                        <i class="fa fa-file-text-o"></i> Tagihan
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  End of View Transaksi  -->

<!-- View Struk Kasir  -->

<div class="pos-content" id="struk-kasir">

    <div class="window">
        <div class="subwindow">
            <div class="subwindow-container">
                    <div class="receipt-screen screen">
                        <div class="screen-content">
                            <div class="top-content">
                                <h1>Kembalian: <span class="change-value">Rp 0,00</span></h1>
                    <span class="button next highlight" id="next_order">Pesanan Berikutnya
                        <i class="fa fa-angle-double-right"></i>
                    </span>
                            </div>
                            <div class="centered-content touch-scrollable">
                                <div class="button print">
                                    <i class="fa fa-print"></i> Cetakan tanda terima
                                </div>
                                <div class="pos-receipt-container">
                                    <div class="pos-sale-ticket">
                                        <div class="pos-center-align"><?= $tgl_cetak.'        '.$trkasir_id; ?> </div>
                                        <br>LABKESDA<br>
                                        <div class="receipt-phone">
                                        </div>
                                        <div class="receipt-user">
                                            <?= 'Pengguna : ';?><br>
                                        </div>
                                        <br>

                                        <table class="receipt-orderlines">
                                            <colgroup>
                                                <col width="50%">
                                                <col width="25%">
                                                <col width="25%">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <td>Air Raksa</td>
                                                <td class="pos-right-align">1,000</td>
                                                <td class="pos-right-align">Rp 0,00</td>
                                            </tr>
                                            <tr>
                                                <td>AKK</td>
                                                <td class="pos-right-align">1,000</td>
                                                <td class="pos-right-align">Rp 0,00</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                        <table class="receipt-total">
                                            <tbody>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td class="pos-right-align">Rp 0,00</td>
                                            </tr>
                                            <tr class="emph">
                                                <td>Total:</td>
                                                <td class="pos-right-align">Rp 0,00</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                        <table class="receipt-paymentlines">

                                        </table>
                                        <br>
                                        <table class="receipt-change">
                                            <tbody>
                                            <tr>
                                                <td>Kembalian:</td><td class="pos-right-align">Rp 0,00</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of View Struk Kasir  -->

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/legacy.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/forms/daterangepicker.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/forms/picker.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/forms/picker.date.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/forms/picker.time.js'); ?>"></script>

<script type="text/javascript" src="<?= base_url('assets/js/app/pos.js'); ?>"></script>