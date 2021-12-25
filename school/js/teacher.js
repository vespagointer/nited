$(document).on("change", "#what", function (e) {
  var swhat = $(this).val();
  var input1 =
    '<input type="text" class="form-control-sm" name="key" required>\n';
  var input2 = $("#in2").val();
  var data = "";
  //console.log(swhat);
  if (swhat == "name") {
    data = input1;
  } else if (swhat == "dep") {
    data = input2;
  }
  $("#sinput").empty().html(data);
  $("html, body").animate(
    {
      scrollTop: 0,
    },
    "slow"
  );
});

$(document).on("click", ".movebtn", function (e) {
  //console.log($(this).parent().parent().get( 0 ).tagName);
  var tid = $(this).data("id");
  var ttr = $(this).parent().parent();
  //alert(tid);
  if (confirm("ต้องการย้ายครูออกจากโรงเรียน?") == true) {
    $.get("teacherdb.php", { do: "move", id: tid }).done(function (data) {
      if (data == "OK") {
        ttr.hide();
        //console.log(ttr.get(0).tagName);
      } else {
        alert("ย้ายออกไม่ได้กรุณาลองอีกครั้ง");
      }
    });
  }
});

$(document).on("click", ".delt", function (e) {
  //console.log($(this).parent().parent().get( 0 ).tagName);
  var tid = $(this).data("id");
  var ttr = $(this).parent().parent();
  //alert(tid);
  if (confirm("ต้องการลบครู?") == true) {
    $.get("teacherdb.php", { do: "del", id: tid }).done(function (data) {
      if (data == "OK") {
        ttr.hide();
        //console.log(ttr.get(0).tagName);
      } else {
        alert("ลบออกไม่ได้กรุณาลองอีกครั้ง");
      }
    });
  }
});

$("#cPass").on("show.bs.modal", function (event) {
  var id = $(event.relatedTarget).attr("data-id");
  //alert($(event.relatedTarget).attr("data-id"));
  $("#tid").val(id);
  $("#pwd").val("");
  $("#pwd").removeClass("is-invalid");
  $("#pwd").removeClass("is-valid");
});

$(document).on("click", "#savepwd", function (e) {
  //console.log($(this).parent().parent().get( 0 ).tagName);
  var tid = $("#tid").val();
  var pwd = $("#pwd").val();
  if (pwd == "") {
    $("#pwd").addClass("is-invalid");
  } else {
    $.get("teacherdb.php", { do: "pwd", id: tid, pwd: pwd }).done(function (
      data
    ) {
      if (data == "OK") {
        alert("เปลี่ยนรหัสผ่านแล้ว");
        $("#cPass").modal("toggle");
      } else {
        alert("เปลี่ยนรหัสผ่านไม่ได้กรุณาลองอีกครั้ง");
      }
    });
  }
});

$(document).on("change keyup", "#pwd", function (e) {
  //console.log($(this).parent().parent().get( 0 ).tagName);
  var pwd = $("#pwd").val();
  if (pwd == "") {
    $("#pwd").removeClass("is-valid").addClass("is-invalid");
  } else {
    $("#pwd").removeClass("is-invalid").addClass("is-valid");
  }
});

$(document).on("click", ".editt", function (e) {
  alert("ยังไม่เปิดใช้งาน");
});

$(document).on("dblclick", ".editable", function () {
  var text = $(this).text();
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
    var xtmpData = $("#tmpSel").val();
  } else {
    var xtmpData = $("#tmpData").val();
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
