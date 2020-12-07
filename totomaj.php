<?php
session_start();
if(empty($_SESSION['auth']) || $_SESSION['auth']['admin']== 0){
session_destroy();
    header("Location:accueil");

}
require_once 'template/header.php';
include 'controller/function.php';

setlocale(LC_ALL, "fr_FR.utf-8");
//var_dump($_GET);
$reqmaj = $bdd->prepare('SELECT * FROM societe INNER JOIN customer ON (societe.societe_ref_prosp = customer.societe_ref_prosp) LEFT JOIN status ON ( societe.status_id = status.status_id) LEFT JOIN associates ON (customer.customer_id = associates.customer_id) LEFT JOIN local ON( societe.ref_int_local = local.ref_int_local) LEFT JOIN lease_term ON (lease_term.lease_term_id = societe.lease_term_id)   WHERE societe.societe_ref_prosp= ?  ');
$reqmaj->execute(array($_GET['societe_ref_prosp']));
$dataMaj = $reqmaj->fetchAll(PDO::FETCH_ASSOC);
// var_dump($dataMaj);
// die();
$reqhisto = $bdd->prepare("SELECT * FROM history INNER JOIN societe ON (societe.societe_ref_prosp = history.societe_ref_prosp) LEFT JOIN presta ON ( presta.prest_id = history.presta_id ) WHERE societe.societe_ref_prosp= ? ");
$reqhisto->execute(array($_GET['societe_ref_prosp']));
$datahisto = $reqhisto->fetchAll();
// var_dump($datahisto);
// die();
//var_dump($_GET);
//var_dump($dataMaj);
$reqlocal = $bdd->prepare("SELECT ref_int_local FROM local");
$reqlocal->execute(array());
$loc = $reqlocal->fetchAll(PDO::FETCH_ASSOC);
//var_dump($loc);
//die();


?>
<!--  identification de la société MAJ du N° client et du status -->
<section class='mb-4'>
    <div class="container">
        <h2 class="h2 text-center">Mettre a jour le client</h2>
        <!--ici identification pour par numéro   -->
        <h3 class="h3 text-center">
            <?= ($dataMaj['0']['societe_ref_customer'] != NULL ? $dataMaj['0']['societe_ref_customer'] . " " . $dataMaj['0']['societe_name']: $dataMaj['0']['societe_ref_cont'] != null)? $dataMaj['0']['societe_ref_cont'] . " " . $dataMaj['0']['societe_name']:$_GET['societe_ref_prosp'] . " " . $dataMaj['0']['societe_name'];
             ?></h3>
        <h3 class="text-danger text-center mb-2"><?= strtoupper($dataMaj['0']['status_type']) ?></h3>
        <form action="controller/ctrlmajdoc.php" method="post">
            <input type="hidden" name="societe_ref_prosp" value="<?= $_GET['societe_ref_prosp'] ?>">
            <div class="form-row d-flex">
                <div class="form-group ">
                    <label for="societe_ref_customer">Référence client :</label>
                    <input class="form-control-sm" type="text" name="societe_ref_customer" id="societe_ref_customer_update" value="<?= $dataMaj['0']['societe_ref_customer'] ?>">
                </div>
                <div class="form-group ">
                    <label for="societe_ref_contentieux">Référence contentieux :</label>
                    <input class="form-control-sm" type="text" name="societe_ref_cont" id="societe_ref_cont_update" value="<?= $dataMaj['0']['societe_ref_cont'] ?>">
                </div>
                <button class="btn btn-outline-light btn-block mb-2" type="submit" name="update10">Mettre à jour</button>
            </div>
        </form>
        <form action="controller/ctrlmajdoc.php" method="post">
            <input type="hidden" name="societe_ref_prosp" value="<?= $_GET['societe_ref_prosp'] ?>">
            <div class="form-row">
                <div class="form-group mb-2">
                    <label for="">Date de signature prévu des satuts : </label>
                    <input type="date" class="form-control" name="sign_date" >
                </div>
                <button class="btn btn-outline-light btn-block mb-2" type="submit" name="update11">Mettre à jour</button>
            </div>
        </form>
        <form action="controller/ctrlmajdoc.php" method="post">
            <input type="hidden" name="societe_ref_prosp" value="<?= $_GET['societe_ref_prosp'] ?>">
            <div class="input-group mb-2">
                <select class="custom-select" id="inputGroupSelect02" name="status_id">
                    <option selected>Selectionner un status</option>
                    <option value="1">Prospet</option>
                    <option value="2">Actif</option>
                    <option value="3">Archivé</option>
                    <option value="4">en contentieux</option>
                </select>
            </div>
            <button class="btn btn-block btn-outline-light" type="submit" name="update1">Mettre à jour</button>
        </form>
    </div>
