$(window).load(function() {
    $("#status").fadeOut(), $("#preloader").delay(250).fadeOut("slow"), $("body").delay(250).css({
        overflow: "visible"
    })
}), $(function() {
    $(".styled, .multiselect-container input").uniform({
        radioClass: "choice"
    }), $("input,textarea").focus(function() {
        $(this).data("placeholder", $(this).attr("placeholder")).attr("placeholder", "")
    }).blur(function() {
        $(this).attr("placeholder", $(this).data("placeholder"))
    });
    var a = $(".form-validate");
    a.validate({
        ignore: "input[type=hidden], .select2-search__field",
        errorClass: "validation-error",
        successClass: "validation-success",
        highlight: function(a, b) {
            $(a).removeClass(b)
        },
        unhighlight: function(a, b) {
            $(a).removeClass(b)
        },
        errorPlacement: function(a, b) {
            b.parents("div").hasClass("checker") || b.parents("div").hasClass("choice") || b.parent().hasClass("bootstrap-switch-container") ? b.parents("label").hasClass("checkbox-inline") || b.parents("label").hasClass("radio-inline") ? a.appendTo(b.parent().parent().parent().parent()) : a.appendTo(b.parent().parent().parent().parent().parent()) : b.parents("div").hasClass("has-feedback") || b.hasClass("select2-hidden-accessible") ? a.appendTo(b.parent()) : b.parents("label").hasClass("checkbox-inline") || b.parents("label").hasClass("radio-inline") || b.parents("div").hasClass("checkbox-single") ? a.appendTo(b.parent().parent()) : b.parents("div").hasClass("checkbox-group") ? a.appendTo(b.parent().parent().parent()) : b.parent().hasClass("uploader") || b.parents().hasClass("input-group") ? a.appendTo(b.parent().parent()) : a.insertAfter(b)
        },
        validClass: "validation-success",
        success: function(a) {
            a.addClass("validation-success").text("OK")
        },
        rules: {
            username: {
                required: !0
            },
            password: {
                required: !0,
                minlength: 8
            }
        },
        messages: {
            required: "Field harus di isi!",
            minlength: "Karakter minimal %s karakter!"
        }
    });
    $("#email").bind("keyup", function(a) {
        13 == a.which && ($("#password").focus(), a.preventDefault())
    }), $("#password").bind("keyup", function(a) {
        13 == a.which && ($(".btn-log").click(), a.preventDefault())
    }), $(".btn-log").on("click", function(b) {
        b.preventDefault();
        var c = a.valid();
        c && $.ajax({
            type: "POST",
            dataType: "json",
            url: a.attr("action"),
            data: a.serializeArray(),
            success: function(a) {
                1 == a.error ? ($("#password").val(""), new PNotify({
                    title: "Terjadi Kesalahan!",
                    text: a.message,
                    addclass: "bg-danger"
                })) : window.location.href = baseUrl + "dashboard"
            }
        })
    }),

        $("#email").bind("keyup", function(a) {
            13 == a.which && ($("#password").focus(), a.preventDefault())
        }), $("#password").bind("keyup", function(a) {
        13 == a.which && ($(".btn-pos").click(), a.preventDefault())
    }), $(".btn-pos").on("click", function(b) {
        b.preventDefault();
        var c = a.valid();
        c && $.ajax({
            type: "POST",
            dataType: "json",
            url: a.attr("action"),
            data: a.serializeArray(),
            success: function(a) {
                1 == a.error ? ($("#password").val(""), new PNotify({
                    title: "Terjadi Kesalahan!",
                    text: a.message,
                    addclass: "bg-danger"
                })) : window.location.href = baseUrl + "pos"
            }
        })
    }),$(".btn-reset").on("click", function(a) {
        a.preventDefault(), $.ajax({
            type: "POST",
            dataType: "json",
            url: baseUrl + "auth/forgot",
            data: {
                email: $("#email_reset").val()
            },
            success: function(a) {
                1 == a.error ? ($("#email_reset").val(""), new PNotify({
                    title: "Terjadi Kesalahan!",
                    text: a.message,
                    addclass: "bg-danger"
                })) : ($("#mdl_forgot").modal("hide"), new PNotify({
                    title: "Sukses!",
                    text: a.message,
                    addclass: "bg-success"
                }))
            }
        })
    })
});