$(function(){$("body").on("click","ul.acc-menu a",function(){var a=$(this).closest("ul.acc-menu").children("li");$(this).closest("li").addClass("active"),$.each(a,function(b){return $(a[b]).hasClass("active")?($(a[b]).removeClass("active"),!0):void $(a[b]).removeClass("open")}),$(this).siblings("ul.acc-menu:visible").length>0?$(this).closest("li").removeClass("open"):$(this).closest("li").addClass("open")});var a;$.each($("ul.acc-menu a"),function(){if(this.href==window.location)return a=this,!1});for(var b=$(a).closest("li");;)if(b.addClass("active"),b.closest("ul.acc-menu").show().closest("li").addClass("open"),b=$(b).parents("li").eq(0),$(b).parents("ul.acc-menu").length<=0)break;var c=$("li").filter(function(){return $(this).find("ul.acc-menu").length});$(c).addClass("acc-parent-li")});