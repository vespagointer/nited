$(document).ready(function () {
  $("#hinput").hide();
});
$("#chose").click(function () {
  $("#hinput").click();
});

$("#hinput").change(function () {
  for (var i = 0; i < $(this).get(0).files.length; ++i) {
    console.log($(this).get(0).files[i].name + "\n");
  }
});
