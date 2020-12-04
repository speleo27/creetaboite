<?php

require 'connectbdd.php';
include 'function.php';


//var_dump($_POST);
//var_dump($start);
//var_dump($end);

if (isset($_POST['startDate']) && isset($_POST['endDate'])) {

  $start = $_POST['startDate'] . " 00:00:00";


  $end = $_POST['endDate'] . " 00:00:00";

  // req pour calculer le nombre de societe
  $req = $bdd->prepare("SELECT * FROM societe WHERE societe_crea_date BETWEEN '{$start}' AND '{$end}' order by societe_crea_date DESC");
  $req->execute();
  $soc = $req->fetchAll(PDO::FETCH_ASSOC);
  //req pour l'historique
  $req1 = $bdd->prepare("SELECT  * FROM history WHERE presta_id IS NOT NULL and date BETWEEN '{$start}' AND '{$end}' ");
  $req1->execute();
  $histo = $req1->fetchAll(PDO::FETCH_ASSOC);
} else {
  
  // req pour calculer le nombre de societe
  $req = $bdd->prepare("SELECT  FROM societe order by societe_crea_date DESC ");
  $req->execute();
  $soc = $req->fetchAll(PDO::FETCH_ASSOC);
  
  //req pour l'historique
  $req1 = $bdd->prepare("SELECT  * FROM history WHERE presta_id IS NOT NULL  ");
  $req1->execute();
  $histo = $req1->fetchAll(PDO::FETCH_ASSOC);
}
var_dump($soc);
die();
$graph1=array();

foreach($soc as $creasoc){
  // déclaration des variables

   $key1=substr($creasoc['societe_crea_date'],0,7);
   $graph1=array('key1'=>0);
 
  $graph1[$key1]=array('nbprosp'=>0);
  $graph1[$key1]=array('nbactif'=>0);
  $graph1[$key1]=array('nbarch'=>0);
  $graph1[$key1]=array('nbcont'=>0);

  // recherche de date dans les cle 
  if(array_key_exists($key1,$graph1)){
    //condition si concernant le statut (prospect ...)
    if($creasoc['status_id']==1){
      $graph1[$key1]+=1;
      if(array_key_exists('nbprosp',$graph1)){
        $graph1[$key1]['nbprosp']+=1;
      }
    }
    elseif($creasoc['status_id']==2){
      $graph1[$key1]+=1;
      $graph1[$key1]['nbactif']=array('sas'=>0);
      $graph1[$key1]['nbactif']=array('sasu'=>0);
      $graph1[$key1]['nbactif']=array('sarl'=>0);
      $graph1[$key1]['nbactif']=array('eurl'=>0);
      if(array_key_exists('nbactif',$graph1)){
        $graph1[$key1]['nbactif']+=1;
      }
      
      //condition pour la forme juridique
      if($creasoc['societe_form']=='sas'){
        if(array_key_exists('sas',$graph1)){
          $graph1[$key1]['nbactif']['sas']+=1;
        }
      }
      elseif($creasoc['societe_form']=='sasu'){
        if(array_key_exists('sasu',$graph1)){
          $graph1[$key1]['nbactif']['sasu']+=1;
        }
      }
      elseif($creasoc['societe_form']=='sarl'){
        if(array_key_exists('sarl',$graph1)){
          $graph1[$key1]['nbactif']['sarl']+=1;

        }
       
      }
      elseif($creasoc['societe_form']=='eurl'){
        if(array_key_exists('eurl',$graph1)){
          $graph1[$key1]['nbactif']['eurl']+=1;
        }
      }
    }
    elseif($creasoc['status_id']==3){
      $graph1[$key1]+=1;
      if(array_key_exists('nbarch',$graph1)){
        $graph1[$key1]['nbarch']+=1;
      }
     
    }
    elseif($creasoc['status_id']==4){
      $graph1[$key1]+=1;
      if(array_key_exists('nbcont',$graph1)){
        $graph1[$key1]['nbcont']+=1;
      }
    }
    
  }else{
   $graph1[$key1]=1;

  }
}
var_dump($graph1);



//var_dump($soc);
//die();

// remonter chiffre pour les societes
$nbtotSoc = array_sum($graph1);


