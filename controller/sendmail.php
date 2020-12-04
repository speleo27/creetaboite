<?php

require_once 'connectbdd.php';

//var_dump($_GET);
// creation de la requete pour aller chercher les info sur le dirigeant et ses codes de connection
$reqsendmail = $bdd->prepare('SELECT * FROM customer INNER JOIN connect ON customer.societe_ref_prosp = connect.societe_ref_prosp WHERE customer.societe_ref_prosp=?');
$reqsendmail->execute(array(
$_GET['societe_ref_prosp']

));
while($data = $reqsendmail->fetch()){
//var_dump($data);
$guizmo= $data['guizmo'];
$societe= $data['societe_ref_prosp'];
$email= $data['connect_email'];
$id= $data['customer_id'];
$linkEmailClair=$id."--".$guizmo."--".$email."--".$societe;
$linkHash= base64_encode($linkEmailClair);
//var_dump($guizmo);
if(isset($_POST)){
    $req1=$bdd->prepare("UPDATE list_url set  link=? WHERE societe_ref_prosp=?");
    $req1-> execute(array($linkHash,$_GET['societe_ref_prosp'] ));
    
    $reqUpPass= $bdd->prepare('UPDATE connect SET guizmo= :guizmo WHERE societe_ref_prosp= :societe_ref_prosp');
    $reqUpPass->execute(array(
        "guizmo"=>password_hash($guizmo, PASSWORD_BCRYPT),
        
        'societe_ref_prosp'=>$_GET['societe_ref_prosp']
    ));

       $headers[]='MIME-Version:1.0';
       $headers[]='Content-type: text/html; charset=utf-8';
       $headers[]='From: contact@euripole.fr';
       $headers[]='Bcc:thierry.hoffmann@euripole.fr';
         //$to = 'seb10400@orange.fr';
        $to = $email;
     
     $subject = 'Lien de connexion a votre espace création Euricréa';
     $message = '
     <html>
        <head>
            <meta charset="utf-8">
            <title>Lien de connexion a votre espace création Euricréa</title>
        </head>
        <body>
        
               <p><image src="../img/Logo-Euripolemail.png"></p>
            
            <div>

                <h2>Bonjour '.ucfirst($data['customer_civility']).' '.ucfirst($data['customer_fullname']).'</h2>
                <p>Vous recevez ce message car vous souhaitez créer votre entreprise et avez choisi de travailler avec EURIPOLE.</p>
                <p>Pour commencer l\'aventure vous devez vous assurez d\'avoir en votre possession les documents suivant numérisés (au format PDF,JPG,TIFF):
                                <ul>
                                    <li>Carte d\'identité, carte de séjour ou passport (recto-verso)</li>
                                    <li>Attestatiuon de non condamnation</li>
                                    <li>Attestation de dépot de fond</li>
                                    <li>Justificatif de domicile de moins de 3 mois</li>
                                    <li>Relevé d\'identité bancaire</li>
                                </ul>
                </p>
                <p>Afin de pouvoir poursuivre vos nous vous invitons a vous connecter a l\'adresse suivante:<a href="http://euricrea.sebastien-rossi-speleo27.fr/begin.php?key='.$linkHash.'"> euripole</a> en vous munissant des informations suivante</p>
                  
            </div>
        </body>
        <footer>
                    <p>EURIPOLE Business Center
                    17 Rue de Sancey - ZA des Vauguillettes III - 89100 SENS
                    Tél. +33.(0)3.86.88.30.61
                    SIRET 844 641 449 00013     Code NAF/APE 6820B
                    Courriel : euripole@orange.fr – Site internet : www.euripole.fr
                    </p>
        </footer>
     </html>';


    mail($to,$subject,$message,implode("\r\n",$headers));


}

header('Location:../gestion-des-dossiers');
} 
