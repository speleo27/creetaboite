<?php
session_start();
if(!isset($_SESSION['auth'])){
session_destroy();
    header("Location:accueil");

}

require __DIR__.'/vendor/autoload.php';
//require_once 'template/header.php';
require_once 'controller/connectbdd.php';
include 'controller/function.php';

$reqaffDir=$bdd->prepare('SELECT * FROM customer LEFT JOIN associates ON (associates.customer_id = customer.customer_id)  LEFT JOIN societe on (societe.societe_ref_prosp=customer.societe_ref_prosp) WHERE customer.societe_ref_prosp=? GROUP BY customer.customer_id order by customer.customer_id ');
$reqaffDir->execute(array($_SESSION['auth']['societe_ref_prosp']));
$dataDir= $reqaffDir->fetchAll(PDO::FETCH_ASSOC);

// var_dump($dataDir);
// die();



// $header='<p><img src="../../src/img/Logo-Euripole.png" style="max-width:4.5cm"></p>';
// $footer='<div style="position: absolute; bottom:40px; left:0px"><hr style="color:#759672; border:10px #759672 solid "><p  style=" font-size:0.8em;text-align:center; color:#759672 ">EURIPOLE Business Center 17 Rue  Sancey - ZA des Vauguillettes III - 89100 SENS Tél. +33.(0)3.86.88.30.61 SIRET 844 641 449 000 13 Code NAF/APE 6820B Courriel : euripole@orange.fr – Site internet : www.euripole.fr</p></div>';
//$file= file_get_contents("./pdf/matrice/recap_eurl.html");
$file='
<p style="margin-top:0pt; margin-bottom:8pt; text-align:center; line-height:108%; font-size:18pt;"><span
        style="font-family:Calibri;">R&eacute;capitulatif des informations</span></p>
<p style="margin-top:0pt; margin-bottom:8pt; text-align:center; line-height:108%; font-size:11pt;"><span
        style="font-family:Calibri;">&nbsp;</span></p>
<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:14pt;"><span
        style="font-family:Calibri;">Vous &ecirc;tes</span><span style="font-family:Calibri;">&nbsp;</span><span
        style="font-family:Calibri;">:</span><span style="width:8.47pt; display:inline-block;">&nbsp;</span></p>
<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
        style="font-family:Calibri;">Civilit&eacute;</span><span
        style="width:5.31pt; display:inline-block;">&nbsp;</span><span style="font-family:Calibri;">:
        '.ucfirst($dataDir[0]['customer_civility']).'</span><span style="width:3.84pt; display:inline-block;">&nbsp;</span><span
        style="width:35.4pt; display:inline-block;">&nbsp;</span><span
        style="width:35.4pt; display:inline-block;">&nbsp;</span><span
        style="width:35.4pt; display:inline-block;">&nbsp;</span></p>
<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
        style="font-family:Calibri;">Nom</span><span style="font-family:Calibri;">&nbsp;</span><span
        style="font-family:Calibri;">: '.ucfirst($dataDir[0]['customer_fullname']).'</span><span
        style="width:2.36pt; display:inline-block;">&nbsp;</span><span
        style="width:35.4pt; display:inline-block;">&nbsp;</span><span
        style="width:35.4pt; display:inline-block;">&nbsp;</span><span
        style="width:35.4pt; display:inline-block;">&nbsp;</span></p>
<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
        style="font-family:Calibri;">Pr&eacute;nom</span><span style="font-family:Calibri;">&nbsp;</span><span
        style="font-family:Calibri;">: '.ucfirst($dataDir[0]['customer_firstname']).'</span><span
        style="width:22.17pt; display:inline-block;">&nbsp;</span></p>
<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
        style="font-family:Calibri;">Adresse</span><span style="font-family:Calibri;">&nbsp;</span><span
        style="font-family:Calibri;">: '.$dataDir[0]['customer_address'].' '.$dataDir[0]['customer_zip_code'].' '.strtoupper($dataDir[0]['customer_city']).'</span></p>
<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
        style="font-family:Calibri;">N&eacute;e le</span><span style="font-family:Calibri;">&nbsp;</span><span
        style="font-family:Calibri;">: '.DateFormat($dataDir[0]['customer_birthday']).' &agrave; '.strtoupper($dataDir[0]['customer_place_of_birth']).'</span></p>
