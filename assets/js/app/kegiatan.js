$(function(){"use_strict";function a(a){$.ajax({type:"POST",data:{id:a},url:baseUrl+"kegiatan/get_list_eselon2",success:function(a){$("#eselon2").html(a).trigger("change")}})}function b(a){$.ajax({type:"POST",data:{id:a},url:baseUrl+"kegiatan/get_list_eselon3",success:function(a){$("#eselon3").html(a).trigger("change")}})}function c(a){$.ajax({type:"POST",data:{id:a},url:baseUrl+"kegiatan/get_list_eselon4",success:function(a){$("#eselon4").html(a).trigger("change")}})}$("#submit_filter").on("click",function(a){a.preventDefault(),""!==$("#eselon4").val()?($("#filter").val($("#eselon4").val()),$("#eselon").val("4")):""!==$("#eselon3").val()?($("#filter").val($("#eselon3").val()),$("#eselon").val("3")):""!==$("#eselon2").val()?($("#filter").val($("#eselon2").val()),$("#eselon").val("2")):""!==$("#eselon1").val()?($("#filter").val($("#eselon1").val()),$("#eselon").val("1")):($("#filter").val(""),$("#eselon").val("")),$("#filter-collapse").click(),oTable._fnAjaxUpdate()}),$("#btn-add").on("click",function(a){window.location.href=baseUrl+"kegiatan/add"}),$("#tbl-kegiatan").delegate("a.btn-delete","click",function(a){a.preventDefault();var b=$(this).data("id");swal({title:"Konfirmasi Hapus Data",text:"Apakah anda yakin ingin menghapus data ini?",type:"warning",showCancelButton:!0,confirmButtonClass:"btn-danger",confirmButtonText:"Hapus",cancelButtonText:"Batal",closeOnConfirm:!1,closeOnCancel:!1},function(a){a?$.ajax({type:"POST",dataType:"json",url:baseUrl+"kegiatan/delete",data:{id:b},success:function(a){oTable._fnAjaxUpdate(),swal(a.message,"",a.type)},error:function(a){console.log(a.responseText())}}):swal("Batal","Hapus data dibatalkan","error")})}).delegate("a.btn-view","click",function(a){a.preventDefault();var b=$(this).data("id");$("#modal_title_kegiatan").html($(this).data("title").toUpperCase()),$.ajax({type:"POST",data:{id:b},url:baseUrl+"kegiatan/view",success:function(a){$("#modal_content_kegiatan").html(a)},error:function(a){new PNotify({title:"Error",text:"Terjadi kesalahan gagal load view kegiatan!",icon:"icon-blocked",type:"error",addclass:"bg-danger"})}}),$("#mdl_kegiatan").modal("show")}),$(".select").select2({allowClear:!0}),$("#eselon1").on("change",function(b){a($(this).val())}),$("#eselon2").on("change",function(a){b($(this).val())}),$("#eselon3").on("change",function(a){c($(this).val())})});