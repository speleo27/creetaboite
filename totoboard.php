<?php
session_start();
if (empty($_SESSION['auth']) || $_SESSION['auth']['admin'] == 0) {
    session_destroy();
    header("Location:accueil");
}
require_once 'template/header.php';

//var_dump($globalArray);
?>
<!-- ici on affiche les graphiques -->


<section class="mb-4">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-center mb-2">Tableau de bord</h2>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col d-flex">
                <form action="controller/vargraph.php" method="post">
                    <div class="form-inline justify-content-center ">
                       
                            <label for="">date de début</label>
                            <input type="date" class="form-control" name="startDate">
                        
                            <label for="">date de fin</label>
                            <input type="date" class="form-control" name="endDate">
                        
                        <button type="submit" class="btn btn-success  ml-2">Rechercher</button>
                    </div>
                </form>
            </div>
        </div>  -->
        <h3 class="text-center">Suivi du type de clients</h3>
        <div class="row d-flex mb-2">
            <div class="col">
                <canvas id="graphglobal" max-widht='200' max-height="300"></canvas>
            </div>
        </div>
        <h3 class="text-center">Suivi formes juridiques crée</h3>
        <div class="row mb-2 ">
            <div class="col">
                <canvas id="graphtypeSoc" max-widht='200' max-height="200"></canvas>
            </div>
        </div>
        <h3 class="text-center">Suivi des prestations vendus</h3>
        <div class="row mb-2">
            <div class="col">
                <canvas id="graphpresta" max-widht='200' max-height="200"></canvas>
            </div>
        </div>
    </div>
</section>
<!-- ici on affiche les domiciliations fiscale -->
<section class="mb-4">
    <div class="container">
        <h3 class="h3 text-center">Tableau récapitulatif des domiciliations fiscales </h3>
        <table class="table table-bordered" id="domfisc">
            <thead>
                <tr>
                    <th>Nom de la société</th>
                    <th>Nom du dirigeant</th>
                    <th>Numéro de téléphone</th>
                    <th>Adresse mail</th>
                    <th>SIRET</th>
                    <th>Code APE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $reqDomFisc = $bdd->prepare("SELECT * FROM societe INNER JOIN customer ON (societe.societe_ref_prosp = customer.societe_ref_prosp) WHERE societe.domiciliation ='fiscale' AND  (customer.cust_status =1 or  customer.cust_status =2)");
                $reqDomFisc->execute(array());
                $data = $reqDomFisc->fetchAll();
                //var_dump($data);
                foreach ($data as $dataDomFisc) :

                ?>
                    <tr>
                        <td><?= $dataDomFisc['societe_name'] ?></td>
                        <td><?= $dataDomFisc['customer_fullname'] ?></td>
                        <td><?= $dataDomFisc['customer_phone'] ?></td>
                        <td><?= $dataDomFisc['customer_email'] ?></td>
                        <td><?= $dataDomFisc['societe_immat'] ?></td>
                        <td><?= $dataDomFisc['code_ape'] ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        <a href="controller/downdomfis.php" class="btn btn-block btn-outline-light">Télécharger le document</a>
    </div>
</section>

<script>
    $(document).ready(function() {

        $.ajax({
            type: "GET",
            url: "controller/vargraph.php",

            success: function(response) {
                var result = JSON.parse(response);

                //console.table(result[1]);
                //déclaration des constantes par graph
                //graph1
                const stat = result[0];
                console.table(stat);
                var glob = document.getElementById('graphglobal').getContext('2d');
                var typecusto = new Chart(glob, {
                    type: 'line',
                    data: {
                        labels: Object.keys(stat['Actif']),
                        datasets: [{
                                label: "Prospect",
                                fill: false,
                                borderColor: '#FF0000',
                                data: Object.values(stat['Prospect']),
                            },
                            {
                                label: " Actif",
                                fill: false,
                                borderColor: '#CC00FF',
                                data: Object.values(stat['Actif']),
                            },
                            {
                                label: " Archivé",
                                fill: false,
                                borderColor: '#202432',
                                data: Object.values(stat['Archivé']),
                            },
                            {
                                label: " Contentieux",
                                fill: false,
                                borderColor: '#F9B643',
                                data: Object.values(stat['Contentieux']),
                            }
                        ],
                    }, options:{}
                });


                //graph2
                const form = result[2];
                var graphform = document.getElementById('graphtypeSoc').getContext('2d');
                var formSoc = new Chart(graphform, {
                    type: 'radar',
                    data: {
                        labels: Object.keys(form['sas']),
                        datasets: [{
                                label: "SAS",
                                fill: false,
                                borderColor: '#FF0000',
                                data: Object.values(form['sas']),
                            },
                            {
                                label: "SASU",
                                fill: false,
                                borderColor: '#CC00FF',
                                data: Object.values(form['sasu']),
                            },
                            {
                                label: "SARL",
                                fill: false,
                                borderColor: '#202432',
                                data: Object.values(form['sarl']),
                            },
                            {
                                label: "EURL",
                                fill: false,
                                borderColor: '#F9B643',
                                data: Object.values(form['eurl']),
                            }
                        ],
                    }, options:{}
                });
                //graph3
                const prest = result[1];
                var graphprest = document.getElementById('graphpresta').getContext('2d');
                var presta = new Chart(graphprest, {
                    type: 'line',
                    data:
                    {
                        labels: Object.keys(prest['Etude de marché']),
                        datasets: [{
                                label: "Etude de marché",
                                fill: false,
                                borderColor: '#FF0000',
                                data: Object.values(prest['Etude de marché']),
                            },
                            {
                                label: "Buisness plan",
                                fill: false,
                                borderColor: '#3333FF',
                                data: Object.values(prest['Buisness plan']),
                            },
                            {
                                label: "Création d\'entreprise",
                                fill: false,
                                borderColor: '#99FF33',
                                data: Object.values(prest['Création d\'entreprise']),
                            },
                            {
                                label: "Comptabilité",
                                fill: false,
                                borderColor: '#202432',
                                data: Object.values(prest['Comptabilité']),
                            },
                            {
                                label: "Branding",
                                fill: false,
                                borderColor: '#F9B643',
                                data: Object.values(prest['Branding']),
                            },
                            {
                                label: "Site Internet",
                                fill: false,
                                borderColor: '#663300',
                                data: Object.values(prest['Site Internet']),
                            },
                            {
                                label: "Marketing",
                                fill: false,
                                borderColor: '#990000',
                                data: Object.values(prest['Marketing']),
                            },
                            {
                                label: "Relation publique",
                                fill: false,
                                borderColor: '#660066',
                                data: Object.values(prest['Relation publique']),
                            },
                            {
                                label: "Vidéo",
                                fill: false,
                                borderColor: '#660000',
                                data: Object.values(prest['Vidéo']),
                            },
                            {
                                label: "Réseaux",
                                fill: false,
                                borderColor: '#CC00FF',
                                data: Object.values(prest['Réseaux']),
                            },
                            {
                                label: "Fabrication",
                                fill: false,
                                borderColor: '#CC33FF',
                                data: Object.values(prest['Fabrication']),
                            },
                            {
                                label: "Dépot de marque",
                                fill: false,
                                borderColor: '#FF66FF',
                                data: Object.values(prest['Dépot de marque']),
                            },
                            {
                                label: "Bureaux",
                                fill: false,
                                borderColor: '#CC9933',
                                data: Object.values(prest['Bureaux']),
                            }
                        ],
                    },options:{}
                });
            }
        });


        $('#domfisc').DataTable({
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
        $('input[type = search]').css("background", "#ececec");

    });
</script>


<?php
require_once 'template/footer.php';
