<?php
// les extension valides 
$valid_extensions = array('jpeg', 'jpg', 'pdf', 'tiff');

//variable pour la création du dossier de stochkage




function time_duration(){
    $startTime= time() ;
    $endTime= time();
    $timepass= ($endTime - $startTime)/60;
    return $timepass;
    }

    function DateFormat($date, $jour = NULL){
        if($jour == 2){
            $structure = "%A %d %B %Y";
            // TO USE IT => echo DateFormat("2020-01-12", 2); => Dimanche 12 Janvier 2020
        }
        elseif($jour == 1){
            $structure = "%d %B %Y";
            // TO USE IT => echo DateFormat("2020-01-12", 1); => 12 Janvier 2020
        }
        elseif($jour == NULL){
            $structure = "%d/%m/%Y";
            // TO USE IT => echo DateFormat("2020-01-12"); => 12/01/2020
        }
        elseif($jour == 3){
            $structure = "%d/%m/%Y à %H:%M";
            // TO USE IT => echo DateFormat("2020-01-12",3); => 12/01/2020 à 16:32
        }
        elseif($jour == 4){
            $structure = "%A %d %B %Y à %H:%M";
            // TO USE IT => echo DateFormat("2020-01-12",4); => 12/01/2020 à 16:32
        }
        $maDate = strtotime($date);
        $maDateFr = strftime($structure, $maDate);
        return $maDateFr;
    }
    function hoursandmins($time, $format = '%02d h %02d')
{
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

function insertdoc($docname,$typedoc){
    include 'connectbdd.php';
    $docexpl=explode("/",$docname);
    $docfin= end($docexpl);
    $requpload = $bdd->prepare('INSERT INTO upload(societe_ref_prosp,upload_doc_name,upload_doctype_id) VALUES (?,?,?)');
    $requpload->execute(array(
        $_SESSION["auth"]['societe_ref_prosp'],
        $docfin,
        $typedoc
    ));
    return $bdd->lastInsertId();
    
}
function addFiles($rename, $extAuthorized,$path,$societe,$doctype){
    include 'connectbdd.php';
    $files = $_FILES['filesAdd']['tmp_name']; //ici pour le $_FILES on prend le nom et l'autre sert a etre sur et il passe par le secteur temporaire du serveur
    // var_dump($_FILES);
    //ici on récupere l'extension (.jpg,.img,...) le end permet de selectionner le dernier point
    $files_extension = explode(".", $_FILES['filesAdd']['name']);
    $files_extension = strtolower(end($files_extension));
    $files_new_name = str_replace(" ", "", $rename . "_" . time() . "." . $files_extension);

    if (in_array($files_extension, $extAuthorized)) {
        move_uploaded_file($files, str_replace(" ", "", $path) . str_replace(" ", "", $files_new_name));
        echo  $files_new_name;
    }
    $reqAddFile=$bdd->prepare("INSERT INTO upload(societe_ref_prosp,upload_doc_name,upload_doctype_id) VALUES (:societe_ref_prosp,:upload_doc_name,:upload_doctype_id)");
    $reqAddFile->execute(array(
        "societe_ref_prosp"=>$societe,
        "upload_doc_name"=> $files_new_name,
        "upload_doctype_id"=>$doctype
    ));
}
// function getLatestMonth($dateM, $dateY)
// {
//   $arParMois = array();
//   $date_courant = date($dateY . "-" . $dateM . "-01");
//   for ($i = 0; $i < 13; $i++) {
//     if ($i === 0) {
//       $arParMois[$dateY . "-" . $dateM] = 0;
//     }else {
//       //- 1 mois à la date du jour
//       $mois = date("m", strtotime("-1 month", strtotime($date_courant)));
//       if ($mois == '12') {
//         $dateY = date("y", strtotime("-1 year", strtotime($date_courant)));
//       }
//       $arParMois[$dateY . "-" . $mois] = 0;
//       $date_courant = date($dateY . "-" . $mois . "-d");
//     }
//   }

//   return $arParMois;
// }
//var_dump(getLatestMonth(date("m"), date("y")));
function getLatestMonth($month=null,$year=null){
    if($month === null) $month=date('m');
    if($year=== null) $year= date('y');
    
    $from=strtotime($year.'-'.$month.'-01');
    
    $months=array();
    for($i=0;$i<13; $i++){
        $newdate=strtotime("-".$i." month",$from);
        array_push($months,date('y-m',$newdate));
    }
    return $months;
}