</section>

<!-- affichage de tout les documents stocké pour le dossier -->
<section class='mb-4'>
    <div class="container">
        <h3 class="text-center mb-2">Editer un document</h3>
        <button type="button" class="btn btn-block btn-primary " data-toggle="modal" data-target="#editFiles">Editer un document</button>
    </div>
    <!-- Modal éditer un document -->
<div class="modal fade" id="editFiles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFiles">Générer un document </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="controller/editfiles.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row mb-2">
                        <select name="doc_id" class="form-control">
                            <?php $reqdocedit = $bdd->prepare("SELECT * FROM doc_generate WHERE doc_name_generate  IS NOT NULL");
                            $reqdocedit->execute(array());
                            $docedit = $reqdocedit->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($docedit as $doc) :  ?>
                                <option value="<?= $doc['doc_id'] ?>"><?= $doc['doc_name_generate'] ?></option>
                            <?php  endforeach; ?>
                        </select>
                    </div>
                    <div class="row mb-2">
                        <select name="customer_id" class="form-control">
                        <?php $reqasso=$bdd->prepare("SELECT * FROM associates LEFT JOIN customer on (customer.customer_id= associates.customer_id) WHERE customer.societe_ref_prosp =?");
                        $reqasso->execute(array($_GET['societe_ref_prosp']));
                        $assos=$reqasso->fetchAll(PDO::FETCH_ASSOC);
                        foreach($assos as $asso ): ?>
                            <option value="<?= $asso['customer_id'] ?>"><?= $asso['customer_fullname']." ".$asso['customer_firstname'] ?></option>
                            <?php  endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="">Nom du conjoint</label>
                            <input class="form-control" type="text " name="epname">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                        <label for="">Prénom du conjoint</label>
                        <input class="form-control" type="text " name="epfname">
                        </div>
                    </div>
                    <input type="hidden" name="societe_ref_prosp" value="<?= $_GET['societe_ref_prosp']?>">
                </div>
                <div class='modal-footer'>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <input type="submit" value="confirmer" class="btn btn-primary" id="btnedit"onClick="window.location.reload();">
                </div>
            </form>
        </div>
    </div>
</div>

    <div class="container">
        <h3 class="text-center">Liste des documents liés à la société</h3>
        <table class="table table-bordered mb-2 " id="doctable">
            <thead>
                <th scope="col" class="text-center">Type du document</th>
                <th scope="col" class="text-center">Date de création</th>
                <th scope="col" class="text-center">Nom du fichier</th>
                <th scope="col" class="text-center">Action</th>
            </thead>
            <tbody>
                <?php $requdoc = $bdd->prepare("SELECT * FROM upload LEFT JOIN doctype ON upload.upload_doctype_id = doctype.doctype_id WHERE societe_ref_prosp=?");
                $requdoc->execute(array($_GET['societe_ref_prosp']));
                $datadoc = $requdoc->fetchAll(PDO::FETCH_ASSOC);
                foreach ($datadoc as $doc) : //var_dump($doc);
                ?>
                    <tr>
                        <td><?= $doc['doctype_name'] ?></td>
                        <td><?= DateFormat($doc['upload_datetime']) ?></td>
                        <td><?= $doc['upload_doc_name'] ?></td>
                        <td><a href="upload/<?= $doc['societe_ref_prosp'] . '/' . $doc['upload_doc_name'] ?>" class="btn btn-success">Afficher</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="form-row mb-2 ">

            <button type="button" data-toggle="modal" data-target="#UploadFiles" class="btn btn-primary btn-block" >Ajouter des fichiers</button>
        </div>
    </div>
