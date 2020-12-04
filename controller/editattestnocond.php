<?php
require_once  __DIR__.'../../vendor/autoload.php';

//var_dump($_POST);
$nbAttest=$_POST['nb_attest'];
if(isset($_POST)){
    $file=file_get_contents("../pdf/matrice/attest_non_condamnation2.html");
    $mpdf= new Mpdf\Mpdf();
    $mpdf->WriteHTML($file);
    $mpdf->Output("attest-no-cond.pdf",\Mpdf\Output\Destination::DOWNLOAD);
    header("Location:../accueil");
}



