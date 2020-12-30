<?php
// lire le read  me  pour toutes les informations sur l'installation 
//connection a la base de données en ligne
$host = "localhost";
$dbname = "cgsmxggl_creetaboite";
$user = "cgsmxggl_creetaboite";
$password = "7EM]*gmqAbCY";

// //connection local
// $host = "localhost";
// $dbname = "creetaboite";
// $user = "root";
// $password = "";

//le titre du site
$title = "Crée ta boite";

// logo de votre societé
$https= "https://creetaboite.sebastien-rossi-speleo27.fr";
$logo=$https.'/img/logo_creer_ta_boite2.svg';
$nameboite= "Crée ta boite";

// traitement des données liées au cgu
$property="Sebastien Rossi 4, rue du four 10400 Pont sur seine";
$publi= 'Sebastien Rossi - sebastien.rossi@gretasudchampagne.com';
$webmaster= 'Sebastien Rossi - sebastien.rossi@gretasudchampagne.com';
$heber= 'ovh – 2 rue Kellermann 59100 Roubaix 1007';
$dpo= 'Sebastien Rossi - sebastien.rossi@gretasudchampagne.com';



// traitement de l'envoi de mail
$phpmail=true;
// si $phpmail est égale a false
// donnée mail jet
// define("KEY_ID","votre clé id à coller");
// define("KEY_SCRT","votre clé secret à coller");
define("KEY_ID","ee87ec9c0655d17f6ee4beffdb21831f");
define("KEY_SCRT","fb35779ff38ad0a98b5ec9a768773f9c");
define("ADDRESS", $https);

// adresse mail expéditeur
$emetteur="sebastien.rossi@gretasudchampagne.com";