</section>
<!-- Modal ajout de fichiers -->
<div class="modal fade" id="UploadFiles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UploadFiles">Ajouter un document </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="controller/addfiles.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-row mb-2">
                        <input type="file" name="filesAdd" id="filesAdd" accept=".jpg,.jpeg,.JPEG,.JPG,.PDF,.pdf,.tiff,.TIFF">
                    </div>
                    <select name="doctype_id" class="form-control">
                        <?php $reqdoctype = $bdd->prepare("SELECT * FROM doctype");
                        $reqdoctype->execute(array());
                        $doctype = $reqdoctype->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($doctype as $doc) : if($doc['doctype_id']== 5 || $doc['doctype_id']== 6 || $doc['doctype_id']== 7 || $doc['doctype_id']== 8 || $doc['doctype_id']== 9 || $doc['doctype_id']== 10 || $doc['doctype_id']== 11 || $doc['doctype_id']== 12 || $doc['doctype_id']== 13 || $doc['doctype_id']== 14 || $doc['doctype_id']== 16 || $doc['doctype_id']== 17){ ?>
                            <option value="<?= $doc['doctype_id'] ?>"><?= $doc['doctype_name'] ?></option>
                        <?php } endforeach; ?>
                    </select>
                    <input type="hidden" name="societe_ref_prosp" value="<?= $_GET['societe_ref_prosp']?>">
                </div>
                <div class='modal-footer'>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <input type="submit" value="confirmer" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Remonter des entretiens et des prestations vendus -->
<section class="mb-4">
    <div class="container">
        <h3 class="text-center">Récapitulatif des derniers entretiens</h3>
    </div>
    <div>
        <?php
        $tottimes = 0;
        foreach ($datahisto as $rdv) :
            $tottimes += $rdv['time_work'];
            //var_dump($rdv);
        ?>
            <h5>Rendez-vous du <?= DateFormat($rdv['date'], 3) ?></h5>
            <ul class="list list-unstyled">
                <?php if ($rdv['comments'] != NULL) {
                    echo "
            <li>Commentaires sur les rendez-vous:" . $rdv['comments'] . "</li>";
                }
                if ($rdv['time_work'] != NULL) {
                    echo "
            <li>durée de l'entretien:" . $rdv['time_work'] . " minutes.</li>";
                }
                if ($rdv['prest_name'] != NULL) {
                    echo "
            <li>Prestation vendu : " . $rdv['prest_name'] . " </li>";
                } ?>
            </ul>
        <?php endforeach; ?>
        <p>Temps total passer sur le dossier: <?= hoursandmins($tottimes)   ?> min</p>
    </div>
</section>
<!--  MAJ des rendez-vous -->
<section class="mb-4">
    <h3 class="text-center mb-2">Rendez-vous du jour</h3>
    <form action="controller/ctrlmajdoc.php" method="post">
        <input type="hidden" name="societe_ref_prosp" value="<?= $_GET['societe_ref_prosp'] ?>">
        <div class="form-inline">
            <div class="input-group mb-2">
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
        <input type="submit" class='btn btn-block btn-outline-light' id="update2" value="Mettre à jour">
    </form>
</section>

<!-- ici identification des prestation qui vont être vendu -->
<section class='mb-4'>
    <div class="container">
        <h3 class="h3 text-center">Prestation délivrée</h3>
        <h4 class="text-danger text-center">ATTENTION SAISIR 1 PRESTATION A LA FOIS !</h4>
        <form action="controller/ctrlmajdoc.php" method="post">
            <input type="hidden" name="societe_ref_prosp" value="<?= $_GET['societe_ref_prosp'] ?>">
            <div class="form-group ">
                <div id="checkbox">
                    <input type="checkbox" name="presta_id[]" value="1">
                    <label for="prest_name">Etude de marché</label>
                </div>
                <div id="checkbox">
                    <input type="checkbox" name="presta_id[]" value="2">
                    <label for="prest_name">Buisness plan</label>
                </div>
                <div id="checkbox">
                    <input type="checkbox" name="presta_id[]" value="3">
                    <label for="prest_name">Création d'entreprise</label>
                </div>
                <div id="checkbox">
                    <input type="checkbox" name="presta_id[]" value="4">
                    <label for="prest_name">Comptabilité</label>
                </div>
                <div id="checkbox">
                    <input type="checkbox" name="presta_id[]" value="5">
                    <label for="prest_name">Branding</label>
                </div>
                <div id="checkbox">
                    <input type="checkbox" name="presta_id[]" value="6">
                    <label for="prest_name">Site internet</label>
                </div>
                <div id="checkbox">
                    <input type="checkbox" name="presta_id[]" value="7">
                    <label for="prest_name">Marketing</label>
                </div>
                <div id="checkbox">
                    <input type="checkbox" name="presta_id[]" value="8">
                    <label for="prest_name">Relation publique</label>
                </div>
                <div id="checkbox">
                    <input type="checkbox" name="presta_id[]" value="9">
                    <label for="prest_name">Vidéo</label>
                </div>
                <div id="checkbox">
                    <input type="checkbox" name="presta_id[]" value="10">
                    <label for="prest_name">Réseaux</label>
                </div>
                <div id="checkbox">
                    <input type="checkbox" name="presta_id[]" value="11">
                    <label for="prest_name">Fabrication</label>
                </div>
                <div id="checkbox">
                    <input type="checkbox" name="presta_id[]" value="12">
                    <label for="prest_name">Dépot de marque</label>
                </div>
                <div id="checkbox">
                    <input type="checkbox" name="presta_id[]" value="13">
                    <label for="prest_name">Bureaux</label>
                </div>
            </div>
            <!-- <div class="form-inline">
            <div class="input-group mb-2">                   
                <label>Durée de travail sur la prestation en minute</label>
                <input type="text" name="time_work" id="time_work">
                <div class='input-group-append'>
                    <span class="input-group-text">min</span>
                </div>
            </div> -->
    </div>
    <button type="submit" class='btn btn-block btn-outline-light' name="update3">Mettre à jour</button>
    </form>
    </div>
