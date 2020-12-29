<?php
require '../setting.php';
require 'connectbdd.php';
require 'function.php';
// creation de la requete pour aller chercher les info sur le dirigeant et ses codes de connection
$reqsendmail = $bdd->prepare('SELECT * FROM customer INNER JOIN connect ON customer.societe_ref_prosp = connect.societe_ref_prosp WHERE customer.societe_ref_prosp=?');
$reqsendmail->execute(array(
  $_GET['societe_ref_prosp']

));
while ($data = $reqsendmail->fetch()) {
  //var_dump($data);
  $guizmo = $data['guizmo'];
  $societe = $data['societe_ref_prosp'];
  $email = $data['connect_email'];
  $emailjson = json_encode($email);
  $id = $data['customer_id'];
  $linkEmailClair = $id . "--" . $guizmo . "--" . $email . "--" . $societe;
  $linkHash = base64_encode($linkEmailClair);
  //var_dump($guizmo);
  if (isset($_GET)) {
    $req1 = $bdd->prepare("UPDATE list_url set  link=? WHERE societe_ref_prosp=?");
    $req1->execute(array($linkHash, $_GET['societe_ref_prosp']));

    $reqUpPass = $bdd->prepare('UPDATE connect SET guizmo= :guizmo WHERE societe_ref_prosp= :societe_ref_prosp');
    $reqUpPass->execute(array(
      "guizmo" => password_hash($guizmo, PASSWORD_BCRYPT),

      'societe_ref_prosp' => $_GET['societe_ref_prosp']
    ));
    $emetteur="sebastien.rossi@gretasudchampagne.fr";
    $destinataire = $email;
    $variable1 = ucfirst($data['customer_fullname'])." ".ucfirst($data['customer_firstname']);
    $variable2= $linkHash;
    $subject="Lien de connection ".$title;
    sendContact($emetteur, $destinataire, $variable1, $variable2, $subject , $template = "templateMail.html");

  }
}
