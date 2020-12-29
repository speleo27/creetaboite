<?php
require '../setting.php';
require 'connectbdd.php';

if(empty($_FILES['just_dom-0'])) {
    die();
} else {
    session_start();
    
    $path = '../upload/' . $_SESSION['auth']['societe_ref_prosp'] . '/';
    //var_dump($_SESSION);
    $requpload = $bdd->prepare('SELECT customer_fullname,societe_ref_prosp,cust_status FROM customer WHERE societe_ref_prosp=?  ');
    $requpload->execute(array($_SESSION['auth']['societe_ref_prosp']));
    $dataname = $requpload->fetch();


    $just_dom = $_FILES['just_dom-0']['tmp_name']; //ici pour le $_FILES on prend le nom et l'autre sert a etre sur et il passe par le secteur temporaire du serveur
    //var_dump($_FILES);
    //ici on récupere l'extension (.jpg,.img,...) le end permet de selectionner le dernier point
    $just_dom_extension = explode(".", $_FILES['just_dom-0']['name']);
    $just_dom_extension = end($just_dom_extension);
    $just_dom_new_name = str_replace(" ","","just_dom_" . $dataname['customer_fullname'] . "_" . time() . "." . $just_dom_extension);

    if(($just_dom_extension== "pdf" or $just_dom_extension == "PDF") or ($just_dom_extension == "jpeg" or $just_dom_extension == "JPEG") or ($just_dom_extension == "jpg" or $just_dom_extension == "JPG") or ($just_dom_extension == "tiff" or $just_dom_extension == "TIFF")) {
        move_uploaded_file($just_dom, $path . $just_dom_new_name);
        echo $_SESSION['auth']['societe_ref_prosp']."/".$just_dom_new_name;
        //var_dump($dataname);
       // var_dump($just_dom_new_name);
     //var_dump($_SESSION['auth']['societe_ref_prosp']);
    }
}
