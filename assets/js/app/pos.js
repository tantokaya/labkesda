/**
 * Created by hartantokurniawan on 07/01/18.
 */
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

$(document).ready(function(){
    $('.order-empty').show();
    $('.order-ok').hide();

    $('#tgl_lahir').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY'
        },
        maxDate: moment(),
        opens: 'right'
    });

    $('#propinsi_id').on('change', function(){
        var prop_id = $(this).val();

        $('#kota_id').html('');
        $('#kecamatan_id').html('');
        $('#kelurahan_id').html('');

        getListKota({prop_id: prop_id});
    });

    $('#kota_id').on('change', function(){
        var kota_id = $(this).val();

        $('#kecamatan_id').html('');
        $('#kelurahan_id').html('');

        getListKecamatan({kota_id: kota_id});
    });

    $('#kecamatan_id').on('change', function(){
        var kecamatan_id = $(this).val();

        $('#kelurahan_id').html('');

        getListKelurahan({kecamatan_id: kecamatan_id});
    });

        function getListKota(parameters){
        var prop_id = parameters.prop_id;
        var kota_id = parameters.kota_id;
        $.ajax({
            type: 'POST',
            url: baseUrl+'/pos/get_list_kota',
            data: 'propinsi_id='+prop_id,
            success: function(res){
                $('#kota_id').html(res);
                if(kota_id != null){
                    $('#kota_id').select('val', kota_id);
                }
            },
            error: function(e){
                console.log('Error: '+e);
            }
        });
    }

    function getListKecamatan(parameters){
        var kota_id = parameters.kota_id;
        var kecamatan_id = parameters.kecamatan_id;
        $.ajax({
            type: 'POST',
            url: baseUrl+'/pos/get_list_kecamatan',
            data: 'kota_id='+kota_id,
            success: function(res){
                $('#kecamatan_id').html(res);
                if(kecamatan_id != null){
                    $('#kecamatan_id').select('val', kecamatan_id);
                }
            },
            error: function(e){
                console.log('Error: '+e);
            }
        });
    }

    function getListKelurahan(parameters){
        var kecamatan_id = parameters.kecamatan_id;
        var kelurahan_id = parameters.kelurahan_id;
        $.ajax({
            type: 'POST',
            url: baseUrl+'/pos/get_list_kelurahan',
            data: 'kecamatan_id='+kecamatan_id,
            success: function(res){
                $('#kelurahan_id').html(res);
                if(kelurahan_id != null){
                    $('#kelurahan_id').select('val', kelurahan_id);
                }

                //if($('#kel_id_tmp').val())$('#kelurahan_id').val($('#kel_id_tmp').val()).trigger('change');
            },
            error: function(e){
                console.log('Error: '+e);
            }
        });
    }

    function kosong(){
        $('#nm_lengkap').val('');
        $('#nik').val('');
        $('#tmp_lahir').val('');
        $('#agama_id').val('');
        $('#jenis_kelamin_id').val('');
        $('#alamat').val('');
        $('#propinsi_id').val('');
        $('#kota_id').val('');
        $('#kecamatan_id').val('');
        $('#kelurahan_id').val('');
        $('#no_kk').val('');
        $('#nm_kk').val('');
        $('#goldar_id').val('');
        $('#pendidikan_id').val('');
        $('#pekerjaan_id').val('');
        $('#stmarital_id').val('');
    }
 ////////     SIMPAN PELANGGAN     /////////////
    $("#btn-save-pelanggan").click(function(e){
        e.preventDefault();
        var nik	        = $("#nik").val();
        var kd_rekmed	= $("#kd_rekmed").val();
        var nm_lengkap	= $("#nm_lengkap").val();

        var string = $("#frm-pelanggan").serialize();

        if(nik.length==0){
            $("#nik").focus();
            return;
        }

        $.ajax({
            type	: 'POST',
            url		: baseUrl+'/pos/save_pelanggan',
            data	: string,
            cache	: false,
            success	: function(data){
                kosong();
                $("#pelanggan-detail").hide();
                $("#tabel").show();
                $("#pelanggan-btn-view").html("<i class='fa fa-user'></i>"+nm_lengkap);
                $("#pelanggan-btn-view").val(kd_rekmed);
                $("#pelanggan-view").hide();
                $("#kasir-view").show();
            }
        });

    });


////////   SIMPAN TRANSAKSI ////////////

    $(".product_btn").click(function(e){
        e.preventDefault();
        var that = $(this);

        /*$('#jualan').html(that.data('tindakan'));*/

        $.ajax({
            type	: 'POST',
            url		: baseUrl+'/pos/save_trx',
            data	: {
                id: that.data('kdtindakan'),
                harga: that.data('tarif'),
                trkasir_id: that.data('trkasirid'),
                tindakan: that.data('tindakan')
              },
            cache	: false,
            success	: function(data){
                $('.order-empty').hide();
                $('.order-ok').show();

                detailTransaksi();
            }
        });


    });

    //Detail Tabel Transaksi
    function detailTransaksi(){
        var kode = $("#trkasir_id").val();
        var string = "kode="+kode;
        //alert(kode);
        $.ajax({
            type	: 'POST',
            url		: baseUrl+'/pos/DataDetail',
            data	: string,
            cache	: false,
            success	: function(data){
                $("#tampil_data").html(data);

            }
        });

    }

    /* ------------------------------- HITUNG SELISIH ------------------------- */
    $("#ttl_bayar_input").keyup(function(){
        hitungBayar();
    });

    var kembali;

    function hitungBayar(){
        var jml_bayar   = parseInt($("#total_beli").data('gtotal'));
        var bayar       = parseInt($("#ttl_bayar_input").val());

        if(bayar < jml_bayar) {
            $('#kembalian').attr('style','color: red; font-weight: bold; font-size: 14pt;');
        }else {
            $('#kembalian').removeAttr('style');
        }

        if(jml_bayar > 0  && bayar > 0){
            kembali = bayar - jml_bayar;

            $("#kembalian").html(kembali);
        }else{
            $("#kembalian").html(0);
        }

        //console.log(jml_bayar + ' ' + bayar + ' ' + kembali);
    }

 //    Validasi Pembayaran

    $('#validasi').click(function(){

        //alert($('#pelanggan-btn-view2').val());
        if(kembali < 0){
           alert('Bayarnya kurang dan pelanggan kosong, Ulangi !!!')
           $('#ttl_bayar_input').focus();
       }else{
           //var pelanggan = $('.js_customer_name').html();

           //alert(pelanggan +' '+$('#trkasir_id').val() + ' ' + $("#total_beli").data('gtotal')+' '+$("#ttl_bayar_input").val()+' '+kembali +' '+$('#metode').html());
           // Insert Table Header
           $.ajax({
               type	: 'POST',
               url		: baseUrl+'/pos/update_trxheader',
               data	: {
                   trkasir_id: $('#trkasir_id').val(),
                   total: $('#total_beli').data('gtotal'),
                   bayar: $('#ttl_bayar_input').val(),
                   kembali: kembali,
                   cara_bayar: $('#metode').html(),
                   pelanggan: $('#pelanggan-btn-view2').val()
               },
               cache	: false,
               success	: function(data){
                   $('#struk-kasir').show();
                   $("#pelanggan-view").hide();
                   $("#kasir-view").hide();
                   $("#pembayaran-view").hide();
               }
           });
       }


    });

});