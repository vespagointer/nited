$(document).on("dblclick", ".editable", function() {
    var text = $(this).text().trim();
    var id = $(this).data("id");
    var parm = $(this).data("parm");
    $(this).addClass("editing");
    $("#tmpData").val(text);
    $("#id").val(id);
    $("#parm").val(parm);
    $("#xEdit").modal("toggle");
    $("#tmpData").removeClass("is-invalid");
    $("#tmpData").removeClass("is-valid");
    if (parm == "dep") {
        $("#tmpData").hide();
        $("#tmpSel").show();
        $("#tmpDate").hide();
        $("#tmpScout").hide();
        $("#tmpPsmt").hide();
        $("#tmpPsmtNo").hide();
    } else if (parm == "bdate") {
        $("#tmpData").hide();
        $("#tmpSel").hide();
        $("#tmpDate").show();
        $("#tmpScout").hide();
        $("#tmpPsmt").hide();
        $("#tmpPsmtNo").hide();
    } else if (parm == "psmt") {
        $("#tmpData").hide();
        $("#tmpSel").hide();
        $("#tmpDate").hide();
        $("#tmpScout").hide();
        $("#tmpPsmt").show();
        $("#tmpPsmtNo").hide();
    } else if (parm == "psmtno") {
        $("#tmpData").hide();
        $("#tmpSel").hide();
        $("#tmpDate").hide();
        $("#tmpScout").hide();
        $("#tmpPsmt").hide();
        $("#tmpPsmtNo").show();
    } else if (parm == "scout") {
        $("#tmpData").hide();
        $("#tmpSel").hide();
        $("#tmpDate").hide();
        $("#tmpScout").show();
        $("#tmpPsmt").hide();
        $("#tmpPsmtNo").hide();
    } else {
        $("#tmpData").show();
        $("#tmpSel").hide();
        $("#tmpDate").hide();
        $("#tmpScout").hide();
        $("#tmpPsmt").hide();
        $("#tmpPsmtNo").hide();
    }
});
$(document).on("click", "#save", function(e) {
    var xid = $("#id").val();
    var xparm = $("#parm").val();
    if (xparm == "dep") {
        var xtmpData = $("#tmpSel").val().trim();
    } else if (xparm == "bdate") {
        var xtmpData = $("#tmpDate").val().trim();
    } else if (xparm == "scout") {
        var xtmpData = $("#tmpScout").val().trim();
    } else if (xparm == "psmt") {
        var xtmpData = $("#tmpPsmt").val().trim();
    } else if (xparm == "psmtno") {
        var xtmpData = $("#tmpPsmtNo").val().trim();
    } else {
        var xtmpData = $("#tmpData").val().trim();
    }
    if (xtmpData == "") {
        $("#tmpData").addClass("is-invalid");
    } else {
        $.post("update.php", {
            id: xid,
            tmpData: xtmpData,
            parm: xparm,
            mode: "teacher",
        }).done(function(data) {
            if (data == "OK") {
                //alert("บันทึกการแก้ไขแล้ว");
                $("#xEdit").modal("toggle");
                if (xparm == "dep") {
                    xtmpData = $("#tmpSel option:selected").text();
                }
                if (xtmpData == "none") {
                    xtmpData = "ไม่มีวุฒิทางลูกเสือ";
                }
                $(".editing").text(xtmpData).removeClass("editing");
            } else {
                alert("แก้ไขไม่ได้กรุณาลองอีกครั้ง");
            }
        });
    }
});
$(document).on("change keyup", "#tmpData", function(e) {
    //console.log($(this).parent().parent().get( 0 ).tagName);
    var pwd = $("#tmpData").val();
    if (pwd == "") {
        $("#tmpData").removeClass("is-valid").addClass("is-invalid");
    } else {
        $("#tmpData").removeClass("is-invalid").addClass("is-valid");
    }
});
$(document).on("click", "#cancel", function(e) {
    $(".editing").removeClass("editing");
});
$(document).ready(function() {
    if ($("#imgProfile").attr("src") == "") {
        $("#imgProfile").attr("src", "../images/profile.png");
    }
    $(".toast").toast("show");
});
$(document).on("dblclick", "#imgProfile", function() {
    ///alert("Hello");
    $("#upimg").modal("toggle");
});
$(document).on("click", "#btnbrows", function() {
    $("#image").trigger("click");
});
$(document).on("change", "#image", function() {
    $("#imgview").show();
    var file = this.files[0];
    var reader = new FileReader();
    reader.onloadend = function() {
        imagebase64 = reader.result;
        $("#imgview").attr("src", imagebase64);
    };
    reader.readAsDataURL(file);
    if (file.size > 3000000) {
        alert("ขนาดของไฟล์ต้องไม่เกิน 3 MB");
        $(this).val("");
        $("#imgview").attr("src", "");
        $("#addImage").prop("disabled", true);
    } else {
        $("#addImage").prop("disabled", false);
    }
});
$(document).on("click", "#addImage", function() {
    var file_data = $("#image").prop("files")[0];
    var form_data = new FormData();
    form_data.append("img", file_data);
    $.ajax({
        url: "upload.php", // point to server-side controller method
        //dataType: "text", // what to expect back from the server
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: "post",
        success: function(response) {
            if (response == "FAIL") {
                alert("ไม่สามารถบันทึกรูปได้ กรุณาลองอีกครั้ง");
            } else {
                $("#imgProfile").attr("src", response + "?" + new Date().getTime());
                $("#upimg").modal("toggle");
            }
        },
        //error: function (response) {
        //	$("#msg").html(response); // display error response from the server
        //},
    });
});
$("#tmpDate").datepicker({
    format: "dd/mm/yyyy",
    maxViewMode: 2,
    language: "th",
    daysOfWeekHighlighted: "0,6",
    autoclose: true,
    todayHighlight: true,
});