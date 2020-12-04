



// recuperation du data-upfile
function recupDataUpfile(id){
    var upfile = $(id).data("upfile");
    console.log(upfile);
    return upfile;
}

// création de la requete d'upload
function upload_doc(type,url,idFile,showbtn,choice,inputToSend,showfile,showname,btnupload){
var data = new FormData();
jQuery.each($('#'+ idFile)[0].files, function(i, file) {
    data.append(idFile+'-'+i, file);
});
    $.ajax
    ({
        type:type,
        url: url,
        data: data,
        contentType: false,
        cache: false,
        processData :false,
        beforeSend: function () {
            $('#'+btnupload).removeAttr('disable')
        },
        success: function(response) 
        { 
             if(response!= '')
             {
                 console.log(response);
        var fileName= response.split('/');

        $("#"+showname).html('<span>'+fileName[1]+'</span>');
        $("#"+showbtn).removeClass('d-none');
        var link = "upload/"+response;
        var linkgood= link.replace(' ',""); // on essai de de retirer les espace de début et de fin 
        $("#"+showfile).attr('href',linkgood);
        $('#'+choice).addClass('d-none');
        $('#'+inputToSend).attr("value",response);
                
        }
        },
       
    });
}
// creation de la function suppression
    
function deleteUploadFile(showfile,showname,showbtn,inputToSend,choice){
    $('#'+showfile).attr('href','');
    $('#'+showbtn).addClass('d-none');
    $('#'+showname).remove();
    $('#'+choice).removeClass('d-none');
    $('#'+inputToSend).attr("value",'');
}

// fonction pour traitement des données

function gestformnext(idform,type,url,idsection1,idsection2){
    var myform = document.getElementById(idform);
    var data = new FormData(myform);
    $.ajax
    ({
        method: type,
        url: url,
        data: data,
        contentType: false,
        cache: false,
        processData:false,

        success: function(response)
        {
            $('#'+idsection1).removeClass('d-none');
            $('#'+idsection2).addClass('d-none'); 
        }
    });
}

   //gestion du clic choix status avec aficchage ou non du du nombre associer
   function affnbass(idradio1,idinput,idradio2,idradio3,idradio4) {
    $("#"+idradio1).click(function(){
        $("#"+idinput).removeClass("d-none");
        $("#btnnext3").addClass("d-none");       
    });
    $("#"+idradio2).click(function(){
        $("#"+idinput).removeClass("d-none");
        $("#btnnext3").addClass("d-none");        
    });
    $("#"+idradio3).click(function(){
        $("#"+idinput).addClass("d-none");
        $("#btnnext3").removeClass("d-none");
        $("ctrlnumber").addClass('d-none');
    });
    $("#"+idradio4).click(function(){
        $("#"+idinput).addClass("d-none");
        $("#btnnext3").removeClass("d-none");
        $("ctrlnumber").addClass('d-none');
    });
    
}
    



function downloadAttest(type,url){
    
    var data = $('#formattest')
    $.ajax({
        method:type,
        url:url,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
       
        success: function(resp){ 
            $("#attestnocond").addClass('d-none');
            $("#warning").removeClass('d-none');
                                    
        }

    });
}




      
$(".inpNotNegative").keypress(function(event) {
    if ( event.which == 45 || event.which == 189 ) {
        event.preventDefault();
     }
  });

function ctrlParticipation(inpHidden,idPercent){
    idPercent=$("#"+idPercent).val();
    inpHidden= $("#"+inpHidden).val();
    inphidden= inpHidden + idPercent;
    if(inpHidden !==100){
        if(inpHidden>100){
            $("#countModal").addClass('d-none');
        }else{
        $("#btnnext3").attr('disabled');
        }
    }
    
}

function calcPercent(){
    var nbTotalAction = $("#number_action").val();
    var actionAss= $("#number_actionAss").val();
    var percentAss= (actionAss/nbTotalAction)*100;
    percentAss.toFixed(2);
    $("#participationAss").val(percentAss);
}

function mafonction_calcul() {
    val_td = 0;
       $("#arrayAssociate").children("#tableAssociate").children("tr").children("td:nth-child(4)").each(function() {
          val_td  += parseInt( $(this).text());
       });
 }
function recupIdProsp(id){
    $("#delsoc").val(id);
}
