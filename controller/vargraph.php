<?php
require '../setting.php';
include 'connectbdd.php';
require 'function.php';
$graph1 = array(
  'Prospect' => null,
  'Actif' => null,
  'Archivé' => null,
  'Contentieux' => null
);
$arrayDate = array();

// req pour calculer le nombre de societe et leurs status
$query = "SELECT COUNT(societe_id) AS nbTot,DATE_FORMAT(societe_crea_date,'%y-%m') AS creaDate ,status.status_type AS statN
FROM societe 
JOIN status ON societe.status_id= status.status_id  ";
if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
  $start = $_POST['startDate'] . " 00:00:00";
  $end = $_POST['endDate'] . " 00:00:00";
  $query .= " WHERE societe.societe_crea_date BETWEEN '{$start}' AND '{$end}'";
}
$query .= " GROUP BY statN, creaDate";
$req = $bdd->prepare($query);
$req->execute();
$soc = $req->fetchAll(PDO::FETCH_ASSOC);

//var_dump($soc);
$months=getLatestMonth();
foreach($graph1 as $k => $v){
  $graph1[$k]=array_fill_keys($months,0); 
  ksort($graph1[$k]);

}
//var_dump($graph1);
foreach ($soc as $val) {
  if(array_key_exists($val['creaDate'],$graph1[$val['statN']])){
    $graph1[$val['statN']][$val['creaDate']]=$val['nbTot'];
  }

}
//var_dump($graph1);

// requête pour les prestations

$query1 = "SELECT presta.prest_name AS prestN , COUNT(id) AS nbPrest , DATE_FORMAT(date,'%y-%m') AS datePrest 
FROM history JOIN presta ON presta.prest_id= history.presta_id WHERE";
if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
  $start = $_POST['startDate'] . " 00:00:00";
  $end = $_POST['endDate'] . " 00:00:00";
  $query1 .= " history.date BETWEEN '{$start}' AND '{$end}' AND ";
}
$query1 .= " presta.prest_id IS NOT NULL GROUP BY DatePrest , presta.prest_id ";

$req2 = $bdd->prepare($query1);
$req2->execute();
$hist = $req2->fetchAll(PDO::FETCH_ASSOC);
//var_dump($hist);

$graph2 = array(
                'Etude de marché'=>0,
                'Buisness plan'=>0,
                'Création d\'entreprise'=>0,
                'Comptabilité'=>0,
                'Branding'=>0,
                'Site Internet'=>0,
                'Marketing'=>0,
                'Relation publique'=>0,
                'Vidéo'=>0,
                'Réseaux'=>0,
                'Fabrication'=>0,
                'Dépot de marque'=>0,
                'Bureaux'=>0
                
);

foreach ($graph2 as $k => $v) {
  $graph2[$k]=array_fill_keys($months,0);
  ksort($graph2[$k]);

}
foreach($hist as $val){
  if (array_key_exists($val['datePrest'],$graph2[$val['prestN']])) {
    $graph2[$val['prestN']][$val['datePrest']] = $val['nbPrest'];
  }
}
//var_dump($graph2);

// requete pour les formes juridiques
$query2 = "SELECT societe_form as form ,COUNT(societe_id) AS nbTot, DATE_FORMAT(societe_crea_date,'%y-%m') AS creaDate 
FROM societe WHERE ";
if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
  $start = $_POST['startDate'] . " 00:00:00";
  $end = $_POST['endDate'] . " 00:00:00";
  $query2 .= " societe.societe_crea_date BETWEEN '{$start}' AND '{$end}'";
}
$query2 .= " societe_form IS NOT NULL  GROUP BY creaDate,form ";

$req3 = $bdd->prepare($query2);
$req3->execute();
$form = $req3->fetchAll(PDO::FETCH_ASSOC);
//var_dump($form);

$graph3 = array('sas'=> 0,
                'sasu'=> 0,
                'sarl'=> 0,
                'eurl'=> 0
);
foreach($graph3 as $k=> $v){
  $graph3[$k]=array_fill_keys($months,0);
  ksort($graph3[$k]);
}
foreach ($form as $val) {
  if (array_key_exists($val['creaDate'], $graph3[$val['form']])) {
    $graph3[$val['form']][$val['creaDate']]=$val['nbTot'] ;
  }
}
//var_dump($graph3);



$arrayresponse = [$graph1, $graph2, $graph3];
$response = json_encode($arrayresponse);
echo $response;