</section>
<!-- ici identification du gérant -->
<section class="mb-4">
    <div class="container">
        <form action="controller/ctrlmajdoc.php" method="post"> .
            <input type="hidden" name="societe_ref_prosp" value="<?= $_GET['societe_ref_prosp'] ?>">
            <input type="hidden" name="customer_id" value="<?= $dataMaj['0']['customer_id'] ?>">
            <h3 class="h3 text-center">Identification du Responsable de la société</h3>
            <div class="form-group">
                <label for="">Civilité:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="civility" id="civility_mister_update" value="monsieur" <?= $dataMaj[0]['customer_civility'] == 'monsieur' ? 'checked' : ''  ?>>
                    <label class="form-check-label" for="civility">Monsieur</label>
                </div>
                <div class="form-check form-check-inline ">
                    <input class="form-check-input" type="radio" name="civility" id="civility_miss_update" value="madame" <?= $dataMaj[0]['customer_civility'] == 'madame' ? 'checked' : ''  ?>>
                    <label class="form-check-label" for="civility">Madame</label>
                </div>
            </div>
            <div class="form-row ">
                <div class="form-group col-6">
                    <label for="customer_full_name"> Nom:</label>
                    <input class="form-control" type="text" name="customer_full_name" id="customer_fullname_update" value="<?= $dataMaj['0']['customer_fullname'] ?>  ">
                </div>
                <div class="form-group col-6">
                    <label for="customer_first_name">Prénom:</label>
                    <input class="form-control" type="text" name="customer_first_name" id="customer_first_name_update" value="<?= $dataMaj['0']['customer_firstname'] ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-8">
                    <label for="customer_email">Email:</label>
                    <input class="form-control" type="email" name="customer_email" id="customer_email_update" value="<?= $dataMaj['0']['customer_email'] ?>">
                </div>
                <div class="form-group col-4">
                    <label for="customer_phone">Téléphone:</label>
                    <input class="form-control" type="tel" name="customer_phone" id="customer_phone_update" value="<?= $dataMaj['0']['customer_phone'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="customer_address"> Adresse :</label>
                <input class="form-control" type="text" name="customer_address" id="customer_adress_update" value="<?= $dataMaj['0']['customer_address'] ?>">
            </div>
            <div class="form-row">
                <div class="form-group col-4">
                    <label for="custumor_zip">Code Postal :</label>
                    <input class="form-control" type="number" name="customer_zip" id="customer_zip_update" value="<?= $dataMaj['0']['customer_zip_code'] ?>">
                </div>
                <div class="form-group col-8">
                    <label for="customer_city">Ville :</label>
                    <input class="form-control" type="text" name="customer_city" id="customer_city_update" value="<?= $dataMaj['0']['customer_city'] ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-4">
                    <label for="customer_birthday">Date de naissance :</label>
                    <input class="form-control" type="date" name="customer_birthday" id="customer_birthday_update" value="<?= $dataMaj['0']['customer_birthday'] ?>">
                </div>
                <div class="form-group col-4">
                    <label for="customer_place_of_birth">Lieu de naissance :</label>
                    <input class="form-control" type="text" name="customer_place_of_birth" id="customer_place_of_birth_update" value="<?= strtoupper($dataMaj['0']['customer_place_of_birth']) ?>">
                </div>

                <div class="form-group col-4">
                    <label for="customer_natinality">Nationalité : </label>
                    <input class="form-control " type="text" name="customer_nationality" id="customer_nationality_update" value="<?= $dataMaj['0']['customer_nationality'] ?>">
                </div>
            </div>
            <button class="btn btn-block btn-outline-light" type="submit" name="update4">Mettre à jour</button>
        </form>
    </div>
