<?php
 session_start();

require_once 'connectbdd.php';


// gestion des données pour retour en affichage 

// $data=array();
// $data['customer_full_nameAss']=$_POST['customer_full_nameAss'];
// $data['customer_first_nameAss']=$_POST['customer_first_nameAss'];
// $data['participationAss']=$_POST['participationAss'];
// $data['number_actionAss']=$_POST['number_actionAss'];
// $datas=json_encode($data);
// echo $datas;


if(isset($_POST)){
    // $reqsoc=$bdd->prepare("SELECT number_action FROM societe WHERE societe_ref_prosp=?");
    // $reqsoc->execute(array($_SESSION['auth']['societe_ref_prosp']));
    // $dataAction= $reqsoc->fetch();
    // // var_dump($dataAction);
    // $nbactionass= $_POST['number_actionAss'];
    //  $actionRes= $dataAction - $nbactionass;
    // var_dump($actionRes);

    //var_dump($_POST);

   
    
    
    $path = '../upload/' . $_SESSION['auth']['societe_ref_prosp'] . '/';
    //var_dump($path);
    //var_dump($_FILES);

   // traitemant de la carte d'identité
    // if((empty($_FILES['ci_Ass'])) && (empty($_FILES['just_domAss'])) && (empty($_FILES['attes_no_cond_Ass'])))
    // { 
    //       var_dump($_SESSION);
    // }else{
        $extAuthorized = array("pdf", "jpg", "png", "tiff");
        $docarray=array();
   
        //var_dump($_FILES);
        $ci = $_FILES['ci_Ass']['tmp_name']; //ici pour le $_FILES on prend le nom et l'autre sert a etre sur et il passe par le secteur temporaire du serveur
        //var_dump($_FILES);
        //ici on récupere l'extension (.jpg,.img,...) le end permet de selectionner le dernier point
        $ci_extension = explode(".", $_FILES['ci_Ass']['name']);
        $ci_extension = strtolower(end($ci_extension));
        $ci_new_name = "ci_Ass_" . $_POST['customer_full_nameAss'] . "_" . time() . "." . $ci_extension;

         if( in_array($ci_extension,$extAuthorized)){
            move_uploaded_file($ci, $path . $ci_new_name);
            $docarray[]= array("name"=>$ci_new_name, "type"=>1);
            
            echo $ci_new_name;


        // var_dump($dataname);
        // var_dump($ci_new_name);

        }

    // traitement du justif de dom
  
        $just_dom = $_FILES['just_dom_Ass']['tmp_name']; //ici pour le $_FILES on prend le nom et l'autre sert a etre sur et il passe par le secteur temporaire du serveur
        //var_dump($_FILES);
        //ici on récupere l'extension (.jpg,.img,...) le end permet de selectionner le dernier point
        $just_dom_extension = explode(".", $_FILES['just_dom_Ass']['name']);
        $just_dom_extension = strtolower(end($just_dom_extension));
        $just_dom_new_name = "just_dom_Ass_" . $_POST['customer_full_nameAss'] . "_" . time() . "." . $just_dom_extension;

        if( in_array($just_dom_extension, $extAuthorized)) {
            move_uploaded_file($just_dom, $path . $just_dom_new_name);
            $docarray[]=array("name"=>$just_dom_new_name, "type"=>2);
            echo $just_dom_new_name;
        
        }
       
    // traitement attestation de non condamnation
        $attest_no_cond = $_FILES['attest_no_cond_Ass']['tmp_name']; //ici pour le $_FILES on prend le nom et l'autre sert a etre sur et il passe par le secteur temporaire du serveur
    // var_dump($_FILES);
        //ici on récupere l'extension (.jpg,.img,...) le end permet de selectionner le dernier point
        $attest_no_cond_extension = explode(".", $_FILES['attest_no_cond_Ass']['name']);
        $attest_no_cond_extension = strtolower(end($attest_no_cond_extension));
        $attest_no_cond_new_name = "attestation_de_non_condamnation_Ass_" . $_POST['customer_full_nameAss'] . "_" . time() . "." . $attest_no_cond_extension;

        if( in_array($attest_no_cond_extension, $extAuthorized)) {
            move_uploaded_file($attest_no_cond, $path . $attest_no_cond_new_name);
            $docarray[]= array("name"=>$attest_no_cond_new_name, "type"=>3);
        
            echo $attest_no_cond_new_name;
        // var_dump($dataname);
               
        }   
        
   var_dump($docarray);
 
    //}
   
   
    $reqCreateAss=$bdd->prepare('INSERT INTO customer(societe_ref_prosp, cust_status, customer_civility, customer_fullname, customer_firstname, customer_email, customer_phone, customer_address, customer_zip_code, customer_city, customer_birthday, customer_place_of_birth, customer_nationality)
    VALUES(:societe_ref_prosp, :cust_status,:customer_civility ,:customer_fullname, :customer_firstname, :customer_email, :customer_phone, :customer_address, :customer_zip_code, :customer_city, :customer_birthday, :customer_place_of_birth, :customer_nationality)');
    $reqCreateAss->execute(array( 
        'societe_ref_prosp'=> $_SESSION['auth']['societe_ref_prosp'],
        'cust_status'=>intval($_POST['cust_status']),
        'customer_civility'=>htmlspecialchars($_POST['civility']),
        'customer_fullname' =>htmlspecialchars($_POST['customer_full_nameAss']), 
        'customer_firstname' =>htmlspecialchars($_POST['customer_first_nameAss']), 
        'customer_email' =>htmlspecialchars($_POST['customer_emailAss']), 
        'customer_phone' =>intval($_POST['customer_phoneAss']), 
        'customer_address' =>htmlspecialchars($_POST['customer_addressAss']), 
        'customer_zip_code' =>intval($_POST['customer_zipAss']), 
        'customer_city' =>htmlspecialchars($_POST['customer_cityAss']), 
        'customer_birthday' =>($_POST['customer_birthdayAss']), 
        'customer_place_of_birth' =>htmlspecialchars($_POST['customer_place_of_birthAss']), 
        'customer_nationality' =>htmlspecialchars($_POST['customer_nationalityAss'])  
    ));
    
    $custId= $bdd->lastInsertId();
//     var_dump($custId);
foreach($docarray as $doc){
    var_dump($doc);
    
    $reqinsdoc=$bdd->prepare("INSERT INTO upload(societe_ref_prosp, upload_doc_name, upload_doctype_id) VALUES (:societe_ref_prosp, :upload_doc_name, :upload_doctype_id)"); 
    $reqinsdoc->execute(array(
        "societe_ref_prosp"=> $_SESSION['auth']['societe_ref_prosp'], 
        "upload_doc_name"=>$doc['name'], 
        "upload_doctype_id"=>$doc['type']

    ));
    $docid[]= $bdd->lastInsertId();
      
}    

   $reqCreateAss1=$bdd->prepare("INSERT INTO associates(customer_id, societe_ref_prosp, associate_nb_action, associate_participation,associate_doc ) VALUES(:customer_id, :societe_ref_prosp, :associate_nb_action,:associate_participation, :associate_doc)");
   $reqCreateAss1->execute(array(
       'customer_id'=>$custId,
       "societe_ref_prosp"=>$_SESSION['auth']['societe_ref_prosp'],
       'associate_nb_action'=>intval($_POST['number_actionAss']),
       "associate_participation"=>floatval($_POST['participationAss']), 
       'associate_doc'=>implode(",",$docid)
    
       

   ));

  header('Location:../ajouter-un-associe');
}
