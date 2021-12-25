(function () {
  "use strict";

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll(".needs-validation");

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });
})();

$("#adate").datepicker({
  format: "dd/mm/yyyy",
  maxViewMode: 2,
  language: "th",
  daysOfWeekHighlighted: "0,6",
  autoclose: true,
  todayHighlight: true,
});

$(document).ready(function () {
  $("#addAward").hide();
});

$("#add").click(function () {
  $("#addAward").show("slow");
  $("html, body").animate(
    {
      scrollTop: 0,
    },
    "slow"
  );
});

$(document).on("click", ".dela", function (e) {
  //console.log($(this).parent().parent().get( 0 ).tagName);
  var aid = $(this).data("id");
  var ttr = $(this).parent().parent();
  //alert(tid);
  if (confirm("ต้องการลบรางวัล?") == true) {
    $.get("dela.php", { do: "del", id: aid }).done(function (data) {
      if (data == "OK") {
        ttr.hide();
        //console.log(ttr.get(0).tagName);
      } else {
        alert("ลบไม่ได้กรุณาลองอีกครั้ง");
      }
    });
  }
});