</section>
<!-- ici identification de la société -->
<section class='mb-4'>
    <div class="container">
        <form action="controller/ctrlmajdoc.php" method="post">
            <input type="hidden" name="societe_ref_prosp" value="<?= $_GET['societe_ref_prosp'] ?>">
            <h3 class="h3 text-center">Identification de la société</h3>
            <div class='form-row d-flex'>
                <div class="form-group col-6 ">
                    <label for="commercial_name">Nom de societe</label>
                    <input class="form-control" type="text" name="commercial_name" id="commercial_name_update" value="<?= $dataMaj[0]['commercial_name'] ?>">
                </div>
                <div class="form-group col-6  ">
                    <label for="social_denomination">Dénomination commerciale</label>
                    <input class="form-control" type="text" name="social_denomination" id="social_denomination_update" value="<?= $dataMaj[0]['social_denomination'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="societe_address"> Adresse :</label>
                <input class="form-control" type="text" name="societe_address" id="societe_adress_update" value="<?= $dataMaj[0]['societe_address'] ?>">
            </div>

            <div class="form-row">
                <div class="form-group col-4">
                    <label for="societe_zip_code">Code Postal :</label>
                    <input class="form-control" type="number" name="societe_zip_code" id="societe_zip_code_update" value="<?= $dataMaj[0]['societe_zip_code'] ?>">
                </div>
                <div class="form-group col-8">
                    <label for="societe_city">Ville :</label>
                    <input class="form-control" type="text" name="societe_city" id="societe_city_update" value="<?= $dataMaj[0]['societe_city'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="societe_activity">Activité de votre société</label>
                <textarea class="form-control" name="societe_activity" id="societe_activity" rows="3"><?= $dataMaj[0]['societe_activity'] ?></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="rcs_city">Ville du RCS:</label>
                    <input class="form-control" type="text" name="rcs_city" id="rcs_ville_update" value="<?= $dataMaj[0]['rcs_city'] ?>">
                </div>
                <div class="form-group col-6">
                    <label for="societe_immat">Immatriculation de la société :</label>
                    <input class="form-control" type="text" name="societe_immat" id="societe_immat_update" value="<?= $dataMaj[0]['societe_immat'] ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="tva_number">Numéro de TVA :</label>
                    <input class="form-control" type="text" name="TVA_number" id="tva_number_update" value="<?= $dataMaj[0]['tva_number'] ?>">
                </div>
                <div class="form-group col-6">
                    <label for="code_ape">Code APE :</label>
                    <input class="form-control" type="text" name="code_ape" id="code_ape_update" value="<?= $dataMaj[0]['code_ape'] ?>">
                </div>
            </div>
            <button class="btn btn-block btn-outline-light" type="submit" name="update5">Mettre à jour</button>
        </form>
    </div>