<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
        style="font-family:Calibri;">Nationalit&eacute;</span><span style="font-family:Calibri;">&nbsp;</span><span
        style="font-family:Calibri;">: '.$dataDir[0]['customer_nationality'].'</span><span
        style="width:3.08pt; display:inline-block;">&nbsp;</span><span
        style="width:35.4pt; display:inline-block;">&nbsp;</span></p>';


    
    $file2='<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
            style="font-family:Calibri;">Nombre actions</span><span style="font-family:Calibri;">&nbsp;</span><span
            style="font-family:Calibri;">: '.$dataDir[0]['associate_nb_action'].'</span></p>
    <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
            style="font-family:Calibri;">Participation</span><span style="font-family:Calibri;">&nbsp;</span><span
            style="font-family:Calibri;">: '.$dataDir[0]['associate_participation'].' %</span><span
            style="width:12.51pt; display:inline-block;">&nbsp;</span></p><p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
            style="font-family:Calibri;">&nbsp;</span></p>';

$file3='<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:14pt;"><span
style="font-family:Calibri;">Votre soci&eacute;t&eacute;</span><span
style="font-family:Calibri;">&nbsp;</span><span style="font-family:Calibri;">:</span></p>
<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
style="font-family:Calibri;">Raison sociale</span><span style="font-family:Calibri;">&nbsp;</span><span
style="font-family:Calibri;">: '.strtoupper($dataDir[0]['societe_name']).'</span></p>
<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
style="font-family:Calibri;">Nom commercial</span><span style="font-family:Calibri;">&nbsp;</span><span
style="font-family:Calibri;">: '.$dataDir[0]['commercial_name'].'</span></p>
<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
style="font-family:Calibri;">Activit&eacute;</span><span style="font-family:Calibri;">&nbsp;</span><span
style="font-family:Calibri;">: '.$dataDir[0]['societe_activity'].' </span></p>
<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
style="font-family:Calibri;">Forme juridique choisi</span><span
style="font-family:Calibri;">&nbsp;</span><span style="font-family:Calibri;">: '.strtoupper($dataDir[0]['societe_form']).'</span></p>
<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
style="font-family:Calibri;">Capital</span><span style="font-family:Calibri;">&nbsp;</span><span
style="font-family:Calibri;">: '.$dataDir[0]['capital'].'&euro;</span></p>
';

   

$arrayAsso=array();
foreach($dataDir as $asso){
    
    if($asso['cust_status']== 3){ 
       array_push($arrayAsso, $asso); 
    }
}
 //var_dump($arrayAsso);
