$(document).ready(function () {
    $("#stdaward").DataTable({
        order: [[0, "desc"]],
        pageLength: 50,
        buttons: [
            //"searchBuilder",
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
        dom: "QBfrtlpi",
    });
});