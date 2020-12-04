<?php
session_start();
if(!isset($_SESSION['auth'])){
session_destroy();
    header("Location:accueil");

}
include 'controller/nationality.php';
require_once 'template/header.php';
//var_dump($_SESSION);
$requpdatecusto = $bdd->prepare('SELECT * FROM customer LEFT JOIN societe ON customer.societe_ref_prosp = societe.societe_ref_prosp WHERE customer.societe_ref_prosp=? and customer.cust_status!=3 ');
$requpdatecusto->execute(array(
$_SESSION['auth']['societe_ref_prosp'],
));
$datas= $requpdatecusto->fetchAll();
// var_dump($data);
// die();




//var_dump($_SESSION);
?>
<section class="mb-4">
    <div class="container" >
        <h2 class="h2 text-center">Veuillez remplir le formulaire suivant</h2>
    </div>
</section>


<section class="mb-4" id="section1">
    <div class="container" >
        <h3 class="h3 text-center">Le dirigeant</h3>
        <?php
            foreach($datas as $data) : ?>
        <form id="boss" method="POST"> 
            <div class="form-row ">
                <input type="hidden" name="societe_ref_prosp" value="<?= $data['societe_ref_prosp']?>">
                <div class="form-group col-6">
                    <label for="customer_full_name"> Nom:</label>
                    <input class="form-control" type="text" name="customer_fullname" id="customer_full_name" value="<?= $data["customer_fullname"]?> ">
                </div>
                <div class="form-group col-6">
                    <label for="customer_first_name">Prénom:</label>
                    <input class="form-control" type="text" name="customer_firstname" id="customer_first_name" value="<?= $data["customer_firstname"] ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="customer_email">Email:</label>
                <input class="form-control" type="email" name="customer_email" id="customer_email" value="<?= $data["customer_email"] ?>">
            </div>
            <div class="form-group">
                <label for="customer_phone">Téléphone:</label>
                <input class="form-control" type="text" name="customer_phone" id="customer_phone" value="<?= $data["customer_phone"]?>">
            </div>
            <?php endforeach; 
        ?>
            <div class="form-group">
                <label for="customer_address"> Adresse :</label>
                <input class="form-control" type="text" name="customer_address" id="customer_adress" >
            </div>
            <div class="form-row">
                <div class="form-group col-4">
                    <label for="custumor_zip">Code Postal :</label>
                    <input class="form-control" type="number" name="customer_zip" id="customer_zip" >
                </div>
                <div class="form-group col-8">
                    <label for="customer_city">Ville :</label>
                    <input class="form-control" type="text" name="customer_city" id="customer_city" >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-4">
                    <label for="customer_birthday">Date de naissance :</label>
                    <input class="form-control" type="date" name="customer_birthday" id="customer_birthday">
                </div>
                <div class="form-group col-4"> 
                    <label for="customer_place_of_birth">Lieu de naissance :</label>
                    <input class="form-control" type="text" name="customer_place_of_birth" id="customer_place_of_birth">
                </div>
            
                <div class="form-group col-4">
                    <label for="customer_natinality">Nationalité : </label>
                    <!-- <input class="form-control " type="text" name="customer_nationality" id="customer_nationality"> -->
                    <select class="form-control" name="customer_nationality" >
                    <?php foreach($citizenships as $pays):?>
                        <option value="<?= $pays['nationalite'] ?>" <?= $pays['nationalite']== 'Française'? "selected" : ""?> ><?= $pays['nationalite'] ?></option>
                    <?php endforeach;?>   
                    </select>
                </div>
            </div>
            <button type="button" class="btn btn-block btn-outline-light" id="btnnext1">Suivant</button>
        </form>

    </div> 
</section>


<!-- <i class="fa fa-trash text-light"></i> -->