$mpdf= new Mpdf\Mpdf([' mode'=> 'utf8', 
'format'=> 'A4',
'margin_left' => 15,
'margin_right' => 15,
'margin_top' => 30,
'margin_bottom' => 30,
'margin_header' => 3,
'margin_footer' => 3,]

);
$mpdf->SetHTMLHeader('<p><img src="https://euricrea.sebastien-rossi-speleo27.fr/src/img/Logo-Euripole.png" style="max-width:4.5cm; position:fixed-top-left; margin-top: 10px; margin-left: -50px;"></p>','O');
$mpdf->SetHTMLFooter('<table width="100%" style="border-top:2.5px solid #759672">
                            <tr >
                                <td width="20%" style=" font-size:0.2em;"><barcode size="0.8" code="'.sprintf('%011d',time()).'" type="UPCA"   class="barcode" /></td>
                                <td width="60%" align="center" style="font-size:0.8em;text-align:center; color:#759672; padding-top: 10px">EURIPOLE Business Center <br>17 Rue  Sancey - ZA des Vauguillettes III - 89100 SENS <br>Tél. +33.(0)3.86.88.30.61 SIRET 844 641 449 000 13 Code NAF/APE 6820B <br>Courriel : euripole@orange.fr – Site internet : www.euripole.fr</td>
                                <td width="20%" style="text-align: right; font-size:0.8em;">{PAGENO}/{nbpg}</td>
                            </tr>
                      </table>');


$mpdf->WriteHTML($file);
if($dataDir[0]['cust_status']!= 1){
$mpdf->WriteHTML($file2);}
$mpdf->WriteHTML($file3);
if($dataDir[0]['societe_form']== 'sas' || $dataDir[0]['societe_form']== 'sarl'){
    $file4='<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
    style="font-family:Calibri;">Nombre d&rsquo;action</span><span
    style="font-family:Calibri;">&nbsp;</span><span style="font-family:Calibri;">: '.$dataDir[0]['number_action'].' au
    prix unitaire de '.$dataDir[0]['action_price'].' &euro;</span></p>
<p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:14pt;"><span
    style="font-family:Calibri;">&nbsp;</span></p>';
    foreach($arrayAsso as $asso){
        //var_dump($asso);
        $file5.=' <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:14pt;"><span
        style="font-family:Calibri;">Vos associ&eacute;s</span><span style="font-family:Calibri;">&nbsp;</span><span
        style="font-family:Calibri;">:</span></p>
    <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
        style="font-family:Calibri;">Civilit&eacute;</span><span
        style="width:5.31pt; display:inline-block;">&nbsp;</span><span style="font-family:Calibri;">:
        '.ucfirst($asso['customer_civility']).'</span><span style="width:3.84pt; display:inline-block;">&nbsp;</span><span
        style="width:35.4pt; display:inline-block;">&nbsp;</span><span
        style="width:35.4pt; display:inline-block;">&nbsp;</span><span
        style="width:35.4pt; display:inline-block;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
        style="font-family:Calibri;">Nom</span><span style="font-family:Calibri;">&nbsp;</span><span
        style="font-family:Calibri;">:'.ucfirst($asso['customer_fullname']).'</span><span
        style="width:2.36pt; display:inline-block;">&nbsp;</span><span
        style="width:35.4pt; display:inline-block;">&nbsp;</span><span
        style="width:35.4pt; display:inline-block;">&nbsp;</span><span
        style="width:35.4pt; display:inline-block;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
        style="font-family:Calibri;">Pr&eacute;nom</span><span style="font-family:Calibri;">&nbsp;</span><span
        style="font-family:Calibri;">:'.ucfirst($asso['customer_firstname']).'</span><span
        style="width:22.17pt; display:inline-block;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
        style="font-family:Calibri;">Adresse</span><span style="font-family:Calibri;">&nbsp;</span><span
        style="font-family:Calibri;">:'. $asso['customer_address'].' '.$asso['customer_zip_code'].' '.strtoupper($asso['customer_city']).'</span></p>
    <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
        style="font-family:Calibri;">N&eacute;e le</span><span style="font-family:Calibri;">&nbsp;</span><span
        style="font-family:Calibri;">: '.DateFormat($asso['customer_birthday']).' &agrave; '.strtoupper($asso['customer_place_of_birth']).'</span></p>
    <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
        style="font-family:Calibri;">Nationalit&eacute;</span><span style="font-family:Calibri;">&nbsp;</span><span
        style="font-family:Calibri;">:'. $asso['customer_nationality'].'</span><span
        style="width:3.08pt; display:inline-block;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
        style="font-family:Calibri;">Nombre actions</span><span style="font-family:Calibri;">&nbsp;</span><span
        style="font-family:Calibri;">:'.$asso['associate_nb_action'].'</span></p>
    <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:11pt;"><span
        style="font-family:Calibri;">Participation</span><span style="font-family:Calibri;">&nbsp;</span><span
        style="font-family:Calibri;">: '.$asso['associate_participation'].' %</span><span
        style="width:12.51pt; display:inline-block;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:14pt;"><span
        style="font-family:Calibri;">&nbsp;</span></p>';
    }
    
$mpdf->WriteHTML($file4);
$mpdf->WriteHTML($file5);}


// $mpdf->Output('recap.pdf', \Mpdf\Output\Destination::INLINE);
$mpdf->Output('recap.pdf', \Mpdf\Output\Destination::DOWNLOAD);
$rq=$bdd->prepare("UPDATE connect set game_over=? WHERE societe_ref_prosp=?");
$rq->execute(array(1, $_SESSION['auth']['societe_ref_prosp']));

session_destroy();
header("Location:accueil ");





