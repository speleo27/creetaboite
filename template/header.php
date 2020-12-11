<?php
setlocale(LC_ALL,"fr_FR");
require_once 'controller/connectbdd.php';
// include 'controller/function.php';


?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script type="text/javascript" defer src="js/function.js"></script>
    <script text="text/javascript" src="js/jquery.form.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type ='text/javascript' src="node_modules/chart.js/dist/Chart.bundle.js"></script>
    <script type ='text/javascript' src="node_modules/chart.js/dist/Chart.bundle.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- <link rel="stylesheet" href="src/css/print.css" media="print"> -->
    <link rel="stylesheet" href="src/css/main.css" >
    <link rel="stylesheet" href="src/css/app.css" >
    <link rel="stylesheet" href="src/css/jquery.dataTables.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
  

    <title>Cree ta boite</title>
</head>

<body>
<nav class="navbar " id="usernavbar">
    <a class="navbar-brand" href="accueil" id="brand">Crée ta boite</a>
    <?php
    if(isset($_SESSION['auth'])) {
     
        ?> <?php
        if($_SESSION['auth']["admin"] != 1){
        ?> 
           
            <button class='btn btn-outline-light my-2 my-sm-0' type='button' data-toggle='modal' data-target='#disconnectModal'>Déconnexion</button>
            <?php } 
          else { ?>  
               <a href='tableau-de-bord' class='btn btn-outline-light mr-2'>Tableau de bord</a>
                        <a href='creation-de-prospect' class='btn btn-outline-light mr-2'id='createNewCust'> Création nouveaux client</a>
                        <a href='gestion-des-dossiers' class='btn btn-outline-light mr-2'>Gestion de dossier</a>
                        <button class='btn btn-outline-light my-2 my-sm-0' type='button' data-toggle='modal' data-target='#disconnectModal'>Déconnexion</button>  
             <?php
            }
           } else { ?>  
                   <a class="btn btn-outline-light my-2 my-sm-0"  data-toggle='modal' data-target='#connectModal' >Connexion</a>
                   <?php } ?>          
</nav>


<p><img src="./img/logo_creer_ta_boite2.svg" alt="" srcset="" id="logo"></p>


<!---- Modal ---->
<!-- Modal connexion-->
<div class="modal fade" id="connectModal" tabindex="-1" role="dialog" aria-labelledby="connectModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="connectModal">Connexion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="controller\controllerLogin.php" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="username">Votre email</label>
                        <input type="email" name="connect_email" class="form-control" id="connect_email">

                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="guizmo" class="form-control" id="guizmo">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Connexion" name='connectbtn'>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Déconnexion-->
<div class="modal fade" id="disconnectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="disconnectModal">Déconnexion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>  
            <div class="modal-body">
                <p id="decoModal">Vous etes sur le point de vous déconnecter </p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <a href="controller/ctrLogout.php"  class="btn btn-primary">Confirmer</a>
                </div>
            </div>
        </div>
    </div>
</div>

