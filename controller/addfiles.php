<?php
require 'connectbdd.php';
include 'function.php';
var_dump($_POST);

if (isset($_POST)) {
    if (isset($_FILES['filesAdd'])) {
        //var_dump($_FILES);
        $societe_ref= $_POST['societe_ref_prosp'];
        $extAuthorized = array("pdf", "jpg", "png", "tiff");
        $path = trim('../upload/'.$_POST['societe_ref_prosp'] .'/');

        if ($_POST['doctype_id'] == 5) {
            addFiles("KBIS",$extAuthorized,$path,$_POST['societe_ref_prosp'],$_POST['doctype_id']);
        }
        if ($_POST['doctype_id'] == 6) {
            addFiles("statut_soc",$extAuthorized,$path,$_POST['societe_ref_prosp'],$_POST['doctype_id']);
        }
        if ($_POST['doctype_id'] == 7) {
            addFiles("nomi_diri",$extAuthorized,$path,$_POST['societe_ref_prosp'],$_POST['doctype_id']);
        }
        if ($_POST['doctype_id'] == 8) {
            addFiles("dom",$extAuthorized,$path,$_POST['societe_ref_prosp'],$_POST['doctype_id']);
        }
        if ($_POST['doctype_id'] == 9) {
            addFiles("par_leg",$extAuthorized,$path,$_POST['societe_ref_prosp'],$_POST['doctype_id']);
        }
        if ($_POST['doctype_id'] == 10) {
            addFiles("SEPA",$extAuthorized,$path,$_POST['societe_ref_prosp'],$_POST['doctype_id']);
        }
        if ($_POST['doctype_id'] == 11) {
            addFiles("attest_assu",$extAuthorized,$path,$_POST['societe_ref_prosp'],$_POST['doctype_id']);
        }
        if ($_POST['doctype_id'] == 12) {
            addFiles("procuration",$extAuthorized,$path,$_POST['societe_ref_prosp'],$_POST['doctype_id']);
        }
        if ($_POST['doctype_id'] == 13) {
            addFiles("dec_bene",$extAuthorized,$path,$_POST['societe_ref_prosp'],$_POST['doctype_id']);
        }
        if ($_POST['doctype_id'] == 14) {
            addFiles("Cerfa_crea",$extAuthorized,$path,$_POST['societe_ref_prosp'],$_POST['doctype_id']);

        }
        if ($_POST['doctype_id'] == 16) {
            addFiles("bail",$extAuthorized,$path,$_POST['societe_ref_prosp'],$_POST['doctype_id']);
        }
        if ($_POST['doctype_id'] == 17) {
            addFiles("doc_jurid",$extAuthorized,$path,$_POST['societe_ref_prosp'],$_POST['doctype_id']);
        }
        header("Location:../mise-a-jour-du-dossier-".$societe_ref."");
    } else{
        die();
    }
}
