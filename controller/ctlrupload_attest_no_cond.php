<?php
require '../setting.php';
require_once 'connectbdd.php';

if(empty($_FILES['attes_no_cond-0'])) {
    die();
} else {
    session_start();
    
    $path = '../upload/' . $_SESSION['auth']['societe_ref_prosp'] . '/';
   // var_dump($_SESSION);
    $requpload = $bdd->prepare('SELECT customer_fullname,societe_ref_prosp,cust_status FROM customer WHERE societe_ref_prosp=?  ');
    $requpload->execute(array($_SESSION['auth']['societe_ref_prosp']));
    $dataname = $requpload->fetch();


    $attest_no_cond = $_FILES['attes_no_cond-0']['tmp_name']; //ici pour le $_FILES on prend le nom et l'autre sert a etre sur et il passe par le secteur temporaire du serveur
   // var_dump($_FILES);
    //ici on récupere l'extension (.jpg,.img,...) le end permet de selectionner le dernier point
    $attest_no_cond_extension = explode(".", $_FILES['attes_no_cond-0']['name']);
    $attest_no_cond_extension = end($attest_no_cond_extension);
    $attest_no_cond_new_name = str_replace(" ","","attestation_de_non_condamnation_" . $dataname['customer_fullname'] . "_" . time() . "." . $attest_no_cond_extension);

    if(($attest_no_cond_extension == "pdf" or $attest_no_cond_extension == "PDF") or ($attest_no_cond_extension == "jpeg" or $attest_no_cond_extension == "JPEG") or ($attest_no_cond_extension == "jpg" or $attest_no_cond_extension == "JPG") or ($attest_no_cond_extension == "tiff" or $attest_no_cond_extension == "TIFF")) {
        move_uploaded_file($attest_no_cond, $path . $attest_no_cond_new_name);
        echo $_SESSION['auth']['societe_ref_prosp']."/".$attest_no_cond_new_name;
       // var_dump($dataname);
       // var_dump($ci_new_name);
  
    }
}
