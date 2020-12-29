<?php
require '../setting.php';
require_once 'connectbdd.php';
include 'function.php';

//var_dump($_POST);
if (isset($_POST)) {
    session_start();
    $requpload = $bdd->prepare('SELECT * FROM customer LEFT JOIN associates on customer.customer_id= associates.customer_id WHERE customer.societe_ref_prosp=?');
    $requpload->execute(array($_SESSION['auth']['societe_ref_prosp']));
    $dataname = $requpload->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($dataname);
    //die();
    $arraydoc = array();
    if ($_POST['upload_ci'] != null) {
        $upload_ci = insertdoc($_POST['upload_ci'], 1);
        array_push($arraydoc, $upload_ci);
    }
    if ($_POST['upload_just_dom'] != null) {
        $upload_just_dom = insertdoc($_POST['upload_just_dom'], 2);
        array_push($arraydoc, $upload_just_dom);
    }
    if ($_POST['upload_no_cond'] != null) {
        $upload_no_cond = insertdoc($_POST['upload_no_cond'], 3);
        array_push($arraydoc, $upload_no_cond);
    }
    if ($_POST['upload_rb'] != null) {
        $upload_rib = insertdoc($_POST['upload_rb'], 4);
        array_push($arraydoc, $upload_rib);
    }
    if ($_POST['upload_attest_found'] != null) {
        $upload_found = insertdoc($_POST['upload_attest_found'], 15);
        array_push($arraydoc, $upload_found);
    }
    $arrayimp = implode(",", $arraydoc);
    var_dump($arraydoc);
    if ($dataname[0]['cust_status'] == 2) {
        $requpload = $bdd->prepare('UPDATE associates SET associate_doc=?  WHERE customer_id=?');
        $requpload->execute(array(
            $arrayimp,
            $dataname[0]['customer_id']
        ));
    }
}
