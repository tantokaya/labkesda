"use_strict";$(function(){function f(){var a=$("#trash"),b=a.offset(),c=b.left,d=b.left+a.outerWidth(!0),f=b.top,g=b.top+a.outerHeight(!0);return e.x>=c&&e.x<=d&&e.y>=f&&e.y<=g}function g(){$(".fullcalendar-external").fullCalendar("refetchEvents")}function h(a){$.ajax({type:"POST",url:baseUrl+"kalender/get_list_peserta",data:{id:a},success:function(a){$("#list-peserta").html(a).fadeIn("slow")}})}function i(a){$.ajax({type:"POST",url:baseUrl+"kalender/get_list_lampiran",data:{id:a},success:function(a){$("#list-lampiran").html(a).fadeIn("slow")}})}var c,a={url:baseUrl+"kalender/fetch",type:"POST",data:{owner:sess_id},error:function(){new PNotify({title:"Error",text:"Terjadi kesalahan dalam memuat data kegiatan di kalender!",icon:"icon-blocked",type:"error",addclass:"bg-danger"})}},b={url:baseUrl+"kalender/fetch",type:"POST",data:{owner:sess_id,public:!0,filter:$("#filter").val(),eselon:$("#eselon").val()},error:function(){new PNotify({title:"Error",text:"Terjadi kesalahan dalam memuat data kegiatan di kalender!",icon:"icon-blocked",type:"error",addclass:"bg-danger"})},editable:!1},d=new Array;$(".fullcalendar-external").fullCalendar({header:{left:"prev,next today",center:"title",right:"month,agendaWeek,agendaDay"},eventLimit:!0,editable:!0,eventSources:[a,b],lang:"id",droppable:!0,eventReceive:function(a){var b=moment(a.start).format("DD/MM/YYYY"),c=null==a.end?b:moment(a.end).format("DD/MM/YYYY");$("#modal_title_kegiatan").html("Tambah Kegiatan "+a.title),$("#jenis_kegiatan_id").val(a.jenis_kegiatan_id),$.ajax({type:"POST",data:{id:a.jenis_kegiatan_id,start:b,end:c},url:baseUrl+"kalender/form_kalender_add",success:function(a){$("#modal_content_kegiatan").html(a)},error:function(a){new PNotify({title:"Error",text:"Terjadi kesalahan gagal load form tambah kegiatan!",icon:"icon-blocked",type:"error",addclass:"bg-danger"})}}),$("#mdl_kegiatan").modal("show")},eventDrop:function(a,b,c){var d=moment(a.start).format("DD/MM/YYYY"),e=null==a.end?d:moment(a.end).format("DD/MM/YYYY");$.ajax({type:"POST",dataType:"json",data:{id:a.id,start:d,end:e},url:baseUrl+"kalender/update_tanggal_kegiatan",success:function(a){1==a.error?(c(),new PNotify({title:"Error",text:"Terjadi kesalahan gagal memperbaharui tanggal kegiatan!",icon:"icon-blocked",type:"error",addclass:"bg-danger"})):new PNotify({title:"Sukses",text:"Tanggal kegiatan berhasil diperbaharui!",icon:"icon-checkmark3",type:"success",addclass:"bg-success"})},error:function(a){c(),new PNotify({title:"Error",text:"Terjadi kesalahan gagal memperbaharui tanggal kegiatan!",icon:"icon-blocked",type:"error",addclass:"bg-danger"})}})},eventClick:function(a,b,c){$("#modal_title_kegiatan").html(a.title.toUpperCase()),$("#jenis_kegiatan_id").val(a.jenis_kegiatan_id),$.ajax({type:"POST",data:{id:a.id},url:baseUrl+"kalender/form_kalender_edit",success:function(a){$("#modal_content_kegiatan").html(a)},error:function(a){new PNotify({title:"Error",text:"Terjadi kesalahan gagal load form ubah kegiatan!",icon:"icon-blocked",type:"error",addclass:"bg-danger"})}}),$("#mdl_kegiatan").modal("show")},eventResize:function(a,b,c){var d=moment(a.start).format("DD/MM/YYYY"),e=moment(a.end).format("DD/MM/YYYY");$.ajax({type:"POST",dataType:"json",data:{id:a.id,start:d,end:e},url:baseUrl+"kalender/update_tanggal_kegiatan",success:function(a){1==a.error?(c(),new PNotify({title:"Error",text:"Terjadi kesalahan gagal memperbaharui tanggal kegiatan!",icon:"icon-blocked",type:"error",addclass:"bg-danger"})):new PNotify({title:"Sukses",text:"Tanggal kegiatan berhasil diperbaharui!",icon:"icon-checkmark3",type:"success",addclass:"bg-success"})},error:function(a){c(),new PNotify({title:"Error",text:"Terjadi kesalahan gagal memperbaharui tanggal kegiatan!",icon:"icon-blocked",type:"error",addclass:"bg-danger"})}})},eventDragStop:function(a,b,c,d){f()&&swal({title:"Konfirmasi Hapus Data",text:"Apakah anda yakin ingin menghapus kegiatan ini?",type:"warning",showCancelButton:!0,confirmButtonClass:"btn-danger",confirmButtonText:"Hapus",cancelButtonText:"Batal",closeOnConfirm:!0,closeOnCancel:!1},function(b){b?$.ajax({type:"POST",dataType:"json",url:baseUrl+"kalender/delete_kegiatan",data:{id:a.id},success:function(a){0==a.error?(new PNotify({title:"Sukses",text:"Data kegiatan berhasil dihapus!",icon:"icon-checkmark3",addclass:"bg-success"}),g()):new PNotify({title:"Error",text:"Data kegiatan gagal dihapus!",icon:"icon-blocked",addclass:"bg-danger"})},error:function(a){new PNotify({title:"Error",text:"Data kegiatan gagal dihapus!",icon:"icon-blocked",type:"error",addclass:"bg-danger"})}}):swal("Batal","Hapus data dibatalkan","error")})}}),$("#external-events .fc-event").each(function(){$(this).css({backgroundColor:$(this).data("color"),borderColor:$(this).data("color")}),$(this).data("event",{title:$.trim($(this).html()),color:$(this).data("color"),jenis_kegiatan_id:$(this).data("jenis-kegiatan-id"),stick:!0}),$(this).draggable({zIndex:999,revert:!0,revertDuration:0})});var e={x:-1,y:-1};$(document).on("mousemove",function(a){e.x=a.pageX,e.y=a.pageY}),$("#mdl_kegiatan [data-dismiss=modal]").on("click",function(a){$("#simpan-kegiatan").show(),g()}),$("#simpan-kegiatan").on("click",function(a){a.preventDefault();var b={};b.hide=!0,b.buttons={closer:!0,sticker:!0},b.opacity=1,b.width=PNotify.prototype.options.width,$.ajax({type:"POST",dataType:"json",data:$("#frm-kegiatan").serializeArray(),url:baseUrl+"kalender/save_kegiatan",success:function(a){if(0==a.error)$("#error_info").html("").fadeOut("slow"),b.title="Sukses",b.text=a.message,b.addclass="bg-success",b.type=a.type,b.icon="icon-checkmark3",$("#kegiatan_id").val(a.kegiatan_id),"insert"==a.flag&&(i(a.kegiatan_id),h(a.kegiatan_id)),$("ul.tab-menu li:eq(1)").removeClass("disabled",!0).find("a").attr("data-toggle","tab"),$("ul.tab-menu li:eq(2)").removeClass("disabled",!0).find("a").attr("data-toggle","tab"),$('.tab-menu a[href="#lampiran-tab"]').tab("show"),new PNotify(b);else{var c='<span class="text-semibold">Error!</span>'+a.message;$("#error_info").html(c).fadeIn("slow")}},error:function(a){b.title="Error",b.text="Data kegiatan gagal disimpan!",b.addclass="bg-danger",b.type="error",b.icon="icon-blocked",new PNotify(b)}})}),$("#mdl_undangan").delegate("button#simpan-peserta","click",function(a){a.preventDefault();var b={};b.hide=!0,b.buttons={closer:!0,sticker:!0},b.opacity=1,b.width=PNotify.prototype.options.width,$.ajax({type:"POST",dataType:"json",data:$("#frm-peserta").serializeArray(),url:baseUrl+"kegiatan/save_peserta",success:function(a){if(0==a.error)$("#error_info2").html("").fadeOut("slow"),b.title="Sukses",b.text=a.message,b.addclass="bg-success",b.type=a.type,b.icon="icon-checkmark3",h($("#kegiatan_id").val()),$("#mdl_undangan").modal("hide"),$("#mdl_kegiatan").modal("show"),new PNotify(b);else{var c='<span class="text-semibold">Error!</span>'+a.message;$("#error_info2").html(c).fadeIn("slow")}},error:function(){b.title="Error",b.text="Data peserta kegiatan gagal disimpan!",b.addclass="bg-danger",b.type="error",b.icon="icon-blocked",new PNotify(b)}})}),$("#mdl_undangan [data-dismiss=modal]").on("click",function(a){$("#simpan-peserta").show(),$("#mdl_kegiatan").modal("show")}),$("#submit_filter").on("click",function(e){e.preventDefault();var f,g;""!==$("#eselon4").val()?(f=$("#eselon4").val(),g="4"):""!==$("#eselon3").val()?(f=$("#eselon3").val(),g="3"):""!==$("#eselon2").val()?(f=$("#eselon2").val(),g="2"):""!==$("#eselon1").val()?(f=$("#eselon1").val(),g="1"):(f="",g=""),c={url:baseUrl+"kalender/fetch",type:"POST",data:{owner:sess_id},error:function(){new PNotify({title:"Error",text:"Terjadi kesalahan dalam memuat data kegiatan di kalender!",icon:"icon-blocked",type:"error",addclass:"bg-danger"})}},d={url:baseUrl+"kalender/fetch",type:"POST",data:{owner:sess_id,public:!0,filter:f,eselon:g},error:function(){new PNotify({title:"Error",text:"Terjadi kesalahan dalam memuat data kegiatan di kalender!",icon:"icon-blocked",type:"error",addclass:"bg-danger"})},editable:!1},$(".fullcalendar-external").fullCalendar("removeEventSources",[a,b]),$(".fullcalendar-external").fullCalendar("addEventSource",c),$(".fullcalendar-external").fullCalendar("addEventSource",d),a=c,b=d,$("#filter-collapse").click()})});