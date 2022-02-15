$(document).ready(function () {
  $("#hinput").hide();
});
$("#chose").click(function () {
  $("#hinput").click();
});

$("#hinput").change(function () {
  $("#review").html("");
  for (var i = 0; i < $(this).get(0).files.length; ++i) {
    //console.log($(this).get(0).files[i].name + "\n");
    var myurl = URL.createObjectURL($(this).get(0).files[i]);
    var ss = "";
    if (i == 0) {
      ss = "<br/>รูปนี้จะถูกใช้เป็นรูปปกและสไลด์";
    }
    var img =
      '<div class="col-4 text-center"><img src="' +
      myurl +
      '" class="img-fluid img-thumbnail"/>' +
      ss +
      "</div>";
    $("#review").append(img);
  }
});

$("#gallery").submit(function () {
  var validExtensions = ["jpg", "gif"];
  var gfile = $("#hinput").get(0).files;
  const num = gfile.length;
  if (num == 0) {
    alert("กรุณาเลือกรูปภาพด้วย");
    return false;
  }
  if (num > 12) {
    alert("จำนวนรูปภาพ ต้องไม่เกิน 12 รูป");
    return false;
  }

  for (var i = 0; i < num; ++i) {
    var fileName = gfile[i].name;
    var fileNameExt = fileName.substr(fileName.lastIndexOf(".") + 1);
    if ($.inArray(fileNameExt.toLowerCase(), validExtensions) == -1) {
      alert("ไฟล์รูปภาพประเภท JPEG (.jpg, .jpeg) เท่านั้น");
      return false;
    }
  }
  return true;
});