</section>
<!-- gestion de la partie financière -->
<section class="mb-4">
    <div class="container">
        <h3 class="text-center mb-2">Partie financière de la société</h3>
        <form action="controller/ctrlmajdoc.php" method="post">
            <input type="hidden" name="societe_ref_prosp" value="<?= $_GET['societe_ref_prosp'] ?>">
            <div class="row d-flex">
                <div class="form-group">
                    <label for="capital">Montant du capital :</label>
                    <div class="input-group">
                        <input class="form-control inpNotNegative" type="text" min="0" name="capital" id="capital" value="<?= $dataMaj[0]['capital'] ?>">
                        <div class="input-group-append">
                            <span class="input-group-text" id="euro">€</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row d-flex">
                <div class="form-group ">
                    <label for="action_price">Prix de l'action :</label>
                    <div class="input-group">
                        <input class="form-control inpNotNegative" type="text" min="1" name="action_price" id="action_price" value="<?= $dataMaj[0]['action_price'] ?>">
                        <div class="input-group-append">
                            <span class="input-group-text" id="euro1">€</span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="number_action">Nombre d'action total :</label>
                        <input class="form-control inpNotNegative" type="number" min='1' name="number_action" id="number_action" value="<?= $dataMaj[0]['number_action'] ?>">
                    </div>
                </div>
            </div>

            <div class="form-group text-center">
            <?php 
                if(!empty ($dataMaj[0]['societe_form'])){
                    echo'
                    <p id="userp">Forme juridique de société : <strong>'.strtoupper($dataMaj[0]['societe_form']).'</strong></p>';  
                }else{ ?>
                <p id="userp">Forme juridique de société :</p>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="societe_form" id="inlineRadio1" value="sas" <?= $dataMaj[0]['societe_form'] == 'sas' ? 'checked' : ''  ?>>
                    <label class="form-check-label" for="inlineRadio1">SAS</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="societe_form" id="inlineRadio2" value="sarl" <?= $dataMaj[0]['societe_form'] == 'sarl' ? 'checked' : ''  ?>>
                    <label class="form-check-label" for="inlineRadio2">SARL</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="societe_form" id="inlineRadio3" value="sasu" <?= $dataMaj[0]['societe_form'] == 'sasu' ? 'checked' : ''  ?>>
                    <label class="form-check-label" for="inlineRadio3">SASU</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="societe_form" id="inlineRadio4" value="eurl" <?= $dataMaj[0]['societe_form'] == 'eurl' ? 'checked' : ''  ?>>
                    <label class="form-check-label" for="inlineRadio4">EURL</label>
                </div>
                <?php } ?>
            </div>
            <?php
            if( $dataMaj[0]['societe_form'] == 'sas' ||  $dataMaj[0]['societe_form']== 'sarl'){?>

            <div class="" id="blockassos">
                <table class="table" id="arrayAssociate">
                    <thead class="thead">
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Participation</th>
                            <th>Nombre action</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody class="tbody" id="tableAssociate">
                        <?php foreach ($dataMaj as $asso) : ?>
                            <input type="hidden" value="<?= $asso['customer_id'] ?>">
                            <tr>
                                <td name='ass_fullname'><?= $asso['customer_fullname'] ?></td>
                                <td name='ass_firstname'><?= $asso['customer_firstname'] ?></td>
                                <td id='percentAss' name='ass_participation'><?= $asso['associate_participation'] ?> %</td>
                                <td id='actionAss' name='ass_nb_action'><?= $asso['associate_nb_action'] ?></td>
                                <!-- <td><a href='controller/deleteAss.php?toto=<?= $asso['customer_id'] ?>' type='button' class='btn btn-danger deletebtn'><i class='fa fa-trash'></i></button></td> -->
                            </tr>
                    </tbody>
                <?php endforeach; ?>
                </table>
            </div>
                        <?php } ?>
            <!--  -->
        </form>
    </div>
</section>
<!-- ici on renseigne les différents éléments de gestion -->
<section class='mb-4'>
    <div class="container">
        <h3 class="h3 text-center">Information diverse</h3>
        <form action="controller/ctrlmajdoc.php" method="post">
            <input type="hidden" name="societe_ref_prosp" value="<?= $_GET['societe_ref_prosp'] ?>">
            <div class="form-group">
                <label for="bank"> Nom de la banque :</label>
                <input class="form-control" type="text" name="bank" id="bank_update" value="<?= $dataMaj['0']['bank'] ?>">
            </div>
            <div class="form-group">
                <label for="bank_address"> Adresse de la banque :</label>
                <input class="form-control" type="text" name="bank_address" id="bank_adress_update" value="<?= $dataMaj['0']['bank_address'] ?>">
            </div>
            <div class="form-group ">
                <label for="iban">IBAN :</label>
                <input class="form-control" type="text" name="iban" id="iban_update" value="<?= $dataMaj['0']['iban'] ?>">
            </div>
            <button type="submit" class="btn btn-block btn-outline-light" name="update6">Mettre à jour</button>
    </div>
    </form>
    </div>
