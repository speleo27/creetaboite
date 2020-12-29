<?php
require '../setting.php';
require 'connectbdd.php';
require 'function.php';

if(empty($_FILES['ci-0'])) {
    die();
} else {
    session_start();
    //var_dump($_FILES);
    $extAuthorized = array("pdf", "jpg", "png", "tiff");
    $path = trim('../upload/'.$_SESSION['auth']['societe_ref_prosp'].'/');
    // var_dump($_SESSION);
    $requpload = $bdd->prepare('SELECT * FROM customer LEFT JOIN associates on customer.customer_id= associates.customer_id WHERE customer.societe_ref_prosp=?  ');
    $requpload->execute(array($_SESSION['auth']['societe_ref_prosp']));
    $dataname = $requpload->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($dataname);
    //die(); 

    $ci = $_FILES['ci-0']['tmp_name']; //ici pour le $_FILES on prend le nom et l'autre sert a etre sur et il passe par le secteur temporaire du serveur
   // var_dump($_FILES);
    //ici on récupere l'extension (.jpg,.img,...) le end permet de selectionner le dernier point
    $ci_extension = explode(".", $_FILES['ci-0']['name']);
    $ci_extension = strtolower(end($ci_extension));
    $ci_new_name = str_replace(" ","","ci_".str_replace(" ","",$dataname[0]['customer_fullname'])."_".time().".".$ci_extension);

    if(in_array($ci_extension,$extAuthorized)) {
        move_uploaded_file($ci, str_replace(" ","",$path) .str_replace(" ","",$ci_new_name));
        echo $_SESSION['auth']['societe_ref_prosp']."/".$ci_new_name;
       
       // var_dump($dataname);
       // var_dump($ci_new_name);
    
    }
    
}
