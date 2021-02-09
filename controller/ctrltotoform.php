<?php

require '../setting.php';
require_once 'connectbdd.php';
//var_dump($_POST);

// création du n° de prospect
$reqsociete=$bdd->prepare('INSERT INTO societe(societe_ref_prosp) VALUES(?)');
$reqsociete->execute(array(
htmlspecialchars(ucfirst($_POST['societe_ref_prosp'])),

));


// // creation du dirigeant
$reqcustomer = $bdd->prepare('INSERT INTO customer(societe_ref_prosp,cust_status,customer_civility, customer_fullname , customer_firstname, customer_email, customer_phone) 
VALUES(:societe_ref_prosp,:cust_status,:customer_civility,:customer_fullname,:customer_firstname,:customer_email,:customer_phone)');
$reqcustomer->execute(array(
    'societe_ref_prosp'=>htmlspecialchars(ucfirst($_POST['societe_ref_prosp'])),
    'cust_status'=>$_POST['cust_status'],
    'customer_civility'=> htmlspecialchars($_POST['civility']),
    'customer_fullname'=>  htmlspecialchars($_POST['customer_fullname']),
    'customer_firstname' => htmlspecialchars($_POST['customer_firstname']),
    'customer_email'=> htmlspecialchars($_POST['customer_email']),
    'customer_phone'=>  htmlspecialchars($_POST['customer_phone']),
));
$custId= $bdd->lastInsertId();

$reqUpsociete=$bdd->prepare("UPDATE societe SET societe_name=?, customer_id=?, status_id = 1 WHERE societe_ref_prosp=?");
$reqUpsociete->execute(array(
   ucfirst( $_POST['societe_name']),
    $custId,
    $_POST['societe_ref_prosp']
));

// // creation des données de co
$reqconnect=$bdd->prepare('INSERT INTO connect(customer_id,societe_ref_prosp,connect_email,guizmo) VALUES(:customer_id,:societe_ref_prosp,:connect_email,:guizmo)');
$reqconnect->execute(array(
    'customer_id'=>$custId,
   'societe_ref_prosp' => htmlspecialchars(ucfirst($_POST['societe_ref_prosp'])),
   'connect_email'=>htmlspecialchars($_POST['customer_email']),
  'guizmo'=> bin2hex(random_bytes(6))
));

// creation de la societe dans la liste de secours des url
$reqlink=$bdd->prepare('INSERT into list_url(societe_ref_prosp) Values(?)');
$reqlink->execute(array(ucfirst($_POST['societe_ref_prosp'])));

// creation de la liaison pour le stockage de doc
$reqUpload=$bdd->prepare('INSERT INTO Upload(societe_ref_prosp) VALUES(?)');
$reqUpload->execute(array(
htmlspecialchars(ucfirst($_POST['societe_ref_prosp']))
));


// création de l'historique des entretiens
$reqhistory=$bdd->prepare('INSERT INTO history(societe_ref_prosp,comments,time_work) VALUES(?,?,?)');
$reqhistory->execute(array(
   htmlspecialchars(ucfirst($_POST['societe_ref_prosp'])),
   htmlspecialchars($_POST['comments']), 
   htmlspecialchars($_POST['time_work']) 
));

// ici création du dirigeant associé
if($_POST['cust_status']==2){
    $reqass=$bdd->prepare("INSERT INTO associates(societe_ref_prosp, customer_id) VALUES(:societe_ref_prosp, :customer_id)");
    $reqass->execute(array(
    'societe_ref_prosp'=> ucfirst($_POST['societe_ref_prosp']),
    'customer_id'=>  $custId,
    ));
}


// création du dossier de stockage liée au prospect
$path='../upload/'.ucfirst($_POST['societe_ref_prosp']).'/';
if(isset($_POST)){
    mkdir($path);
}


header("Location:../gestion-des-dossiers");
