<?php
session_start();
if (empty($_SESSION['auth']) || $_SESSION['auth']['admin'] == 0) {
    session_destroy();
    header("Location:accueil");
}
require_once 'template/header.php';

?>
<section class="mb-4">
    <div class="container">
        <h2 class="h2 text-center">Gestion des dossiers</h2>
    </div>
</section>


<section class="mb-4">
    <div class="container-fluid">
        <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12"> 
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Suivi des créateurs</h6>
                </div>
                <div class="card-body col-12">
                    
                        <table class="table table-bordered table-responsive-lg" id="listCust">
                            <thead>
                                <th scope="col" class="text-center">REF Prospect</th>
                                <th scope="col" class="text-center">REF Client</th>
                                <th scope="col" class="text-center">Nom de la société</th>
                                <th scope="col" class="text-center ">Nom du dirigeant</th>
                                <th scope="col" class="text-center ">Email</th>
                                <th scope="col" class="text-center ">Telephone</th>
                                <th class="text-center">Envoyer l'email d'accès</th>

                                <th class="text-center">Action</th>

                            </thead>
                            <tbody class='tbody' id='listCusto'>
                                <?php $req = $bdd->prepare('SELECT * FROM customer INNER JOIN societe ON (customer.societe_ref_prosp = societe.societe_ref_prosp) LEFT JOIN list_url on (customer.societe_ref_prosp = list_url.societe_ref_prosp) WHERE (`cust_status`=1 OR `cust_status`=2)');
                                $req->execute(array());
                                $data = $req->fetchAll(PDO::FETCH_ASSOC);

                                // var_dump($data);
                                // die();
                                $array = array();
                                foreach ($data as $prospect) {
                                    array_push($array, $prospect['link']);

                                    echo '   
                            <tr >
                                <td align="center">' . $prospect["societe_ref_prosp"] . '</td>
                                <td align="center">' . $prospect["societe_ref_customer"] . '</td>
                                <td align="center">' . $prospect["societe_name"] . '</td>
                                <td align="center">' . ucfirst($prospect["customer_fullname"]) . ' ' . ucfirst($prospect["customer_firstname"]) . '</td>
                                <td align="center" >' . $prospect["customer_email"] . '</td>
                                <td align="center" >' . $prospect["customer_phone"] . '</td>
                                <td align="center"><a href="controller/sendmail.php?societe_ref_prosp=' . $prospect["societe_ref_prosp"] . '" class="btn" style="background-color:#0C8384">Envoyer Email</a></td>
                                <td align="center"><a href="mise-a-jour-du-dossier-' . $prospect["societe_ref_prosp"] . '" class="btn btn-primary my-1" >afficher</a><a data-toggle="modal" data-target="#deleteModal" onclick="recupIdProsp(\'' . $prospect['societe_ref_prosp'] . '\')" class="btn btn-danger mx-1" >Supprimer</a></td>
                            </tr>
                        ';
                                } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModal">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="controller/deleteprosp.php" method="post">
                    <p id="decoModal">Vous etes sur le point de supprimer le Prospect </p>
                    <div class="modal-footer">
                        <input type="hidden" name="societe_ref_prosp" value="" id="delsoc">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        <input type="submit" value="confirmer" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal ajout de fichiers -->
<div class="modal fade" id="UploadFiles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UploadFiles">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="controller/addfiles.php" method="post">
                    <input type="file" multiple accept=".jpg,.jpeg,.JPEG,.JPG,.PDF,.pdf,.tiff,.TIFF">
                    <input type="hidden" name="societe_ref_prosp" value="" id="delsoc">
            </div>
            <div class='modal-footer'>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                <input type="submit" value="confirmer" class="btn btn-primary">
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('#listCust').DataTable({
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





    });
</script>
<?php
require_once 'template/footer.php';
