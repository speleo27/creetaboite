<?php
session_start();
if(!isset($_SESSION['auth'])){
session_destroy();
    header("Location:accueil");

}
include 'controller/nationality.php';
require_once 'template/header.php';
//var_dump($_SESSION);
$reqAss = $bdd->prepare('SELECT * FROM associates INNER JOIN customer ON (associates.customer_id = customer.customer_id) WHERE associates.societe_ref_prosp = ? AND customer.cust_status !=1');
$reqAss->execute(array($_SESSION['auth']['societe_ref_prosp']));

$reqSoc= $bdd->prepare('SELECT number_action FROM societe WHERE societe_ref_prosp = ? ');
$reqSoc->execute(array($_SESSION['auth']['societe_ref_prosp']));
$dataAc= $reqSoc->fetch();
//var_dump($dataAc);

?>
<section>
    <div class="container">
        <h2 class='text-center'>Tableau récapitulatif des associés</h2>
        <form action="controller/addass.php" method="post">
            <!-- Button trigger modal -->
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary btn-lg  mb-1" id="countModal" data-toggle="modal" data-target="#addass">Identifier un associé</button>
            </div>
            
            <input type="hidden" id="ctrlAction" value="<?=$dataAc['number_action']?>">
                <table class="table" id="arrayAssociate">
                    <thead class="thead">
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Participation</th>
                            <th>Nombre action</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody" id="tableAssociate">
                        <?php
                        
                        while($dataAss= $reqAss->fetch()){
                         
                            //var_dump($dataAss);
                            echo"
                        <tr>
                            <td name='ass_fullname'>".$dataAss["customer_fullname"]. "</td>
                            <td name='ass_firstname'>".$dataAss["customer_firstname"] ."</td>
                            <td id='percentAss' name='ass_participation'>".$dataAss['associate_participation']." </td>
                            <td id='actionAss' name='ass_nb_action'>".$dataAss['associate_nb_action'] ."</td>";
                            if($dataAss['cust_status'] !=2){
                                echo"
                            <td><a href='controller/deleteAss.php?toto=".$dataAss['customer_id']."' type='button' class='btn btn-danger deletebtn'><i class='fa fa-trash'></i></button></td>
                        </tr>";
                        }
                    }
                        ?>

                    </tbody>
                </table>
            </div>
            <a href="summary.php" class="btn btn-block btn-outline-light " type="button" name="send" id="btnnext4">Suivant</a>
        </form>
    </div>
