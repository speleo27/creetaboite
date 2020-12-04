<?php

session_start();

require  "template/header.php";

?>


<!-- ici on retrouve les infos concernant les documents qui seront demander dans les pages suivantes -->
<section id="sectiontoto">
    <div class="container ">
        <?php

        if (!isset($_SESSION['auth']['connect_email'])) { ?>
            <div class="row mb-1 " id="userblock">
                <h2 class="h2">Bienvenue dans la création d'entreprise</h2>

            </div>

            <!-- si non connecter -->
            <button class="btn btn-block btn-outline-light my-2 my-sm-0" type="button" data-toggle="modal" data-target="#connectModal">Connexion</button>
        <?php } else { ?>
            <!-- sinon  -->
            <div id="attestnocond">
                <h3 class="text-center mb-2">Télécharger le nombre d'attestation de Non Condamnation necessaire</h3>
                <h3 class="text-center mb-2">(1 par personne physique)</h3>
                <form action="controller/editattestnocond.php" method="post" id="formattest">
                    <button type="submit" class="btn btn-block btn-outline-light mb-2" id="telAttest">Télécharger</button>
                </form>
            </div>

            <div>
                <h3 class="h3 text-center">Veuillez cocher les cases pour continuer</h3>
            </div>
            <div class="row">
                <h4 class="h4 text-center">Merci de bien vouloir préparer les documents suivants numérisés au format PDF,JPG,JPEG,TIFF :</h4>

            </div>
            <form id="formcheck" action="conditions-generales-utilisation" method="POST">
                <div>
                    <input type="checkbox" aria-label="Checkbox for control docs" id="ci" name="ci" value="ci" required>
                    <label for="ci"> Pièce d'identité ou Carte de séjour du dirigeant (recto/verso)</label>
                </div>
                <div>
                    <input type="checkbox" aria-label="Checkbox for control docs" id="justDom" name="justDom" value="justDom" required>
                    <label for="justDom"> Justificatif de domicile de moins de 3 mois</label>
                </div>
                <div>
                    <input type="checkbox" aria-label="Checkbox for control docs" id="rb" name="rb" value="rb" required>
                    <label for="rb"> Un Relevé d'Identité Bancaire</label>
                </div>
                <div>
                    <input type="checkbox" aria-label="Checkbox for control docs" id="attest" name="attest" value="attest" required>
                    <label for="attest">Une Attestation de non condamnation (manuscrite ou téléchargeable au dessus)</label>
                </div>
                <div>
                    <input type="checkbox" aria-label="Checkbox for control docs" id="attestfund" name="attestfund" value="attestfund" required>
                    <label for="attestfund">Une Attestation de dépot de fond</label>
                </div>
                <!-- si non connecter -->
                <!-- visible si connecter -->
                <button type="submit" class="btn btn-block btn-outline my-2 my-sm-0  " id="btnvalid">Suivant</button>
            </form>
        <?php } ?>

    </div>
</section>
<script>
    // $(document).ready(function () {
    //     $("#telAttest").click(function () { 
    //         downloadAttest("post","controller/editattestnocond.php")

    //     });

    // });
</script>

<?php
include 'template/footer.php';
?>