$nbtotalpresta = count($histo);
//echo 'nombre total de societe:' .$nbtotSoc;
//hr();
// $socarray=array();
// $month = 12;
// $nbprosp = 0;
// $nbactif = 0;
// $nbarch = 0;
// $nbcont = 0;
// $dayDay = explode("-",date("Y-m"));
// foreach($soc as $socs){
//   $date=explode("-",$socs['societe_crea_date']);
 
//   for ($i = 0; $i<$month; $i++) {
    
      
//       if ($stat['status_id'] == '1') {
//         $nbprosp += 1;
//       }
//       $socarray[$i]['nbprosp']=$nbprosp;
//       if ($stat['status_id'] == '2') {
//         $nbactif += 1;
//       }
//       $socarray[$i]['nbactif']=$nbactif;
//       if ($stat['status_id'] == '3') {
//         $nbarch += 1;
//       }
//       $socarray[$i]['nbarch']=$nbarch;
//       if ($stat['status_id'] == '4') {
//         $nbcont += 1;
//       }
//       $socarray[$i]['nbcont']=$nbcont;
      
    
    
//   }
// }
// var_dump($date);
// var_dump($dayDay);
// var_dump($socarray);

// //var_dump($histo);
// //var_dump($nbtotal);
// //die();
// $etude = 0;
// $buis = 0;
// $crea = 0;
// $compt = 0;
// $brand = 0;
// $site = 0;
// $mark = 0;
// $repub = 0;
// $vid = 0;
// $res = 0;
// $fab = 0;
// $depmark = 0;
// $bur = 0;

// foreach ($histo as $hist) {

//   if ($hist['presta_id'] == '1') {
//     $etude += 1;
//   }
//   if ($hist['presta_id'] == '2') {
//     $buis += 1;
//   }
//   if ($hist['presta_id'] == '3') {
//     $crea += 1;
//   }
//   if ($hist['presta_id'] == '4') {
//     $compt += 1;
//   }
//   if ($hist['presta_id'] == '5') {
//     $brand += 1;
//   }
//   if ($hist['presta_id'] == '6') {
//     $site += 1;
//   }
//   if ($hist['presta_id'] == '7') {
//     $mark += 1;
//   }
//   if ($hist['presta_id'] == '8') {
//     $repub += 1;
//   }
//   if ($hist['presta_id'] == '9') {
//     $vid += 1;
//   }
//   if ($hist['presta_id'] == '10') {
//     $res += 1;
//   }
//   if ($hist['presta_id'] == '11') {
//     $fab += 1;
//   }
//   if ($hist['presta_id'] == '12') {
//     $depmark += 1;
//   }
//   if ($hist['presta_id'] == '13') {
//     $bur += 1;
//   }
// }

// $eurl = 0;
// $sarl = 0;
// $sas = 0;
// $sasu = 0;

// foreach ($soc as $data) {
//   if ($data['societe_form'] == "eurl") {
//     $eurl += 1;
//   }
//   if ($data['societe_form'] == "sarl") {
//     $sarl += 1;
//   }
//   if ($data['societe_form'] == "sas") {
//     $sas += 1;
//   }
//   if ($data['societe_form'] == "sasu") {
//     $sasu += 1;
//   }
// }
// $globalArray = array(
//   'nbtotSoc' => $nbtotSoc,
//   'nbtotalpresta' => $nbtotalpresta,
//   'nbprosp' => $nbprosp,
//   'nbactif' => $nbactif,
//   'nbarch' => $nbarch,
//   'nbcont' => $nbcont,
//   'etude' => $etude,
//   'buis' => $buis,
//   'crea' => $crea,
//   'compt' => $compt,
//   'brand' => $brand,
//   'site' => $site,
//   'mark' => $mark,
//   'repub' => $repub,
//   'vid' => $vid,
//   'res' => $res,
//   'fab' => $fab,
//   'depmark' => $depmark,
//   'bur' => $bur,
//   'eurl' => $eurl,
//   'sarl' => $sarl,
//   'sas' => $sas,
//   'sasu' => $sasu,
// );

// //var_dump($globalArray);

// $response = json_encode($globalArray);
// echo $response;