</section>
<!-- gestion de la domiciliation -->
<section class='mb-4'>
    <div class="container">
        <h3 class="h3 text-center">Domiciliation</h3>
        <h4 class="text-danger text-center"><?= strtoupper($dataMaj[0]['domiciliation']) ?></h4>
        <form action="controller/ctrlmajdoc.php" method="post">
            <input type="hidden" name="societe_ref_prosp" value="<?= $_GET['societe_ref_prosp'] ?>">
            <div class="row d-flex">
                <div class="form-group text-center">
                    <label for="domiciliation">domiciliation: </label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="domiciliation" value="commerciale" <?= $dataMaj[0]['domiciliation'] == 'commerciale' ? 'checked' : ''  ?>>
                        <label class="form-check-label" for="domiciliation">commerciale</label>
                    </div>
                    <div class="form-check form-check-inline ">
                        <input class="form-check-input" type="radio" name="domiciliation" value="fiscale" <?= $dataMaj[0]['domiciliation'] == 'fiscale' ? 'checked' : ''  ?>>
                        <label class="form-check-label" for="domiciliation">fiscale</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-outline-light" name="update7">Mettre à jour</button>
        </form>
    </div>
</section>
<!-- gestion des locaux  -->
<section class="mb-4 d-flex justify-content-around">
    <div class="container">
        <h3 class="h3 text-center">Gestion des locaux</h3>
        <h4 class="text-danger text-center"><?= $dataMaj[0]['ref_int_local'] ?></h4>
        <form action="controller/ctrlmajdoc.php" method="post">
            <input type="hidden" name="societe_ref_prosp" value="<?= $_GET['societe_ref_prosp'] ?>">
            <!-- <div class="form-group text-center col-6">
                <div class="form-inline">
                    <label for="term">Bail:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="term" id="term1" value="oui" >
                        <label class="form-check-label" for="term">OUI</label>
                    </div>
                    <div class="form-check form-check-inline ">
                        <input class="form-check-input" type="radio" name="term" id="term2" value="non"checked>
                        <label class="form-check-label" for="">NON</label>
                    </div>
                </div>   
            </div> -->
            <div class="" id="localform">
                <div class="form-group text-center col-6">
                    <label for="lease_term">Durée du Bail:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="lease_term_id" value="1" <?= $dataMaj[0]['lease'] == '12' ? 'checked' : ''  ?>>
                        <label class="form-check-label" for="lease_term">12 mois</label>
                    </div>
                    <div class="form-check form-check-inline ">
                        <input class="form-check-input" type="radio" name="lease_term_id" value="2" <?= $dataMaj[0]['lease'] == '24' ? 'checked' : ''  ?>>
                        <label class="form-check-label" for="lease_term"> 24 mois</label>
                    </div>
                    <div class="form-check form-check-inline ">
                        <input class="form-check-input" type="radio" name="lease_term_id" value="3" <?= $dataMaj[0]['lease'] == '9' ? 'checked' : ''  ?>>
                        <label class="form-check-label" for="lease_term">3/6/9</label>
                    </div>
                </div>
                <div class="form-row d-flex justify-content-start">
                    <div class="form-group mr-2">
                        <label for="ref_local">Référence du local :</label>
                        <select class="form-control" name="ref_int_local" id="locaRef">
                            <option value="<?= $dataMaj[0]['ref_int_local'] ?>"><?= $dataMaj[0]['ref_int_local'] ?></option>
                            <?php foreach ($loc as $loc) :; ?>
                                <option class="form-control" value="<?= $loc['ref_int_local'] ?>"><?= $loc['ref_int_local'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                    <button type="submit" class='btn btn-block btn-outline-light mb-2' name="update8">Mettre à jour</button>
            </div>
        </form>
                   
        <?php
            if ($dataMaj[0]['ref_int_local'] != NULL)
            {
                echo '
                <form action="controller/ctrlmajdoc.php" method="post"> 
                <input type="hidden" name="societe_ref_prosp" value="'.$_GET['societe_ref_prosp'].'">
                <input type="hidden" name="ref_int_local" value="'.$dataMaj[0]['ref_int_local'].'">

                    <div>
                        <div>    
                            <div class="form-row">
                                <div class="form-group mr-2">
                                    <label for="">Dépot de garantie :</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="security_deposit" id="security_deposit" value="' . $dataMaj[0]['security_deposit'] . ' ">
                                        <div class="input-group-append">
                                            <span class="input-group-text">€</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mr-2">
                                    <label for="">Date d\'entrée:</label>
                                    <input class="form-control" type="date" name="date_entrance" id="date_entrance" value="' . $dataMaj[0]['date_entrance'] . '">
                                </div>
                                <div class="form-group mr-2">
                                    <label for="">Date de fin de bail :</label>
                                    <input class="form-control" type="date" name="date_end" id="date_end" value="' . $dataMaj[0]['date_end'] . '">
                                </div>
                            </div>
                            <div class="form-group mr-2 ">
                                <label for="superficie">Superficie du local :</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="superficie" id="superficie" value="' . $dataMaj[0]['supercifie'] . '">
                                    <div class="input-group-append">
                                        <span class="input-group-text">m²</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mr-2 ">
                                <label for="surface_weighted">Surface pondérée :</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="surface_weighted" id="surface_weighted" value="' . $dataMaj[0]['surface_weighted'] . '">
                                    <div class="input-group-append">
                                        <span class="input-group-text">m²</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mr-2 ">
                                <label for="position_id">Situation (étage) :</label>
                                <input class="form-control" type="text" name="position_id" id="position_id" value="' . $dataMaj[0]['position_id'] . '">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group mr-2">
                                <label for="number_park_place">Nombre de place de parking :</label>
                                <input class="form-control" type="text" name="number_park_place" id="number_park_place" value="' . $dataMaj[0]['number_park_place'] . '">
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="form-group mr-2 ">
                                <label for="rent_surface_price">Loyer/m² :</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="rent_surface_price" id="rent_surface_price" value="' . $dataMaj[0]['rent_surface_price_m'] . '">
                                    <div class="input-group-append">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mr-2">
                                <label for="mensual_rent_ht">Loyer mensuel HT:</label>
                                <div class="input-group">
                                    <input class="form-control" type="textr" name="mensual_rent_ht" id="mensual_rent_ht" value="' . $dataMaj[0]['mensual_rent_ht'] . '">
                                    <div class="input-group-append">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mr-2 ">
                            <label for="rent_letter">Loyer mensuel en lettre:</label>
                            <input class="form-control" type="text" name="rent_letter" id="rent_letter" value="' . $dataMaj[0]['rent_letter'] . '">
                        </div>
                        <div class="form-row d-flex">
                            <div class="form-group mr-2">
                                <label for="prorated_rent">Prorata de loyer :</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="prorated_rent" id="prorated_rent" value="' . $dataMaj[0]['prorated_rent'] . '">
                                    <div class="input-group-append">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mr-2 ">
                                <label for="charge">Charge :</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="charge" id="charge" value="' . $dataMaj[0]['charge'] . '">
                                    <div class="input-group-append">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mr-2 ">
                                <label for="property_tax">Taxe foncière :</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="property_tax" id="property_tax" value="' . $dataMaj[0]['property_tax'] . '">
                                    <div class="input-group-append">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mr-2">
                                <label for="cumulative_rent">cumul de loyer :</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="cumulative_rent" id="cumulative_rent" value="' . $dataMaj[0]['cumulative_rent'] . '">
                                    <div class="input-group-append">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <button class="btn btn-block btn-outline-light " type="submit" name="update9">Mettre à jour</button>
                </form>';
            } 
        ?>
    </div>
</section>

<!-- gestion des prestation vendues -->


<script>
    $(document).ready(function() {
        $('#doctable').DataTable({
            language: {
                processing: "Traitement en cours...",
                search: "Rechercher&nbsp;:",
                lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
                info: "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                infoPostFix: "",
                loadingRecords: "Chargement en cours...",
                zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
                emptyTable: "Aucune donnée disponible dans le tableau",
                paginate: {
                    first: "Premier",
                    previous: "Pr&eacute;c&eacute;dent",
                    next: "Suivant",
                    last: "Dernier"
                },
                aria: {
                    sortAscending: ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        });
        $(input[type = search]).css("background", "#ececec");



    });

    $(document).ready(function() {
        $('#btnedit').click(function() {
            window.location.href;
});
    $(document).ready(function () {
        if($("#inlineRadio1").prop('checked')== true) {
            $("#blockassos").removeClass("d-none");  
        };
        if($("#inlineRadio2").prop('checked')==true) {
            $("#blockassos").removeClass("d-none");  
        };
        if($("#inlineRadio3").prop('checked')== true) {
            $("#blockassos").addClass("d-none");  
        };
        if($("#inlineRadio4").prop('checked')== true) {
            $("#blockassos").addClass("d-none");  
        };
    });


    });
</script>

<?php
require_once 'template/footer.php';
?>