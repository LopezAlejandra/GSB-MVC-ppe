<?php

    include("vues/vue_sommaire_comptable.php");
    $action= $_REQUEST['action'];
    $idVisiteur=$_SESSION['idVisiteur'];
    switch($action){
    
    case "validationChoisirMois": {
        $liste = isset($_GET['liste']) ? $_GET['liste'] : '1';
        $liste_mois = $pdo->getMoisSansValider();
        $choisirMois= [];
        $moisAValider = [];
        foreach($liste_mois as $mois){
            $anneeCourant = substr($mois["mois"], 0, 4);
            $moisCourant = substr($mois["mois"], 4, 2);
            if(!array_key_exists($anneeCourant, $choisirMois)){
                $choisirMois[$anneeCourant] = [];
                var_dump($anneeCourant);
            }
            
            if(!in_array($moisCourant, $choisirMois[$anneeCourant])){
                $choisirMois[$anneeCourant][] = $moisCourant;
            }
            
        }
        if($liste === "2"){
            $visiteurs = $pdo->lesVisiteursParDate($_GET['lstmois']);
        }
        if(isset($_GET['lstvisiteurs'])){
            $afficherFiche = true;
            $laficheforfait["forfait"] = $pdo->getLesFraisForfait($_GET['lstvisiteurs'], $_GET['lstmois']);
            $lafichehorsforfait["horsForfait"] = $pdo->getLesFraisHorsForfait($_GET['lstvisiteurs'], $_GET['lstmois']);
            
            
        }
        
        include("vues/v_listeMoisComptable.php");
        break;
    }
    case "voirFrais":{
        var_dump($_POST);
       break;
    }
    
    case "validerFicheFrais": {
        $pdo->validerFicheFrais($_POST['idVisiteur'], $_POST['mois']);
        header('location:index.php?uc=validationFrais&action=demandeValiderFrais');
        echo "La fiche a été validé";
        break;
    }

}