$(document).on("dblclick", ".editable", function () {
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
  } else {
    $("#tmpData").show();
    $("#tmpSel").hide();
  }
});

$(document).on("click", "#save", function (e) {
  var xid = $("#id").val();
  var xparm = $("#parm").val();
  if (xparm == "dep") {
    var xtmpData = $("#tmpSel").val().trim();
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
    }).done(function (data) {
      if (data == "OK") {
        //alert("บันทึกการแก้ไขแล้ว");
        $("#xEdit").modal("toggle");
        if (xparm == "dep") {
          xtmpData = $("#tmpSel option:selected").text();
        }
        $(".editing").text(xtmpData).removeClass("editing");
      } else {
        alert("แก้ไขไม่ได้กรุณาลองอีกครั้ง");
      }
    });
  }
});

$(document).on("change keyup", "#tmpData", function (e) {
  //console.log($(this).parent().parent().get( 0 ).tagName);
  var pwd = $("#tmpData").val();
  if (pwd == "") {
    $("#tmpData").removeClass("is-valid").addClass("is-invalid");
  } else {
    $("#tmpData").removeClass("is-invalid").addClass("is-valid");
  }
});

$(document).on("click", "#cancel", function (e) {
  $(".editing").removeClass("editing");
});

$(document).ready(function () {
  $(".toast").toast("show");
});