<section class="d-none mb-4" id="section2"> 
    <div class="container" >
        <form id="paper">
            <h3 class="h3 text-center">Téléverser vos documents:</h3>
            
            <!-- ici on traite la carte d'identité -->
            <div class="form-group justify-content-between d-flex">
                <label  for="upload_ci">La carte d'identité, de séjour ou le passeport (Recto-Verso):</label>
                <input  type="hidden" name="upload_ci" id="upload_ci" accept=".jpg,.jpeg,.JPEG,.JPG,.PDF,.pdf,.tiff,.TIFF"data-upfile="1">
                <div id="showbtn1" class='d-none'>
                    <div class="d-flex justify-content-end">
                        <a id="showfile1" class="btn btn-light ml-2" target="_blank">Voir mon fichier</a>    
                        <button id="deletefile1" type="button" class="btn btn-danger ml-2" ><i class="fa fa-trash"></i></button>
                    </div>
                    <div id="showname1" class="mt-1 ml-2 text-center d-none d-md-block"></div>
                </div>
                <button type="button" data-toggle="modal" data-target="#uploadModal1" class="btn btn-outline-light mr-0"id="choice1">choisir un fichier</button>
            </div>

                    <!-- ici on traite le just de dom   -->
            <div class="form-group justify-content-between d-flex">
                <label class="" for="upload_just_dom">Le justificatif de domicile:</label>
                <input  type="hidden" name="upload_just_dom" id="upload_just_dom" accept=".jpg,.jpeg,.JPEG,.JPG,.PDF,.pdf,.tiff,.TIFF"data-upfile="2">
                <input type="hidden" id="societe_ref_prosp2" value="<?= $_SESSION['auth']['societe_ref_prosp']?>">
                <div id="showbtn2" class='d-none'>
                    <div class="d-flex justify-content-end">
                        <a id="showfile2" class="btn btn-light ml-2" target="_blank">Voir mon fichier</a>
                        <button id="deletefile2" type="button" class="btn btn-danger ml-2" ><i class="fa fa-trash"></i></button>
                    </div>
                    <div id="showname2" class="mt-1 ml-2 text-center d-none d-md-block"></div>
                </div>
                <button type="button" data-toggle="modal" data-target="#uploadModal2" class="btn btn-outline-light mr-0 " id="choice2">choisir un fichier</button>
            </div>


            <!-- ici on traite l' attestation de non cond -->
            <div class="form-group justify-content-between d-flex">
                <label class='' for="upload_no_cond">L'attestation de non condamnation :</label>
                <input type="hidden" name="upload_no_cond" id="upload_no_cond" accept=".jpg,.jpeg,.JPEG,.JPG,.PDF,.pdf,.tiff,.TIFF"data-upfile="3">
                <input type="hidden" id="societe_ref_prosp3" value="<?= $_SESSION['auth']['societe_ref_prosp']?>">
                <div id="showbtn3" class='d-none'>
                    <div class="d-flex justify-content-end">
                        <a id="showfile3" class="btn btn-light ml-2" target="_blank">Voir mon fichier</a>
                        <button id="deletefile3" type="button" class="btn btn-danger ml-2" ><i class="fa fa-trash"></i></button>
                    </div>
                    <div id="showname3" class="mt-1 ml-2 text-center d-none d-md-block"></div>
                </div>
                <button type="button" data-toggle="modal" data-target="#uploadModal3" class="btn btn-outline-light mr-0" id="choice3">choisir un fichier</button>
            </div>

            <!-- ici on traite le RIB -->
            <div class="form-group justify-content-between d-flex">
                <label class='' for="upload_rb">Votre Rélevé d'Identité Bancaire :</label>
                <input  type="hidden" name="upload_rb" id="upload_rb" accept=".jpg,.jpeg,.JPEG,.JPG,.PDF,.pdf,.tiff,.TIFF"data-upfile="4">
                
                <div id="showbtn4" class='d-none'>
                    <div class="d-flex justify-content-end">
                        
                        <a id="showfile4" class="btn btn-light ml-2" target="_blank">Voir mon fichier</a>
                        <button id="deletefile4" type="button" class="btn btn-danger ml-2" ><i class="fa fa-trash"></i></button>
                    </div>
                    <div id="showname4" class="mt-1 ml-2 text-center d-none d-md-block"></div>
                </div>
                <button type="button" data-toggle="modal" data-target="#uploadModal4" class="btn btn-outline-light mr-0" id="choice4">choisir un fichier</button>
            </div>


            <!-- ici on traite le dépot de fond -->
            <div class="form-group justify-content-between d-flex">
                <label  class=''for="upload_attest_found">Votre attestation de dépôt de fond</label>
                <input  type="hidden" name="upload_attest_found" id="upload_attest_found" accept=".jpg,.jpeg,.JPEG,.JPG,.PDF,.pdf,.tiff,.TIFF"data-upfile="5">
                <input type="hidden" id="societe_ref_prosp5" value="<?= $_SESSION['auth']['societe_ref_prosp']?>">
                <div id="showbtn5" class='d-none'>
                    <div class="d-flex justify-content-end">
                        
                        <a id="showfile5" class="btn btn-light ml-2" target="_blank">Voir mon fichier</a>
                        <button id="deletefile5" type="button" class="btn btn-danger ml-2" ><i class="fa fa-trash"></i></button>
                    </div>
                    <div id="showname5" class="mt-1 ml-2 text-center d-none d-md-block"></div>
                </div>
                <button type="button" data-toggle="modal" data-target="#uploadModal5" class="btn btn-outline-light mr-0" id="choice5">choisir un fichier</button>
            </div>
            <button class='btn btn-outline-light btn-block' type="button" id="btnnext2">Suivant</button>
        </form> 
    </div>