</section>
<!-- Modal Ajout associé -->
<div class="modal fade" id="addass" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un associé</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addassform" action="controller/addass.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="cust_status" value="3">
                    <input type="hidden" id="number_action" value="<?= $dataAc['number_action'] ?>">
                    <div class="form-group">
                        <label for="">Civilité:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="civility" id="civility_mister" value="monsieur" checked>
                            <label class="form-check-label" for="civility">Monsieur</label>
                        </div>
                        <div class="form-check form-check-inline ">
                            <input class="form-check-input" type="radio" name="civility" id="civility_miss" value="madame">
                            <label class="form-check-label" for="civility">Madame</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="customer_full_name"> Nom:</label>
                            <input class="form-control" type="text" name="customer_full_nameAss" id="customer_full_name">
                        </div>
                        <div class="form-group col-6">
                            <label for="customer_first_name">Prénom:</label>
                            <input class="form-control" type="text" name="customer_first_nameAss" id="customer_first_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="customer_email">Email:</label>
                        <input class="form-control" type="email" name="customer_emailAss" id="customer_email">
                    </div>
                    <div class="form-group">
                        <label for="customer_phone">Téléphone:</label>
                        <input class="form-control" type="text" name="customer_phoneAss" id="customer_phone">
                    </div>
                    <div class="form-group">
                        <label for="customer_address"> Adresse :</label>
                        <input class="form-control" type="text" name="customer_addressAss" id="customer_adress">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="custumor_zip">Code Postal :</label>
                            <input class="form-control" type="number" name="customer_zipAss" id="customer_zip">
                        </div>
                        <div class="form-group col-8">
                            <label for="customer_city">Ville :</label>
                            <input class="form-control" type="text" name="customer_cityAss" id="customer_city">
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col-md-4">
                            <label for="customer_birthday">Date de naissance :</label>
                            <input class="form-control" type="date" name="customer_birthdayAss" id="customer_birthday">
                        </div>
                        <div class="form-group col-4"> 
                            <label for="customer_place_of_birth">Lieu de naissance :</label>
                            <input class="form-control" type="text" name="customer_place_of_birthAss" id="customer_place_of_birth">
                        </div>
                    
                        <div class="form-group col-4">
                            <label for="customer_natinality">Nationalité : </label>
                            <select class="form-control" name="customer_nationalityAss" id="customer_nationality">
                            <?php foreach($citizenships as $pays):?>
                                <option value="<?= $pays['nationalite'] ?>" <?= $pays['nationalite']== 'Française'? "selected" : ""?> ><?= $pays['nationalite'] ?></option>
                            <?php endforeach;?>   
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="number_action">Nombre d'action :</label>
                            <input class="form-control inpNotNegative" type="number" min="1" name="number_actionAss" id="number_actionAss" onkeyup="calcPercent()" >    
                        </div>
                        <div class="form-group col-4">
                            <label for="participation">Pourcentage de participation :</label>
                            <input class="form-control inpNotNegative" type="number" min="1" step="0.01" max="100" name="participationAss" id="participationAss" value="" >      
                        </div>  
                    </div>  

                    <div class="form-group">
                        <label for="ci"> Piece d'identité carte de séjour ou passeport
                        </label>
                        <input type="file" name="ci_Ass" id="ci_Ass" class="form-control" accept=".jpg,.jpeg,.JPEG,.JPG,.PDF,.pdf,.tiff,.TIFF" >
                        
                    </div>
                    <div class="form-group">
                        <label for="just_dom">Le justificatif de domicile: 
                        </label>
                        <input type="file" name="just_dom_Ass" id="just_dom_Ass" class="form-control" accept=".jpg,.jpeg,.JPEG,.JPG,.PDF,.pdf,.tiff,.TIFF"  >
                        
                    </div>
                    <div class="form-group">
                        <label for="attest_no_cond"> Attestation de non condamnation
                        </label>
                        <input type="file" name="attest_no_cond_Ass" id="attest_no_cond_Ass" class="form-control" accept=".jpg,.jpeg,.JPEG,.JPG,.PDF,.pdf,.tiff,.TIFF">
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="btnaddass" name="btnaddass">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    //traitement de la modal d'ajout d'un associer
 $(document).ready(function () 
 {
    //var val_td = 0;
    mafonction_calcul();
        //alert( $("#ctrlAction").val());
        if(val_td < $("#ctrlAction").val()){
            alert('attention le nombres d\'action inférieur au nombre d\'actions totales de la societée');
            $("#btnnext4").addClass('d-none');
        }if(val_td >$("#ctrlAction").val()){
            alert('Veuillez vérifier votre saisie erreur trop d\'actions distribuées');
            $("#btnnext4").addClass('d-none');
            $("#countModal").addClass('d-none');
        }
    
        

        

    $('#btnaddass').click(function()
     {
        //parti soustraction des action saisie au nombre action total paramétrer avec le bouton continuer

        var nbActionTt = parseInt($("#ctrlAction").val());
                var nbActionAss=$("#actionAss").val();
                var stayAction= nbActionTt - nbActionAss;
                $("#ctrlAction").val(stayAction);


//     var tr= $("tr").length;
//         if(tr>=10){
//             $("#countModal").addClass("d-none");
//             alert('Vous ne pouvez avoir plus de 10 associés ');
//         }  
//    // submitasso('addassform','post','controller/addass.php',nbclick);
    //ici calcul addition des pourcentages et soustraction du nd d'action
               //parti soustraction des action saisie au nombre action total paramétrer avec le bouton continuer

                
//       // parti sur le pourcentage avec incrémentation 
//       var partAss = parseFloat($("#participationAss").val());
//                 var partAct =parseFloat( $("#particip").val()) ;
//                 var inpAct = partAss+ partAct;
//                 inpAct.toFixed(2);
//                 $("#particip").val(inpAct);
//         if( ($("#particip").val()!=100) || ($("#ctrlAction").val() != 0) )
//         {
            
//                 alert('veuillez vérifier les pourcentages de participation');
//                 $("#btnnext3").addClass("d-none");
          
//         } else{
//             $("#btnnext3").removeClass("d-none");
//             $("#countModal").addClass("d-none");
//         }   
   });  

});
</script>