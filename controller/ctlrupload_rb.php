<?php

require 'connectbdd.php';
require 'function.php';
if(empty($_FILES['rb-0'])) {
    die();
} else {
    session_start();
    
    $extAuthorized = array("pdf", "jpg", "png", "tiff");
    $path = '../upload/' . $_SESSION['auth']['societe_ref_prosp'] . '/';
   // var_dump($_SESSION);
    $requpload = $bdd->prepare('SELECT * FROM customer  LEFT JOIN associates ON customer.customer_id= associates.customer_id WHERE customer.societe_ref_prosp=? ');
    $requpload->execute(array($_SESSION['auth']['societe_ref_prosp']));
    $dataname = $requpload->fetchAll(PDO::FETCH_ASSOC);


    $rb = $_FILES['rb-0']['tmp_name']; //irb pour le $_FILES on prend le nom et l'autre sert a etre sur et il passe par le secteur temporaire du serveur
   // var_dump($_FILES);
    //irb on récupere l'extension (.jpg,.img,...) le end permet de selectionner le dernier point
    $rb_extension = explode(".", $_FILES['rb-0']['name']);
    $rb_extension = strtolower(end($rb_extension));
    $rb_new_name = str_replace(" ","","RIB_" . $dataname[0]['customer_fullname'] . "_" . time() . "." . $rb_extension);

    if(in_array($rb_extension,$extAuthorized)){
        move_uploaded_file($rb, $path . $rb_new_name);
        echo $_SESSION['auth']['societe_ref_prosp']."/".$rb_new_name;
       
       // var_dump($dataname);
       // var_dump($rb_new_name);
    }
    
}
