<?php
session_start();
require_once 'connectbdd.php';
//ici prevoir les requete en update car déja creer par admin
//var_dump($_POST);
try{
$requpdatecust = $bdd->prepare('UPDATE customer SET  customer_fullname=?, customer_firstname=?, customer_email=?, customer_phone=?, customer_address=?, customer_zip_code=?, customer_city=?, customer_birthday=?, customer_place_of_birth=?, customer_nationality=? WHERE societe_ref_prosp=?');
$requpdatecust->execute(array(
    htmlspecialchars($_POST['customer_fullname']),
    htmlspecialchars($_POST['customer_firstname']),
    htmlspecialchars( $_POST['customer_email']),
    htmlspecialchars($_POST['customer_phone']),
    htmlspecialchars($_POST['customer_address']),
    intval($_POST['customer_zip']) ,
    htmlspecialchars($_POST['customer_city']),
    htmlspecialchars($_POST['customer_birthday']) ,
    htmlspecialchars($_POST['customer_place_of_birth']),
    htmlspecialchars($_POST['customer_nationality']),
    htmlspecialchars($_SESSION['auth']['societe_ref_prosp'])
));
} catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}



//header('LOCATION:../formulaire');
//exit;
?>