</section>


<?php

?>
<section class="d-none mb-4" id="section3"> 
    <div class="container" >
        <h3 class='h3 text-center'>La société</h3>
        <form id="assos" action="controller/ctrluserform3.php" method="post">
        <div class="form-row ">
                <div class="form-group col-6">
                    <label for="social_denomination">Dénomination commerciale:</label>
                    <input class="form-control" type="text" name="social_denomination" id="social_denomination">
                </div>
                <div class="form-group col-6">
                    <label for="commercial_name">Nom commerciale:</label>
                    <input class="form-control" type="text" name="commercial_name" id="commercial_name">
                </div>
            </div>
            <div class='form-group'>
                <label for="">nom de la société</label>
                <input type="text" name="societe_name" id="societe_name_update" value="<?= $data['societe_name'] ?>">
            </div>
            <div class="form-group">
                <label for="societe_activity">Activité de votre société</label>
                <textarea class="form-control" name="societe_activity" id="societe_activity" rows="3"></textarea>
            </div>
            <div class="row">
                <div class="form-group col-4">  
                    <label for="capital">Montant du capital :</label>
                    <input class="form-control inpNotNegative" type="number" min="0" name="capital" id="capital" value="<?= $data['capital'] ?>">      
                </div>
            </div>
            <div class="form-group text-center">
                <p id="userp">Veuillez selectionner votre type de société :</p>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="societe_form" id="inlineRadio1" value="sas"required>
                    <label class="form-check-label" for="inlineRadio1">SAS</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="societe_form" id="inlineRadio2" value="sarl"required>
                    <label class="form-check-label" for="inlineRadio2">SARL</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="societe_form" id="inlineRadio3" value="sasu"required>
                    <label class="form-check-label" for="inlineRadio3">SASU</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="societe_form" id="inlineRadio4" value="eurl"required>
                    <label class="form-check-label" for="inlineRadio4">EURL</label>
                </div>
            </div>
            <div id="blockassos" class=" d-none">
                <div  class="form-group ">
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="action_price">Prix de l'action :</label>
                            <input class="form-control inpNotNegative" type="number" min="1" name="action_price" id="action_price"  >      
                        </div>  
                        <div class="form-group col-4">
                            <label for="number_action">Nombre d'action total :</label>
                            <input class="form-control inpNotNegative" type="number" min='1' name="number_action" id="number_action" >    
                        </div>
                    </div>
                </div>
           
                <div>
                    <button type="button" name="ctrlnumber" id="ctrlnumber" class="btn btn-outline-light  btn-block mb-2">Continuer</button>
                </div>
                
                <?php
                
                    if($data['cust_status']== 2 ){
                        echo" 
                <div class='form-row d-none' id='dir'>
                        <input type='hidden' value='".$data['customer_id']."'>
                    <div class='form-group'>
                      <label >Votre Nombres d'actions détenues</label>
                      <input type='number' name='associate_nb_action' id='number_actionAss' onkeyup='calcPercent()' class='form-control'>
                      <label for=''>Votre pourcentage de la societe</label>
                      <input type='number'id='participationAss'min='1' step='0.01' max='100' name='associate_participation' value=''>
                    </div>
                </div> 
                        ";

                    }
                ?>
                <input type="hidden" name="customer_id" value="<?= $data['customer_id'] ?>">
            </div>
          
            <button class="btn btn-block btn-outline-light " type="submit"  id="btnnext3">Suivant</button>
        </form>
    </div> 
