tinymce.init({
    selector: 'textarea#content',
    path_absolute: "/",
    relative_urls: false,
    plugins: 'code table lists link image preview fullscreen media',
    toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright alignjustify | indent outdent bullist numlist | link image | preview media fullscreen | code',
    content_css: '../css/theme.css',
    content_style: "body {padding: 10px}",
    height: "500"
});

$(document).on("click", ".del", function (e) {
    var aid = $(this).data("id");
    var ttr = $(this).parent().parent();
    e.preventDefault();
    if (confirm("ต้องการลบหน้าเว็บ?") == true) {
        $.get("del.php", { mode: 'page', id: aid }).done(function (data) {
            //console.log(data);
            if (data == "OK") {
                ttr.hide();
                //console.log(ttr.get(0).tagName);
            } else {
                alert("ลบไม่ได้กรุณาลองอีกครั้ง");
            }
        });
    }
});

$("#weblist").dataTable({
    order: [[0, "desc"]],
    pageLength: 25,
    language: {
        url: "../js/th.json",
    },
});