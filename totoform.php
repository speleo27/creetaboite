<?php
session_start();
if(empty($_SESSION['auth']) || $_SESSION['auth']['admin']== 0){
session_destroy();
    header("Location:accueil");

}


require_once 'template/header.php';
?>

<section class="mb-4">
    <div class="container-fluid" >
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h2 class='h2 text-center' style="color:#0C8384">Formulaire création </h2>
                    </div>
                    <div class="card-body">
                        <form action="controller/ctrltotoform.php" method= 'post' id="formCreate">
                            <div class="form-row d-flex">
                                <div class="form-group ">
                                    <label for="societe_ref_prosp">Référence prospect :</label>
                                    <input class="form-control-sm" type="text" name="societe_ref_prosp" id="societe_ref_prosp_create">
                                </div>
                                <div class="form-group ">
                                    <label for="societe_ref_customer">Référence client :</label>
                                    <input class="form-control-sm" type="text" name="societe_ref_customer" id="societe_ref_customer_create">
                                </div>
                            </div>
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
                            <div class='form-row d-inline '>
                                <div class="form-group ">
                                <label for="customer_name">Nom du dirigeant</label>
                                <input class="form-control" type="text" name="customer_fullname" id="customer_fullname_create">
                                </div>
                                <div class="form-group ">
                                <label for="customer_name">Prénom du dirigeant</label>
                                <input class="form-control" type="text" name="customer_firstname" id="customer_firstname_create">
                                </div>
                            </div>
                            <div class='form-group'>
                                <div class='form-group '>
                                    <label for="customer_email">Email</label>
                                    <input class="form-control" type="email" name="customer_email" id="customer_email_create">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_phone">Téléphone :</label>
                                <input type="text" name="customer_phone" id="customer_phone_create">
                            </div>
                            <div class="form-group">
                                <label for="">Status dans la société:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="cust_status" id="dirigeant" value="1" checked>
                                    <label class="form-check-label" for="">Dirigeant</label>
                                </div>
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="cust_status" id="dirigeant_ass" value="2">
                                    <label class="form-check-label" for="">Dirigeant-Associé</label>
                                </div>
                                <div class="form-check form-check-inline ">
                                    <input class="form-check-input" type="radio" name="cust_status" id="ass" value="3">
                                    <label class="form-check-label" for="">Associé</label>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="">nom de la société</label>
                                <input type="text" name="societe_name" id="societe_name_create">
                            </div>

                            <div class="form-inline">
                                <div class="input-group">                   
                                    <label>Durée de l'entretiens</label>
                                    <input type="text" name="time_work" id="time_work">
                                    <div class='input-group-append'>
                                        <span class="input-group-text">min</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comments">Commentaire :</label>
                                <textarea class="form-control" name="comments" id="comments" cols="30" rows="3"></textarea>
                            </div>
                            </div>
                            <input type="submit" class='btn btn-block btn-outline-light' style="background-color:#13a8d9" id="btncreate" value="Créer">
                        </form>
                    </div>
                </div>
            </div>
        </div>              
    </div>
</section>




<?php
require_once 'template/footer.php';
