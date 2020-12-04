<?php

require_once 'connectbdd.php';
$toto=$_POST['societe_ref_prosp'];
// var_dump($toto);
// die();
// mise a jour status n° de client,n° de contentieux

if(isset($_POST['update10'])){ $req1= $bdd->prepare("UPDATE societe SET societe_ref_customer = ? , societe_ref_cont= ? WHERE societe_ref_prosp= ? ");
    $req1->execute(array(
        $_POST['societe_ref_customer'],
        $_POST['societe_ref_cont'],
        $_POST['societe_ref_prosp']
    ));
    header("Location: ../mise-a-jour-du-dossier-$toto");
}
    
if(isset($_POST['update11'])){ $req1= $bdd->prepare("UPDATE societe SET  sign_date=? WHERE societe_ref_prosp= ? ");
    $req1->execute(array(
        $_POST['sign_date'],
        $_POST['societe_ref_prosp']
    ));
    header("Location: ../mise-a-jour-du-dossier-$toto");
}
    
if(isset($_POST['update1'])){
    var_dump($_POST);
    $req1= $bdd->prepare("UPDATE societe SET  status_id = ? WHERE societe_ref_prosp= ? ");
    $req1->execute(array(
        intval($_POST['status_id']),
        $_POST['societe_ref_prosp']
    ));
    if( intval($_POST['status_id'])== 1){
        $newstat= 'Prospect';
    }elseif(intval($_POST['status_id'])== 2){
        $newstat='En cours de création';
    
    }elseif(intval($_POST['status_id'])== 3){
        $newstat='Actif';
    
    }elseif(intval($_POST['status_id'])== 4){
        $newstat='Contentieux';
    }
    else {$newstat= '';}
    $req2= $bdd->prepare("INSERT INTO history(societe_ref_prosp,comments) VALUES(?,?)");
    $req2->execute(array($toto,"changement de classe: ".$newstat));


header("Location: ../mise-a-jour-du-dossier-$toto");
}
// ajout d'un commentaires de temps de travail suite à un rendez-vous
if(isset($_POST['update2'])){
    $reqhistory=$bdd->prepare('INSERT INTO history(societe_ref_prosp,comments,time_work) VALUES(?,?,?)');
$reqhistory->execute(array(
   htmlspecialchars($toto),
   htmlspecialchars($_POST['comments']), 
   htmlspecialchars($_POST['time_work']) 
));
    header("Location: ../mise-a-jour-du-dossier-$toto");
}
// update des prestations
if(isset($_POST['update3'])){
    var_dump($_POST);
    foreach($_POST['presta_id'] as $presta){
    $req3 = $bdd->prepare("INSERT INTO history(societe_ref_prosp, presta_id) VALUES(?,?) ");
    $req3->execute(array(
        htmlspecialchars($toto),
         intval($presta),
        ));
    }
    header("Location: ../mise-a-jour-du-dossier-$toto");
}
// MAJ des données du dirigeant (adresse, mail ,phone)
if(isset($_POST['update4'])){
    var_dump($_POST);
    $req4=$bdd->prepare("UPDATE customer SET customer_email=?, customer_phone=?, customer_address=?, customer_zip_code=? , customer_city= ? WHERE  customer_id =?");
    $req4->execute(array(
        htmlspecialchars($_POST['customer_email']),
        htmlspecialchars($_POST['customer_phone']),
        htmlspecialchars($_POST['customer_address']),
        $_POST['customer_zip'],
        htmlspecialchars($_POST['customer_city']),
        intval($_POST['customer_id'])
    ));

    header("Location: ../mise-a-jour-du-dossier-$toto");
}
// Mise a jour des infos de la société (Adresse, activité, siret ....)
if(isset($_POST['update5'])){
    var_dump($_POST);
    $req5=$bdd->prepare('UPDATE societe SET societe_activity=:societe_activity, societe_address=:societe_address , societe_zip_code=:societe_zip_code, societe_city=:societe_city, societe_immat=:societe_immat,tva_number=:tva_number, code_ape=:code_ape,rcs_city= :rcs_city WHERE societe_ref_prosp = :societe_ref_prosp');
    $req5->bindValue(':societe_activity',$_POST['societe_activity']);
    $req5->bindValue(':societe_address',$_POST['societe_address']);
    $req5->bindValue(':societe_zip_code',$_POST['societe_zip_code']);
    $req5->bindValue(':societe_city',$_POST['societe_city']);
    $req5->bindValue(':societe_immat',$_POST['societe_immat']);
    $req5->bindValue(':tva_number',$_POST['TVA_number']);
    $req5->bindValue(':code_ape',$_POST['code_ape']);
    $req5->bindValue(':rcs_city',$_POST['rcs_city']);
    $req5->bindValue(':societe_ref_prosp',$_POST['societe_ref_prosp']);
    $req5->execute();
         //array(
    //     htmlspecialchars($_POST['societe_activity']),
    //     htmlspecialchars($_POST['societe_address']),
    //     $_POST['societe_zip_code'],
    //     htmlspecialchars($_POST['societe_city']),
    //     $_POST['societe_immat'],
    //     $_POST['TVA_number'],
    //     $_POST['code_ape'],
    //     htmlspecialchars($_POST['rcs_city']),
    //     $toto
    // ));
    header("Location: ../mise-a-jour-du-dossier-$toto");
}
// MAJ des données bancaires
if(isset($_POST['update6'])){
    var_dump($_POST);
    $req6=$bdd->prepare("UPDATE societe SET bank =?, bank_address = ? , iban = ? WHERE societe_ref_prosp = ?");
    $req6->execute(array(
        htmlspecialchars($_POST['bank']),
        htmlspecialchars($_POST['bank_address']),
        $_POST['iban'],
        htmlspecialchars($_POST['societe_ref_prosp'])
    ));

    header("Location: ../mise-a-jour-du-dossier-$toto");
}
//MAJ de la domiciliation
if(isset($_POST['update7'])){
    //var_dump($_POST);
    $req7=$bdd->prepare("UPDATE societe SET domiciliation= ? WHERE societe_ref_prosp=?");
    $req7->execute(array(
    htmlspecialchars($_POST['domiciliation']),
    htmlspecialchars($_POST['societe_ref_prosp'])
    ));
    header("Location: ../mise-a-jour-du-dossier-$toto");
}
// MAJ des locaux 
if(isset($_POST['update8'])){
    // var_dump($_POST);
    // die();
   
    $req8=$bdd->prepare("UPDATE societe SET lease_term_id=?, ref_int_local=?  WHERE societe_ref_prosp= ?");
    $req8->execute(array(
        $_POST['lease_term_id'],
        $_POST['ref_int_local'],
        $_POST['societe_ref_prosp']
    ));

//var_dump($_POST);
    //header("Location: ../mise-a-jour-du-dossier-$toto");
}
// var_dump($_POST);
// die();
if(isset($_POST['update9'])){
    $req9=$bdd->prepare('UPDATE local SET number_park_place=?, rent_surface_price_m=?, mensual_rent_ht=?, rent_letter=?,prorated_rent=?,charge=?,property_tax=?,cumulative_rent=? WHERE ref_int_local=?');
    $req9->execute(array(
        floatval($_POST['number_park_place']),
        floatval($_POST['rent_surface_price']),
        floatval($_POST['mensual_rent_ht']),
        $_POST['rent_letter'],
        floatval($_POST['prorated_rent']),
        floatval($_POST['charge']),
        floatval($_POST['property_tax']),
        floatval($_POST['cumulative_rent']),
        $_POST['ref_int_local']
    ));
    $req10=$bdd->prepare('UPDATE societe SET date_end=?, date_entrance=?, security_deposit=? WHERE societe_ref_prosp=? ');
    $req10->execute(array(
        $_POST['date_end'],
        $_POST['date_entrance'],
        $_POST['security_deposit'],
        $_POST['societe_ref_prosp']
    ));


    header("Location: ../mise-a-jour-du-dossier-$toto");
}


