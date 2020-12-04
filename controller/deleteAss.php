<?php
session_start();

require_once 'connectbdd.php';

 var_dump($_GET);
$reqdelass=$bdd->prepare("DELETE  FROM associates WHERE customer_id=? ");
$reqdelass->execute(array(
    $_GET['toto'] ,
    
));

$reqdelcust= $bdd->prepare("DELETE  FROM customer WHERE customer_id=? ");
$reqdelcust->execute(array(
    $_GET['toto'],
    
));

header('Location:../ajouter-un-associe');