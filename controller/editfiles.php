<?php



require '../setting.php';
require 'connectbdd.php';
include 'function.php';
require_once  __DIR__.'../../vendor/autoload.php';

//var_dump($_POST);
// die();
$reqeditdoc=$bdd->prepare("SELECT * FROM societe INNER JOIN customer ON (customer.societe_ref_prosp=societe.societe_ref_prosp) LEFT JOIN associates ON (associates.societe_ref_prosp =societe.societe_ref_prosp )   WHERE societe.societe_ref_prosp= ?");
$reqeditdoc->execute(array($_POST['societe_ref_prosp']));
$datas= $reqeditdoc->fetch();
$nbLigne= $reqeditdoc->rowCount();
// var_dump($nbLigne);
// die();

$reqdoc=$bdd->prepare("SELECT * FROM doc_generate");
$reqdoc->execute();
$datadoc= $reqdoc->fetchAll(PDO::FETCH_ASSOC);
//var_dump($datadoc);




$time=time();
switch($_POST['doc_id']){
//var_dump($datas);
    case 1:

        // attest de domiciliation
    //recuparation du fichier a transformer en PDF 
    $file= file_get_contents("../pdf/matrice/attest_dom.html");

    // configuration du remplissage du PDF
    $file= str_replace("{{{RAISON_SOCIALE}}}",strtoupper($datas['societe_name']),$file);
    $file= str_replace("{{{Adresse_si&egrave;ge_social}}}",$datas['societe_address'],$file);
    $file= str_replace("{{{Code_SS}}}",$datas['societe_zip_code'],$file);
    $file= str_replace("{{{Commune_SS}}}",ucfirst($datas['societe_city']),$file);
    $file= str_replace("{{{Ville_RCS}}}",ucfirst($datas['rcs_city']),$file);
    $file= str_replace("{{{Immatriculation}}}",$datas['societe_immat'],$file);
    $file= str_replace("{{{Activit&eacute;}}}",$datas['societe_activity'],$file);
    $file= str_replace("{{{Civilit&eacute;}}}",$datas['customer_civility'],$file);
    $file= str_replace("{{{Nom_du_G&eacute;rant}}}",$datas['customer_fullname'],$file);
    $file= str_replace("{{{Pr&eacute;nom_du_G&eacute;rant}}}",$datas['customer_firstname'],$file);
    $file= str_replace("{{{Adresse}}}",$datas['customer_address'],$file);
    $file= str_replace("{{{Commune}}}",ucfirst($datas['customer_city']),$file);
    $file= str_replace("{{{CODE}}}",$datas['customer_zip_code'],$file);
    $file= str_replace("{{{Date}}}",DateFormat(date("Y-m-d H:i:s")),$file);
    // on genere le PDF
    $mpdf = new Mpdf\Mpdf( [' mode'=> 'utf8', 
    'format'=> 'A4',
    'margin_left' => 15,
    'margin_right' => 15,
    'margin_top' => 30,
    'margin_bottom' => 30,
    'margin_header' => 3,
    'margin_footer' => 3,]);
    
    $mpdf->SetHTMLHeader('<p><img src="'.$logo.'" style="max-width:4.5cm; position:fixed-top-left; margin-top: 10px; margin-left: -50px;"></p>','O');
         $mpdf->SetHTMLFooter('<table width="100%" style="border-top:2.5px solid #759672">
                                <tr >
                                    <td width="20%" style=" font-size:0.2em;"><barcode size="0.8" code="'.sprintf('%011d',$time).'" type="UPCA"   class="barcode" /></td>
                                    <td width="60%" align="center" style="font-size:0.8em;text-align:center; color:#759672; padding-top: 10px">'.$nameboite.'</td>
                                    <td width="20%" style="text-align: right; font-size:0.8em;">{PAGENO}/{nbpg}</td>
                                </tr>
                                </table>');

    $mpdf->WriteHTML($file);
    
    $mpdf->Output("../upload/".$_POST['societe_ref_prosp']."/attest-dom".$_POST['societe_ref_prosp']."_".$time.".pdf",\Mpdf\Output\Destination::FILE);
    $mpdf->Output("../upload/".$_POST['societe_ref_prosp']."/attest-dom".$_POST['societe_ref_prosp']."_".$time.".pdf",\Mpdf\Output\Destination::DOWNLOAD);
    $name="attest-dom".$_POST['societe_ref_prosp']."_".$time.".pdf";
    $req=$bdd->prepare("INSERT INTO upload(societe_ref_prosp,upload_doc_name,upload_doctype_id) VALUES (?,?,?)");
    $req->execute(array($_POST['societe_ref_prosp'],$name,17));
    
    break;


case 2:

        /// atest no condamnation
    //appel du document
    $file=file_get_contents("../pdf/matrice/attest_non_condamnation2.html");

    //modif du document pour le remplir
    $file= str_replace("{{{Nom_du_G&eacute;rant}}}",ucfirst($datas['customer_fullname']),$file);
    $file= str_replace("{{{Pr&eacute;nom_du_G&eacute;rant}}}",ucfirst($datas['customer_firstname']),$file);
    $file=str_replace("{{{Date_de_naissance}}}",DateFormat($datas['customer_birthday']),$file);
    $file=str_replace("{{{Lieu_de_naissance_}}}",strtoupper($datas['customer_place_of_birth']),$file);
    $file= str_replace("{{{Adresse}}}",$datas['customer_address'],$file);
    $file= str_replace("{{{Commune}}}",ucfirst($datas['customer_city']),$file);
    $file= str_replace("{{{CODE}}}",$datas['customer_zip_code'],$file);
    
    $mpdf= new Mpdf\Mpdf();
    $mpdf->WriteHTML($file);
    $mpdf->Output("attest-no-cond".$_POST['societe_ref_prosp']."_".$time.".pdf",\Mpdf\Output\Destination::DOWNLOAD);
break;


case 3:

    $req=$bdd->prepare("SELECT * FROM customer LEFT JOIN associates ON (associates.customer_id=customer.customer_id) WHERE customer.societe_ref_prosp=? GROUP BY customer.customer_id ");
    $req->execute(array($_POST['societe_ref_prosp']));
    $loc=$req->fetchAll(PDO::FETCH_ASSOC);
     $req0=$bdd->prepare("SELECT * FROM customer LEFT JOIN associates on customer.customer_id= associates.customer_id WHERE customer.customer_id=?");
     $req0->execute(array($_POST['customer_id']));
     $assos=$req0->fetch();
    // var_dump($assos);
     //die();
        $req1=$bdd->prepare("SELECT * FROM societe WHERE societe_ref_prosp = ?");
    $req1->execute(array($_POST['societe_ref_prosp']));
    $soc=$req1->fetch();
    $nbass=count($loc);
    //var_dump($nbass);
    //die();
    $mpdf=new Mpdf\Mpdf([' mode'=> 'utf8', 
    'format'=> 'A4',
    'margin_left' => 15,
    'margin_right' => 15,
    'margin_top' => 30,
    'margin_bottom' => 30,
    'margin_header' => 3,
    'margin_footer' => 3,]);
    $capital= $soc['capital'];
    $pact= $soc['action_price'];
    
    $file=file_get_contents("../pdf/matrice/lettre_info.html");
    $file=str_replace("{{{RAISON_SOCIALE}}}",strtoupper($soc['societe_name']),$file);
    $file=str_replace("{{{Capital}}}",strtoupper($capital),$file);
    $file=str_replace("{{{Adresse_si&egrave;ge_social}}}",$soc['societe_address']." ".$soc['societe_zip_code']." ".strtoupper($soc['societe_city']),$file);
    $file=str_replace("{{{Civilit&eacute;}}}",strtoupper($assos['customer_civility']),$file);
    $file=str_replace("{{{Nom_ass}}}",strtoupper($assos['customer_fullname']),$file);
    $file=str_replace("{{{Pr&eacute;nom_ass}}}",strtoupper($assos['customer_firstname']),$file);
    $file=str_replace("{{{montant}}}",($assos['associate_nb_action']*$pact),$file);
    $file=str_replace("{{{Nom_du_G&eacute;rant}}}",($loc[0]['customer_fullname']),$file);
    $file=str_replace("{{{Pr&eacute;nom_du_G&eacute;rant}}}",($loc[0]['customer_firstname']),$file);
    $file=str_replace("{{{Epoux non associ&eacute; }}}",ucfirst($_POST['epname'])." ".ucfirst($_POST['epfname']),$file);
    $file=str_replace("{{{Adresse}}}",$assos['customer_address']." ".$assos["customer_zip_code"]." ".ucfirst($assos['customer_city']),$file);
    $file=str_replace("{{{Date_}}}",DateFormat(date("Y-m-d H:i:s")),$file);
    $file=str_replace("{{{sign_date}}}",DateFormat($soc['sign_date']),$file);
    
    
    $mpdf->WriteHTML($file);
    //echo ($file[$i]);
    //die();
    
    $mpdf->Output("../upload/".$_POST['societe_ref_prosp']."/lettre_info".$_POST['societe_ref_prosp']."_".$time.".pdf",\Mpdf\Output\Destination::FILE);
            $mpdf->Output("../upload/".$_POST['societe_ref_prosp']."/lettre_info".$_POST['societe_ref_prosp']."_".$time.".pdf",\Mpdf\Output\Destination::DOWNLOAD);
            $name="lettre_info".$_POST['societe_ref_prosp']."_".$time.".pdf";
            $req=$bdd->prepare("INSERT INTO upload(societe_ref_prosp,upload_doc_name,upload_doctype_id) VALUES (?,?,?)");
            $req->execute(array($_POST['societe_ref_prosp'],$name,17));
    
    
    
    
    break;

case 4:
        //lettre de souscription
        $req=$bdd->prepare("SELECT * FROM customer LEFT JOIN associates ON (associates.customer_id = customer.customer_id)  LEFT JOIN societe on (societe.societe_ref_prosp=customer.societe_ref_prosp) WHERE customer.societe_ref_prosp=? GROUP BY customer.customer_id order by customer.customer_id ");
        $req->execute(array($_POST['societe_ref_prosp']));
        $assos=$req->fetchAll(PDO::FETCH_ASSOC);
    
        $file='<body>
    
        <p style="margin-top:15pt; margin-bottom:11.25pt; text-align:center; line-height:19.5pt">
            <strong><u><span style="font-family:Arial; font-size:16pt; ">Liste de souscripteurs
                        d’actions</span></u></strong>
        </p>
        <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:10pt">
            <strong><span style="font-family:Arial; color:#181818">&#xa0;</span></strong>
        </p>
        <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:10pt">
            <strong><span style="font-family:Arial; color:#181818"> '.$assos[0]['societe_name'].'</span></strong><strong><span
                    style="font-family:Arial; color:#181818">, </span></strong><span
                style="font-family:Arial; color:#181818">Société au capital social de
            </span><strong><span style="font-family:Arial; color:#181818">'.$assos[0]['capital'].'</span></strong><span
                style="font-family:Arial; color:#181818"> euros</span><br><span
                style="font-family:Arial; color:#181818">Société en cours de constitution</span><span
                style="font-family:Arial; color:#181818"> </span><strong><span
                    style="font-family:Arial; color:#181818">'.$assos[0]['societe_address'].' '.$assos[0]['societe_zip_code'].' '.strtoupper($assos[0]['societe_city']).'</span></strong></p>
        <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:10pt">
            <strong><span style="font-family:Arial; color:#181818">&#xa0;</span></strong>
        </p>
        <p style="margin-top:0pt; margin-bottom:7.5pt; text-align:center; font-size:11pt">
            <strong><span style="font-family:Arial; color:#181818">&#xa0;</span></strong>
        </p>
        <p style="margin-top:0pt; margin-bottom:7.5pt; text-align:center; font-size:11pt">
            <strong><span style="font-family:Arial; color:#181818">Etat des souscriptions et des versements</span></strong>
        </p><table cellspacing="0" cellpadding="0" style="width:100%; border:0.75pt solid #000000; border-collapse:collapse">
        <tr style="height:20.15pt">
            <td
                style="width:176.5pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding:5.62pt 7.12pt 5.62pt 3.38pt; vertical-align:middle; background-color:#475e80">
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:10pt">
                    <strong><span style="font-family:Arial; color:#ffffff">Noms, prénoms et adresse des
                            souscripteurs</span></strong>
                </p>
            </td>
            <td
                style="width:77.55pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding:5.62pt 7.12pt 5.62pt 3.38pt; vertical-align:middle; background-color:#475e80">
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:10pt">
                    <strong><span style="font-family:Arial; color:#ffffff">Nombre d’actions souscrites</span></strong>
                </p>
            </td>
            <td
                style="width:77.55pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding:5.62pt 7.12pt 5.62pt 3.38pt; vertical-align:middle; background-color:#475e80">
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:10pt">
                    <strong><span style="font-family:Arial; color:#ffffff">Prix unitaire des actions</span></strong>
                </p>
            </td>
            <td
                style="width:77.55pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding:5.62pt 7.12pt 5.62pt 3.38pt; vertical-align:middle; background-color:#475e80">
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:10pt">
                    <strong><span style="font-family:Arial; color:#ffffff">Montant des versements</span></strong>
                </p>
            </td>
        </tr>';    
        
     
        
        $mpdf=new Mpdf\Mpdf([' mode'=> 'utf8', 
        'format'=> 'A4',
        'margin_left' => 15,
        'margin_right' => 15,
        'margin_top' => 30,
        'margin_bottom' => 30,
        'margin_header' => 3,
        'margin_footer' => 3,]);
    
        $mpdf->WriteHTML($file);
        $captot=0;
        foreach($assos as $asso){
    
            $captot+=($asso['associate_nb_action'])*($asso['action_price']);
            $array.='<tr style="height:10.4pt">
            <td
                style="width:176.5pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding:5.62pt 7.12pt 5.62pt 3.38pt; vertical-align:middle">
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:10pt">
                    <span style="font-family:Arial; color:#181818">'.$asso['customer_fullname'].'</span><span
                        style="font-family:Arial; color:#181818"> </span><span
                        style="font-family:Arial; color:#181818">'.$asso['customer_firstname'].'</span>
                </p>
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:10pt">
                    <span style="font-family:Arial; color:#181818">'.$asso['customer_address'].'</span><span
                        style="font-family:Arial; color:#181818">, </span><span
                        style="font-family:Arial; color:#181818">'.$asso['customer_zip_code'].'</span><span
                        style="font-family:Arial; color:#181818"> </span><span
                        style="font-family:Arial; color:#181818">'.$asso['customer_city'].'</span>
                </p>
            </td>
            <td
                style="width:77.55pt; border-style:solid; border-width:0.75pt; padding:5.62pt 7.12pt 5.62pt 3.38pt; vertical-align:middle">
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:10pt">
                    <span style="font-family:Arial; color:#181818">'.$asso['associate_nb_action'].'</span>
                </p>
            </td>
            <td
                style="width:77.55pt; border-style:solid; border-width:0.75pt; padding:5.62pt 7.12pt 5.62pt 3.38pt; vertical-align:middle">
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:10pt">
                    <span style="font-family:Arial; color:#181818">'.$asso['action_price'].'</span><span
                        style="font-family:Arial; color:#181818"> euros</span>
                </p>
            </td>
            <td
                style="width:77.55pt; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding:5.62pt 7.12pt 5.62pt 3.38pt; vertical-align:middle">
                <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:10pt">
                    <span style="font-family:Arial; color:#181818">'.($asso['associate_nb_action'])*($asso['action_price']).'</span><span
                        style="font-family:Arial; color:#181818"> </span><span
                        style="font-family:Arial; color:#181818">euros</span>
                </p>
            </td>
        </tr>';
    }
    
    $array.='	
    <tr style="height:9.7pt">
        <td
            style="width:176.5pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; padding:5.62pt 7.12pt 5.62pt 3.38pt; vertical-align:middle">
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:10pt">
                <strong><span style="font-family:Arial; color:#181818">TOTAL</span></strong>
            </p>
        </td>
        <td
            style="width:77.55pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding:5.62pt 7.12pt 5.62pt 3.38pt; vertical-align:middle">
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:10pt">
                <span style="font-family:Arial; color:#181818">&#xa0;</span>
            </p>
        </td>
        <td
            style="width:77.55pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding:5.62pt 7.12pt 5.62pt 3.38pt; vertical-align:middle">
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:10pt">
                <span style="font-family:Arial; color:#181818">&#xa0;</span>
            </p>
        </td>
        <td
            style="width:77.55pt; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding:5.62pt 7.12pt 5.62pt 3.38pt; vertical-align:middle">
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:10pt">
                <strong><span style="font-family:Arial; color:#181818">'.$captot.'</span></strong><strong><span
                        style="font-family:Arial; color:#181818"> euros</span></strong>
            </p>
        </td>
    </tr>
    </table>';
    $array.='<p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:10pt">
    <span style="font-family:Arial; color:#181818">&#xa0;</span>
    </p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:10pt">
    <span style="font-family:Arial; color:#181818">Le présent état qui constate la souscription de</span><span
        style="font-family:Arial; color:#181818">&#xa0;</span><span
        style="font-family:Arial; color:#181818">'.$assos[0]['number_action'].'</span><span style="font-family:Arial; color:#181818"> actions
        de la société</span><span style="font-family:Arial; color:#181818">&#xa0;</span><span
        style="font-family:Arial; color:#181818">'.$assos[0]['societe_name'].'</span><span
        style="font-family:Arial; color:#181818">, ainsi que le versement de la somme de</span><span
        style="font-family:Arial; color:#181818">&#xa0;</span><span style="font-family:Arial; color:#181818">'.$assos[0]['capital'].'</span><span style="font-family:Arial; color:#181818">&#xa0;</span><span
        style="font-family:Arial; color:#181818">euros correspondant à la totalité du nominal desdites actions, est
        certifié exact, sincère et véritable par</span><span
        style="font-family:Arial; color:#181818">&#xa0;</span><span
        style="font-family:Arial; color:#181818">'.$assos[0]['customer_firstname'].'</span><span
        style="font-family:Arial; color:#181818"> </span><span
        style="font-family:Arial; color:#181818">'.$assos[0]['customer_fullname'].'</span><span
        style="font-family:Arial; color:#181818">, fondateur.</span>
    </p>
    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt">
    <span style="font-family:Arial; color:#181818">&#xa0;</span>
    </p>
    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt">
    <span style="font-family:Arial; color:#181818">&#xa0;</span>
    </p>
    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt">
    <span style="font-family:Arial; color:#181818">Fait à</span><span
        style="font-family:Arial; color:#181818">&#xa0;</span><span
        style="font-family:Arial; color:#181818">'.$assos[0]['made_place'].'</span><br><span
        style="font-family:Arial; color:#181818">Le</span><span
        style="font-family:Arial; color:#181818">&#xa0;</span><span
        style="font-family:Arial; color:#181818">'.DateFormat(date("Y-m-d H:i:s")).'</span><br><span
        style="font-family:Arial; color:#181818">&#xa0;</span>
    </p>
    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt">
    <em><span style="font-family:Arial; color:#181818">&#xa0;</span></em>
    </p>
    <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt">
    <em><span style="font-family:Arial; color:#181818">(Signature du fondateur)</span></em>
    </p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:10pt">
    <span style="font-family:Arial">&#xa0;</span>
    </p>
    <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt">
    <span style="font-family:Calibri">&#xa0;</span>
    </p>
    
    </body>';
    
      
        $mpdf->WriteHTML($array);
        
        $mpdf->SetHTMLFooter('<table >
                                    <tr >
                                        <td width="20%" style=" font-size:0.2em;"><barcode size="0.8" code="'.sprintf('%011d',$time).'" type="UPCA"   class="barcode" /></td>
                                        <td width="60%" align="center" style="font-size:0.8em;text-align:center; color:#759672; padding-top: 10px"></td>
                                        <td width="20%" style="text-align: right; font-size:0.8em;">{PAGENO}/{nbpg}</td>
                                    </tr>
                                    </table>');
    
        
        $mpdf->Output("../upload/".$_POST['societe_ref_prosp']."/liste_soucript".$_POST['societe_ref_prosp']."_".$time.".pdf",\Mpdf\Output\Destination::FILE);
        $mpdf->Output("../upload/".$_POST['societe_ref_prosp']."/liste_soucript".$_POST['societe_ref_prosp']."_".$time.".pdf",\Mpdf\Output\Destination::DOWNLOAD);
        $name="liste_soucript".$_POST['societe_ref_prosp']."_".$time.".pdf";
        $req=$bdd->prepare("INSERT INTO upload(societe_ref_prosp,upload_doc_name,upload_doctype_id) VALUES (?,?,?)");
        $req->execute(array($_POST['societe_ref_prosp'],$name,17));
    break;

case 5:
        /// modele EURL
         // la requete necessaire pour le document
    $reqloc=$bdd->prepare("SELECT * FROM societe INNER JOIN customer ON(customer.societe_ref_prosp = societe.societe_ref_prosp)   WHERE societe.societe_ref_prosp=?");
    $reqloc->execute(array($_POST['societe_ref_prosp']));
    $loc=$reqloc->fetch();
    //appel du document 
    $file=file_get_contents("../pdf/matrice/modele_EURL.html");

    //modif du document pour le remplir
   
    $file=str_replace("{{{RAISON_SOCIALE}}}",strtoupper($loc['societe_name']),$file);
    $file=str_replace("{{{Adresse_si&egrave;ge_social}}}",$loc['societe_address']." ".$loc['societe_zip_code']." ".strtoupper($loc['societe_city']),$file);
    $file=str_replace("{{{Ville_RCS}}}",strtoupper($loc['rcs_city']),$file);
    $file=str_replace("{{{Immatriculation}}}",$loc['societe_immat'],$file);
    $file=str_replace("{{{Activit&eacute;e}}}",ucfirst($loc['societe_activity']),$file);
    $file=str_replace("{{{Nom_du_G&eacute;rant}}}",ucfirst($loc['customer_fullname']),$file);
    $file=str_replace("{{{Pr&eacute;nom_du_G&eacute;rant}}}",ucfirst($loc['customer_firstname']),$file);
    $file=str_replace("{{{Adresse}}}",$loc['customer_address'],$file);
    $file=str_replace("{{{Commune}}}",strtoupper($loc['customer_city']),$file);
    $file=str_replace("{{{CODE}}}",$loc['customer_zip_code'],$file);
    $file=str_replace("{{{R&eacute;f_local}}}",$loc['ref_int_local'],$file);
    $file=str_replace("{{{Superficie}}}",intval($loc['supercifie']),$file);
    $file=str_replace("{{{Surface_pond&eacute;r&eacute;e}}}",$loc['surface_weighted'],$file);
    $file=str_replace("{{{Etage}}}",$loc['position_id'],$file);
    $file=str_replace("{{{Nbr_place_parking}}}",$loc['number_park_place'],$file);
    $file=str_replace("{{{Date_dentr&eacute;e}}}",DateFormat($loc['date_entrance']),$file);
    $file=str_replace("{{{Date_de_fin}}}",DateFormat($loc['date_end']),$file);
    $file=str_replace("{{{Loyer_mensuel_HT}}}",$loc['mensual_rent_ht'],$file);
    $file=str_replace("{{{LOY_M_en_lettre}}}",$loc['rent_letter'],$file);
    $file=str_replace("{{{TAXE_FONCIERE}}}",$loc['property_tax'],$file);
    $file=str_replace("{{{CHARGES}}}",$loc['charge'],$file);
    $file=str_replace("{{{CUMUL_LOYER}}}",$loc['cumulative_rent'],$file);
    $file=str_replace("{{{Date_}}}",DateFormat(date("Y-m-d H:i:s")),$file);
    // création du pdf
    $mpdf= new Mpdf\Mpdf([' mode'=> 'utf8', 
    'format'=> 'A4',
    'margin_left' => 15,
    'margin_right' => 15,
    'margin_top' => 30,
    'margin_bottom' => 30,
    'margin_header' => 3,
    'margin_footer' => 3,]);
    
    $mpdf->SetHTMLHeader('<p><img src="'.$logo.'" style="max-width:4.5cm; position:fixed-top-left; margin-top: 10px; margin-left: -50px;"></p>','O');
         $mpdf->SetHTMLFooter('<table width="100%" style="border-top:2.5px solid #759672">
                                <tr >
                                    <td width="20%" style=" font-size:0.2em;"><barcode size="0.8" code="'.sprintf('%011d',$time).'" type="UPCA"   class="barcode" /></td>
                                    <td width="60%" align="center" style="font-size:0.8em;text-align:center; color:#759672; padding-top: 10px"></td>
                                    <td width="20%" style="text-align: right; font-size:0.8em;">{PAGENO}/{nbpg}</td>
                                </tr>
                                </table>');
   
    $mpdf->WriteHTML($file);
    

    $mpdf->Output("../upload/".$_POST['societe_ref_prosp']."/bail-derogatoire-24mois".$_POST['societe_ref_prosp']."_".$time.".pdf",\Mpdf\Output\Destination::FILE);
    $mpdf->Output("../upload/".$_POST['societe_ref_prosp']."/bail-derogatoire-24mois".$_POST['societe_ref_prosp']."_".$time.".pdf",\Mpdf\Output\Destination::DOWNLOAD);
    $name="bail-derogatoire-24mois".$_POST['societe_ref_prosp']."_".$time.".pdf";
    $req=$bdd->prepare("INSERT INTO upload(societe_ref_prosp,upload_doc_name,upload_doctype_id) VALUES (?,?,?)");
    $req->execute(array($_POST['societe_ref_prosp'],$name,16));

break;

case 6:
         /// modele SASU
         // la requete necessaire pour le document
         $reqloc=$bdd->prepare("SELECT * FROM societe INNER JOIN customer ON(customer.societe_ref_prosp = societe.societe_ref_prosp) LEFT JOIN local on (local.ref_int_local = societe.ref_int_local) LEFT JOIN lease_term on(lease_term.lease_term_id = societe.lease_term_id)  WHERE societe.societe_ref_prosp=?");
         $reqloc->execute(array($_POST['societe_ref_prosp']));
         $loc=$reqloc->fetch();
         //appel du document 
         $file=file_get_contents("../pdf/matrice/modele_SASU.html");
         
         //remplacement des données
        $file=str_replace("{{{RAISON_SOCIALE}}}",strtoupper($loc['societe_name']),$file);
        $file=str_replace("{{{Adresse_si&egrave;ge_social}}}",$loc['societe_address']." ".$loc['societe_zip_code']." ".strtoupper($loc['societe_city']),$file);
        $file=str_replace("{{{Ville_RCS}}}",strtoupper($loc['rcs_city']),$file);
        $file=str_replace("{{{Immatriculation}}}",$loc['societe_immat'],$file);
        $file=str_replace("{{{Activit&eacute;e}}}",ucfirst($loc['societe_activity']),$file);
        $file=str_replace("{{{Nom_du_G&eacute;rant}}}",ucfirst($loc['customer_fullname']),$file);
        $file=str_replace("{{{Pr&eacute;nom_du_G&eacute;rant}}}",ucfirst($loc['customer_firstname']),$file);
        $file=str_replace("{{{Adresse}}}",$loc['customer_address'],$file);
        $file=str_replace("{{{Commune}}}",strtoupper($loc['customer_city']),$file);
        $file=str_replace("{{{CODE}}}",$loc['customer_zip_code'],$file);
        $file=str_replace("{{{Date_dentr&eacute;e}}}",DateFormat($loc['date_entrance']),$file);
        $file=str_replace("{{{Date_de_fin}}}",DateFormat($loc['date_end']),$file);
        $file=str_replace("{{{R&eacute;f_local}}}",$loc['ref_int_local'],$file);
        $file=str_replace("{{{Superficie}}}",intval($loc['supercifie']),$file);
        $file=str_replace("{{{Surface_pond&eacute;r&eacute;e}}}",$loc['surface_weighted'],$file);
        $file=str_replace("{{{Loyer_mensuel_HT}}}",$loc['mensual_rent_ht'],$file);
        $file=str_replace("{{{Prorata_de_loyer}}}",$loc['prorated_rent'],$file);
        $file=str_replace("{{{Date_}}}",DateFormat(date("Y-m-d H:i:s")),$file);

         $mpdf= new Mpdf\Mpdf(
            [' mode'=> 'utf8', 
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
                                    <td width="20%" style=" font-size:0.2em;"><barcode size="0.8" code="'.sprintf('%011d',$time).'" type="UPCA"   class="barcode" /></td>
                                    <td></td>
                                </tr>
                                </table>');
         //$mpdf->WriteHTML($header);
         $mpdf->WriteHTML($file);
         
    
         $mpdf->Output("../upload/".$_POST['societe_ref_prosp']."/bail".$_POST['societe_ref_prosp']."_".$time.".pdf",\Mpdf\Output\Destination::FILE);
         $mpdf->Output("../upload/".$_POST['societe_ref_prosp']."/bail".$_POST['societe_ref_prosp']."_".$time.".pdf",\Mpdf\Output\Destination::DOWNLOAD);
         $name="bail".$_POST['societe_ref_prosp']."_".$time.".pdf";
         $req=$bdd->prepare("INSERT INTO upload(societe_ref_prosp,upload_doc_name,upload_doctype_id) VALUES (?,?,?)");
         $req->execute(array($_POST['societe_ref_prosp'],$name,16));
break;

case 7:
        

default : 
header("Location:../mise-a-jour-du-dossier-".$datas['societe_ref_prosp']);
}
