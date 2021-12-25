var jID;
var jOption = "";
$(document).ready(function () {
    for (let i = 0; i < pID.length; i++) {
        jID = pID[i];
        jOption = jOption + "<option value='" + pID[i] + "'>" + pName[pID[i]] + "</option>";
    }
    //console.log(jOption);
    $('#project').html(jOption);
    $("#other").hide();
});

$("#add").click(function(e){
    var sel =$("#project").val();
    var term1 =$("#tname").val();
    var term2 =$("#tel").val();
    var url="addproject.php";
    //console.log(sel);

    var posting = $.post(url, {
        pid: sel,
        tname: term1,
        tel: term2,
        sname: term3
    });

    posting.done(function(data) {
      //  $('#echo').html(data);
        if(data=="OK"){
            pID = jQuery.grep(pID, function (value) {
                return value != sel;
            });
        
            jOption="";
            for (let i = 0; i < pID.length; i++) {
                jID = pID[i];
                jOption = jOption + "<option value='" + pID[i] + "'>" + pName[pID[i]] + "</option>";
            }
            $('#projectlist').load("projectlist.php");
            $('#project').empty().html(jOption);
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
        }
    });


});

$("#add2").click(function(e){
    var term0 =$("#project2").val();
    var term1 =$("#ptype").val();
    var term2 =$("#funder").val();
    var term4 =$("#tname2").val();
    var term5 =$("#tel2").val();
    var url="addproject.php";
    //console.log(sel);

    var posting = $.post(url, {
        pname: term0,
        ptype: term1,
        funder: term2,
        scname: term3,
        scperson: term4,
        sctel: term5
    });

    posting.done(function(data) {
        if(data=="OK"){
            $("#project2").val("");
            $("#ptype").val("1");
            $("#funder").val("");
            $("#tname2").val("");
            $("#tel2").val("");
            $("#other").hide();

            $('#projectlist').load("projectlist.php");
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
        }
    });


});

$(document).on('click', '.delbtnp', function(e) {
    var spid=$(this).data("id");
    var delid=$(this).data("del");
   // alert(delid);
    var url="delp.php";
    //return confirm("ต้องการลบข้อมูล?");
    if(confirm("ต้องการลบโครงการ?")==true){
        var posting = $.post(url, {
            pid: delid
        });

        posting.done(function(data) {
            //  $('#echo').html(data);
              if(data=="OK"){
                  pID.push(spid);
                  pID.sort();
                  jOption="";
                  for (let i = 0; i < pID.length; i++) {
                      jID = pID[i];
                      jOption = jOption + "<option value='" + pID[i] + "'>" + pName[pID[i]] + "</option>";
                  }
                  $('#projectlist').load("projectlist.php");
                  $('#project').empty().html(jOption);
                  $('.delbtnp').tooltip();
              }
          });
    }else{
        return false;
    }
})

$(document).on('click', '.delbtnpo', function(e) {
    var delid=$(this).data("del");
    //alert(delid);
    var url="delpo.php";
    //return confirm("ต้องการลบข้อมูล?");
    if(confirm("ต้องการลบโครงการ?")==true){
        var posting = $.post(url, {
            pid: delid
        });

        posting.done(function(data) {
            //  $('#echo').html(data);
              if(data=="OK"){
                  $('#projectlist').load("projectlist.php");
                  $('.delbtnp').tooltip();
              }
          });
    }else{
        return false;
    }
})

$(document).on('change click', '#ptype', function(e) {
    var ptype = $(this).val();
    if(ptype==1){
        $("#other").hide();
    }else{
        $("#other").show();
    }
    
});