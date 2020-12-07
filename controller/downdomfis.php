<?php
require_once  __DIR__.'../../vendor/autoload.php';
require 'connectbdd.php';
$logo="../img/logo_creer_ta_boite2.png";


$reqDomFisc =$bdd->prepare("SELECT * FROM societe INNER JOIN customer ON (societe.societe_ref_prosp = customer.societe_ref_prosp) WHERE societe.domiciliation ='fiscale' AND  (customer.cust_status =1 or  customer.cust_status =2)");
$reqDomFisc->execute(array());
$data = $reqDomFisc->fetchAll();

//var_dump($data);
$file='
<body>
    <p style="margin-top:0pt; margin-bottom:8pt; text-align:center; line-height:108%; font-size:18pt;"><span style="font-family:Calibri;">Tableau des domiciliations fiscales</span></p>
<p style="margin-top:0pt; margin-bottom:8pt; text-align:center; line-height:108%; font-size:18pt;"><span style="font-family:Calibri;">&nbsp;</span></p>
<p style="margin-top:0pt; margin-bottom:8pt; text-align:center; line-height:108%; font-size:18pt;"><span style="font-family:Calibri;">&nbsp;</span></p>
<table cellpadding="0" cellspacing="0" style="border:0.75pt solid #000000; border-collapse:collapse; width=100%">
    <tbody>
        <tr>
            <td style=" border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; background-color:#70ad47;">
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;"><span style="font-family:Calibri;">Nom de la soci&eacute;t&eacute;</span></p>
            </td>
            <td style=" border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; background-color:#70ad47;">
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;"><span style="font-family:Calibri;">Nom du dirigeant</span></p>
            </td>
            <td style=" border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; background-color:#70ad47;">
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;"><span style="font-family:Calibri;">N&deg; t&eacute;l&eacute;phone</span></p>
            </td>
            <td style=" border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; background-color:#70ad47;">
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;"><span style="font-family:Calibri;">Email</span></p>
            </td>
            <td style=" border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; background-color:#70ad47;">
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;"><span style="font-family:Calibri;">SIRET</span></p>
            </td>
            <td style=" border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top; background-color:#70ad47;">
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:11pt;"><span style="font-family:Calibri;">Code APE</span></p>
            </td>
        </tr>
    ';
   

$mpdf= new Mpdf\Mpdf([' mode'=> 'utf8', 
'format'=> 'A4',
'margin_left' => 15,
'margin_right' => 15,
'margin_top' => 30,
'margin_bottom' => 30,
'margin_header' => 3,
'margin_footer' => 3,]

);
$mpdf->SetHTMLHeader('<p><img src="'.$logo.'" style="max-width:4.5cm; position:fixed-top-left; margin-top: 10px; margin-left: -50px;"></p>','O');
$mpdf->SetHTMLFooter('<table width="100%" style="border-top:2.5px solid #759672">
                            <tr >
                                <td width="20%" style=" font-size:0.2em;"><barcode size="0.8" code="'.sprintf('%011d',time()).'" type="UPCA"   class="barcode" /></td>
                                <td width="60%" align="center" style="font-size:0.8em;text-align:center; color:#759672; padding-top: 10px">Cree ta boite<br>Courriel : creetaboite@orange.fr – Site internet : www.euripole.fr</td>
                                <td width="20%" style="text-align: right; font-size:0.8em;">{PAGENO}/{nbpg}</td>
                            </tr>
                      </table>');

foreach($data as $dataDomFisc){
    //var_dump($data);
$file.='
<tr>
<td style=" border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
    <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt;"><span style="font-family:Calibri;">'.$dataDomFisc['societe_name'].'</span></p>
</td>
<td style=" border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
    <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><span style="font-family:Calibri;">'.$dataDomFisc['customer_fullname'].' '.$dataDomFisc['customer_firstname'].'</span></p>
</td>
<td style="border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
    <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><span style="font-family:Calibri;">'.$dataDomFisc['customer_phone'].'</span></p>
</td>
<td style=" border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
    <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><span style="font-family:Calibri;">'.$dataDomFisc['customer_email'].'</span></p>
</td>
<td style=" border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
    <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><span style="font-family:Calibri;">'.$dataDomFisc['societe_immat'].'</span></p>
</td>
<td style=" border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
    <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><span style="font-family:Calibri;">'.$dataDomFisc['code_ape'].'</span></p>
</td>
</tr>'

      ;} 
    $file.='</tbody>
    </table>
    <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:18pt;"><span style="font-family:Calibri;">&nbsp;</span></p>
    </body>';


$mpdf->WriteHTML($file);

$mpdf->Output("/domiciliation_fiscale_".time().".pdf",\Mpdf\Output\Destination::DOWNLOAD);