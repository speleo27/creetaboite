<?php
session_start();
if (empty($_SESSION['auth']) || $_SESSION['auth']['admin'] == 0) {
    session_destroy();
    header("Location:accueil");
}
require_once 'template/header.php';

//var_dump($globalArray);
?>




<div id="wrapper">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="color:#13A8D9">Tableau de bord</h1>
        </div>

        <!-- Content Row -->
        <div class="row col-12">

            <!-- Earnings (Monthly) Card Example -->
            <div class=" col-4 col-sm-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class='card-header'>
                        <canvas id="graphglobal" max-widht='50' max-height="50"></canvas>
                    </div>
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Suivi client</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class=" col-4 col-sm-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-header">
                        <canvas id="graphtypeSoc" max-widht='50' max-height="50"></canvas>
                    </div>
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    suivi type de création</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-12 align-items-center">
            <div class="col-3"></div>
            <!-- Earnings (Monthly) Card Example -->
            <div class=" col-4 col-sm-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-header">
                        <canvas id="graphpresta" max-widht='50' max-height="50"></canvas>
                    </div>
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Prestations
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12 col-sm-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Suivi des domiciliations</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="gestion-des-dossiers" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated-fade-in" aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="creation-de-prospect">création de nouveau client</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
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
                        <a href="controller/downdomfis.php" class="btn btn-block" style="background-color:#0C8384">Télécharger le document</a>
                    </div>
                </div>
            </div>
        </div>




    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
<?php
require_once 'template/footer.php';
?>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
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
                    },
                    options: {}
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
                    },
                    options: {}
                });

                //graph3
                const prest = result[1];
                var graphprest = document.getElementById('graphpresta').getContext('2d');
                var presta = new Chart(graphprest, {
                    type: 'line',
                    data: {
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
                    },
                    options: {}
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