</section>





<!-- zone des différente modal pour la gestion du formulaire -->

<!-- Modal upload ci-->
<div class="modal fade" id="uploadModal1" tabindex="-1" role="dialog" aria-labelledby="uploadModal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModal1">Téléverser document identité </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form>
                    <input  type="file" name="ci" id="ci" accept=".jpg,.jpeg,.JPEG,.JPG,.PDF,.pdf,.tiff,.TIFF" > 
                    
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnupload1" data-dismiss="modal"  class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal upload just dom-->
<div class="modal fade" id="uploadModal2" tabindex="-1" role="dialog" aria-labelledby="uploadModal2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModal2">Téléverser Justificatif de domicile </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form >
                <div class="modal-body">
                    <input type="file" name="just_dom" id="just_dom"accept=".jpg,.jpeg,.JPEG,.JPG,.PDF,.pdf,.tiff,.TIFF" >   
                </div>
                <div class="modal-footer">
                    <button type="button"id="btnupload2" data-dismiss="modal"  class="btn btn-primary" >Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal upload attest non conda-->
<div class="modal fade" id="uploadModal3" tabindex="-1" role="dialog" aria-labelledby="connectModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModal3">Téléverser Attestation de non condamnation </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form >
                <div class="modal-body">
                    <input type="file" name="attes_no_cond" id="attes_no_cond"accept=".jpg,.jpeg,.JPEG,.JPG,.PDF,.pdf,.tiff,.TIFF" >     
                </div>
                <div class="modal-footer">
                    <button type="button" id='btnupload3' data-dismiss="modal"  class="btn btn-primary" >Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal upload Rib-->
<div class="modal fade" id="uploadModal4" tabindex="-1" role="dialog" aria-labelledby="connectModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModal4">Téléverser Relever d'identité bancaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form >
                <div class="modal-body">
                    <input type="file" name="rb" id="rb"accept=".jpg,.jpeg,.JPEG,.JPG,.PDF,.pdf,.tiff,.TIFF" > 
                </div>
                <div class="modal-footer">
                    <button type="button" id='btnupload4' data-dismiss="modal"  class="btn btn-primary" >Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal upload attest depot de fond-->
