<?php
 include 'connectbdd.php';

 session_start();
//var_dump($_GET);
   

// del sur la table connect
$reqDel1=$bdd->prepare("DELETE  FROM connect WHERE societe_ref_prosp= ?");
$reqDel1->execute(array($_POST['societe_ref_prosp']));

 // del sur la table customer
 $reqDel=$bdd->prepare("DELETE  FROM  customer WHERE societe_ref_prosp= ?");
 $reqDel->execute(array(
     $_POST['societe_ref_prosp']
    ));



  // del sur la  table upload
 $reqDel2=$bdd->prepare("DELETE  FROM upload WHERE societe_ref_prosp= ?");
 $reqDel2->execute(array($_POST['societe_ref_prosp']));

  //del sur la table history
 $reqDel3=$bdd->prepare("DELETE  FROM history WHERE societe_ref_prosp= ?");
 $reqDel3->execute(array($_POST['societe_ref_prosp']));
 
 $reqDel5=$bdd->prepare("DELETE  FROM list_url WHERE societe_ref_prosp= ?");
 $reqDel5->execute(array($_POST['societe_ref_prosp']));

 $reqDel5=$bdd->prepare("DELETE  FROM associates WHERE societe_ref_prosp= ?");
 $reqDel5->execute(array($_POST['societe_ref_prosp']));
 //del sur la table societe
 $reqDel4=$bdd->prepare("DELETE FROM societe WHERE societe_ref_prosp= ?");
 $reqDel4->execute(array($_POST['societe_ref_prosp']));

header('Location:../gestion-des-dossiers');
