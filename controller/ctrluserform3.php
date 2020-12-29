<?php
session_start();
//var_dump($_POST);.
require '../setting.php';
require_once 'connectbdd.php';

//var_dump($_SESSION);
if(isset($_POST)){
    
    $reqUpdateSociete=$bdd->prepare('UPDATE societe SET societe_form = :societe_form ,societe_name = :societe_name, societe_activity = :societe_activity , number_action = :number_action  , action_price = :action_price , capital = :capital , social_denomination = :social_denomination, commercial_name = :commercial_name WHERE societe_ref_prosp = :societe_ref_prosp');
    $reqUpdateSociete->execute(array(

        "societe_form"=> htmlspecialchars($_POST['societe_form']),
        'societe_name'=> htmlspecialchars($_POST['societe_name']),
        "societe_activity"=>htmlspecialchars($_POST['societe_activity']),
        'number_action'=>intval($_POST['number_action']),
        'action_price'=>intval($_POST['action_price']),
        "capital"=>intval($_POST['capital']),
        "social_denomination"=>htmlspecialchars($_POST['social_denomination']), 
        'commercial_name'=>htmlspecialchars($_POST['commercial_name']),
        'societe_ref_prosp'=>$_SESSION['auth']['societe_ref_prosp'],
        
    
    ));
    //var_dump($reqUpdateSociete);

    if($_POST['societe_form'] == 'sarl' || $_POST['societe_form'] == 'sas'){
    $requpdatedir=$bdd->prepare('UPDATE associates SET associate_nb_action= :associate_nb_action, associate_participation = :associate_participation WHERE societe_ref_prosp = :societe_ref_prosp AND customer_id= :customer_id');
    $requpdatedir->execute(array(
        'associate_nb_action'=> $_POST['associate_nb_action'],
        'associate_participation'=>floatval($_POST['associate_participation']),
        'societe_ref_prosp'=>$_SESSION['auth']['societe_ref_prosp'],
        'customer_id'=> $_POST['customer_id']

    ));
        header('Location: ../ajouter-un-associe');
    }
    else
    {
        header('Location: ../summary.php');
    }

}
