$(document).ready(function () {
  $("#teacher").DataTable({
    pageLength: 25,
    buttons: [
      "searchBuilder",
      "copy",
      "excel",
      {
        extend: "csv",
        charset: "UTF-8",
        fieldSeparator: ",",
        bom: true,
      },
      "print",
    ],
    language: {
      url: "js/th.json",
    },
    dom: "Bfrtlpi",
  });
});
