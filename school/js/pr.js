ClassicEditor.create(document.querySelector("#prcontent"), {
    ckfinder: {
        uploadUrl: "../ckupload.php",
    },
    image: {
        resizeOptions: [{
                name: 'resizeImage:original',
                value: null,
                icon: 'original'
            },
            {
                name: 'resizeImage:25',
                value: '25',
                icon: 'small'
            },
            {
                name: 'resizeImage:50',
                value: '50',
                icon: 'medium'
            },
            {
                name: 'resizeImage:75',
                value: '75',
                icon: 'large'
            }
        ],
        toolbar: [
            'imageStyle:inline',
            'imageStyle:wrapText',
            'imageStyle:breakText',
            '|',
            'toggleImageCaption',
            'imageTextAlternative',
            'linkImage',
            '|',
            'resizeImage:25',
            'resizeImage:50',
            'resizeImage:75',
            'resizeImage:original',
        ]
    }
}).catch((error) => {
    console.error(error);
});
$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var mode = urlParams.get("mode"); //success
    console.log(mode);
    if (mode != "edit") {
        $("#prForm").hide();
    }
});
$("#add").click(function() {
    $("#prForm").toggle("slow");
    $("html, body").animate({
            scrollTop: 0,
        },
        "slow"
    );
});
$(document).on("click", ".delpr", function(e) {
    //console.log($(this).parent().parent().get( 0 ).tagName);
    var aid = $(this).data("id");
    var ttr = $(this).parent().parent();
    //alert(tid);
    if (confirm("ต้องการลบข่าว?") == true) {
        $.get("del.php", {
            m: "pr",
            id: aid
        }).done(function(data) {
            // alert(data);
            if (data == "OK") {
                ttr.hide();
                //console.log(ttr.get(0).tagName);
            } else {
                alert("ลบไม่ได้กรุณาลองอีกครั้ง");
            }
        });
    }
});