<div class="modal fade" id="uploadModal5" tabindex="-1" role="dialog" aria-labelledby="connectModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModal5">Téléverser Attestation de dépot de fond </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form >
                <div class="modal-body">
                    <input type="file" name="attest_found" id="attest_found"accept=".jpg,.jpeg,.JPEG,.JPG,.PDF,.pdf,.tiff,.TIFF" > 
                 
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnupload5" data-dismiss="modal"  class="btn btn-primary" >Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
<script>
    //affichage des parties du formulaire pour affichage et envoie
    $(document).ready(function () {
        $('#btnnext1').click(function () {
            gestformnext('boss','post','controller/ctrluserform.php','section2','section1');
        });
        $('#btnnext2').click(function () { 
            let doc1= $("#upload_ci").val();
            let doc2= $("#upload_just_dom").val();
            let doc3= $("#upload_no_cond").val();
            let doc4= $("#upload_rb").val();
            let doc5= $("#upload_attest_found").val();
            if(doc1 == "" || doc2==""|| doc3=="" || doc4==""|| doc5==""){
            if(confirm("Les 5 documents sont nécessaires,souhaitez-vous continuer?")){
            gestformnext('paper','post','controller/ctrluserform2.php','section3','section2');
            affnbass('inlineRadio1','blockassos','inlineRadio2','inlineRadio3','inlineRadio4');}}
            else{
            gestformnext('paper','post','controller/ctrluserform2.php','section3','section2');
            affnbass('inlineRadio1','blockassos','inlineRadio2','inlineRadio3','inlineRadio4');
            }
        });
        $("#ctrlnumber").click(function()
        {
        $("#ctrlAction").val($("#number_action").val());
       
            if( $("#number_action").val()!='' && $("#action_price").val()!='' && $("#capital").val()!='')
            {
            
                if(($("#number_action").val()*$("#action_price").val()) != $("#capital").val())
                {
                    alert('Les montants suivant: capital, prix de l\'action et nombre d\'action ne correspodent pas');
                    $("#number_action").val('');
                    $("#action_price").val('');
                }
                else
                {
                
                    $("#dir").removeClass('d-none');
                    $("#ctrlnumber").addClass('d-none');
                    $("#btnnext3").removeClass('d-none');
                }
            }
   
        });
    });

    // gestion de la carte d'identité
 $(document).ready(function () {
    $('#btnupload1').click(function (){
        upload_doc("post","controller/ctrlupload_ci.php",'ci','showbtn1','choice1','upload_ci','showfile1','showname1','btnupload1');
    });
    $('#deletefile1').click(function(){
        deleteUploadFile('showfile1','showname1','showbtn1','upload_ci','choice1');
    });

    
    
});


// gestion du justificatif de domicile
$(document).ready(function () {
    $("#btnupload2").click(function () { 
        upload_doc("post","controller/ctlrupload_just_dom.php",'just_dom','showbtn2','choice2','upload_just_dom','showfile2','showname2'); 
    });
    $('#deletefile2').click(function(){
        deleteUploadFile('showfile2','showname2','showbtn2','upload_just_dom','choice2');
    });
});
// gestion attestation de non condamnation
$(document).ready(function () {
    $("#btnupload3").click(function () { 
        upload_doc("post","controller/ctlrupload_attest_no_cond.php",'attes_no_cond','showbtn3','choice3','upload_no_cond','showfile3','showname3');  
    });
    $('#deletefile3').click(function(){
        deleteUploadFile('showfile3','showname3','showbtn3','upload_no_cond','choice3');
    });
});
// gestion du RIB
$(document).ready(function () {
    $("#btnupload4").click(function () { 
        upload_doc("post","controller/ctlrupload_rb.php",'rb','showbtn4','choice4','upload_rb','showfile4','showname4');  
        
    });
    $('#deletefile4').click(function(){
        deleteUploadFile('showfile4','showname4','showbtn4','upload_rb','choice4');
    });
});
// gestion de l'attestattion de depot de fond
$(document).ready(function () {
    $("#btnupload5").click(function () { 
        upload_doc("post","controller/ctlrupload_attest_found.php",'attest_found','showbtn5','choice5','upload_attest_found','showfile5','showname5');  
    });
    $('#deletefile5').click(function(){
        deleteUploadFile('showfile5','showname5','showbtn5','upload_attes_found','choice5');
    });
});


</script>

<?php
require_once 'template/footer.php';
?>
