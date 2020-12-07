<?php
session_start();
if(empty($_SESSION['auth']) || $_SESSION['auth']['admin']== 0){
session_destroy();
    header("Location:accueil");

}
require_once 'template/header.php';
$array = array(); 
$array['link'] = "MTAwLS0kMnkkMTAkUHY3V0FKUy9CNUphNnlPMGZMQ2dHdS5LN00zeU1NemM0S29jektCa3oyN3ZwVUs0TkVLNDItLXNlYjEwNDAwQG9yYW5nZS5mci0tUDAwNg==";
?>
<section class="mb-4">
    <div class="container" >
        <h2 class="h2 text-center">Gestion des dossiers</h2>
    </div>
</section>

<!-- ici une recherche a l'aide d'une modal qui remonte un tableau avec les infos -->
<section class="mb-4">
    <div class="container" >
    <h3 class="h3 text-center">Liste des clients</h3>
        <div class="row table-responsive">
            <table class="table table-bordered" id="listCust">
                <thead >
                    <th scope="col" class="text-center">REF Prospect</th>
                    <th scope="col" class="text-center">REF Client</th>
                    <th scope="col" class="text-center">Nom de la société</th>
                    <th scope="col" class="text-center ">Nom du dirigeant</th>
                    <th scope="col" class="text-center ">Email</th>
                    <th scope="col" class="text-center ">Telephone</th>
                    <th class="text-center">Envoyer l'email d'accès</th>

                    <th class="text-center">Action</th>
                   
                </thead>
                <tbody class='tbody' id='listCusto' >
               <?php $req=$bdd->prepare('SELECT * FROM customer INNER JOIN societe ON (customer.societe_ref_prosp = societe.societe_ref_prosp) LEFT JOIN list_url on (customer.societe_ref_prosp = list_url.societe_ref_prosp) WHERE (`cust_status`=1 OR `cust_status`=2)');
                     $req->execute(array());
                     $data = $req->fetchAll(PDO::FETCH_ASSOC);
                     
                        // var_dump($data);
                        // die();
                        $array=array();
                     foreach($data as $prospect)
                    {
                        array_push($array,$prospect['link']);
                        
                        echo'   
                            <tr >
                                <td align="center">'.$prospect["societe_ref_prosp"].'</td>
                                <td align="center">'.$prospect["societe_ref_customer"].'</td>
                                <td align="center">'.$prospect["societe_name"].'</td>
                                <td align="center">'.ucfirst($prospect["customer_fullname"]).' '.ucfirst($prospect["customer_firstname"]).'</td>
                                <td align="center" >'.$prospect["customer_email"].'</td>
                                <td align="center" >'.$prospect["customer_phone"].'</td>
                                <td align="center"><a href="controller/vartest.php?societe_ref_prosp='.$prospect["societe_ref_prosp"].'" class="btn btn-outline-light">Envoyer Email</a></td>
                                <td align="center"><a href="mise-a-jour-du-dossier-'.$prospect["societe_ref_prosp"].'" class="btn btn-primary mx-1" >afficher</a><a data-toggle="modal" data-target="#deleteModal" onclick="recupIdProsp(\''.$prospect['societe_ref_prosp'].'\')" class="btn btn-danger mx-1" >Supprimer</a></td>
                            </tr>
                        ';
                    } ?>
                    
                </tbody>
            </table>
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
                        <input type="submit" value="confirmer"  class="btn btn-primary">
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
                <input type="submit" value="confirmer"  class="btn btn-primary">
            </div>        
                </form>
            </div>
        </div>
    </div>
</div>
<script>
 $(document).ready(function () {
    $('#listCust').DataTable( {
    language: {
        processing:     "Traitement en cours...",
        search:         "Rechercher&nbsp;:",
        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
            first:      "Premier",
            previous:   "Pr&eacute;c&eacute;dent",
            next:       "Suivant",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    }
} );
    $(input[type=search]).css("background","#ececec");
     
   
     
   
});

</script>
<?php
require_once 'template/footer.php';
