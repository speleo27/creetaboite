<?php
require '../setting.php';
require_once 'connectbdd.php';

if(empty($_FILES['attest_found-0'])) {
    die();
} else {
    session_start();
    
    $path = '../upload/' . $_SESSION['auth']['societe_ref_prosp'] . '/';
    //var_dump($_SESSION);
    $requpload = $bdd->prepare('SELECT customer_fullname,societe_ref_prosp,cust_status FROM customer WHERE societe_ref_prosp=?  ');
    $requpload->execute(array($_SESSION['auth']['societe_ref_prosp']));
    $dataname = $requpload->fetch();


    $attest_found= $_FILES['attest_found-0']['tmp_name']; //ici pour le $_FILES on prend le nom et l'autre sert a etre sur et il passe par le secteur temporaire du serveur
    //var_dump($_FILES);
    //ici on récupere l'extension (.jpg,.img,...) le end permet de selectionner le dernier point
    $attest_found_extension = explode(".", $_FILES['attest_found-0']['name']);
    $attest_found_extension = end($attest_found_extension);
    $attest_found_new_name = str_replace(" ","","depot_fond_" . $dataname['customer_fullname'] . "_" . time() . "." . $attest_found_extension);

    if(($attest_found_extension == "pdf" or $attest_found_extension == "PDF") or ($attest_found_extension == "jpeg" or $attest_found_extension == "JPEG") or ($attest_found_extension == "jpg" or $attest_found_extension == "JPG") or ($attest_found_extension == "tiff" or $attest_found_extension == "TIFF")) {
        move_uploaded_file($attest_found, $path . $attest_found_new_name);
        echo $_SESSION['auth']['societe_ref_prosp']."/".$attest_found_new_name;
       // var_dump($dataname);
       // var_dump($ci_new_name);
   
    }
}