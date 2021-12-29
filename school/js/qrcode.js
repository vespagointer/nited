$("#qrcode").submit(function (event) {
  event.preventDefault();
  var info = $(this).serialize();
  var url = $(this).attr("action");
  $.post(url, info).done(function (data) {
    $("#newQr").attr("src", "../temp/qrcode.png?" + new Date().getTime());
    $("#newQr").show();
  });
});
