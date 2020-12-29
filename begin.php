<?php
require 'setting.php';
require 'controller/connectbdd.php';
//var_dump($_GET);
$arraylink=array();

if(isset($_GET['key'])){
    $linkRecieve=base64_decode($_GET['key']);
    $arraylink= explode("--", $linkRecieve);
    // var_dump($linkRecieve);
    // var_dump($arraylink);
    
    $req=$bdd->prepare("SELECT * FROM connect WHERE  connect_email=? AND customer_id=? ");
    $req->execute(array(
        $arraylink['2'],
       intval( $arraylink['0']),
    ));
    $auth=$req->fetch(PDO::FETCH_ASSOC);
    //var_dump($auth);
    //die();
    
    $guizmobdd=$auth['guizmo'];
    $guizmosend=$arraylink['1'];
    if(password_verify($guizmosend,$guizmobdd) && $auth['connect_email'] == $arraylink['2'] && $auth['game_over']== 0){
        session_start();
        $_SESSION['auth']=$auth;
        //echo 'je suis bien déchiffrer et tous est correct';
        //var_dump($_SESSION);
        header("Location:accueil");
    }else{
        header("Location:404.php");
    }
}
else{
    header("Location:404.php");
    die();
}
	

