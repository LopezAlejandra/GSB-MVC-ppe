<?php

    include("vues/vue_sommaire_comptable.php");
    $action= $_REQUEST['action'];
    $idVisiteur=$_SESSION['idVisiteur'];
    switch($action){
    
    case "demandeValiderFrais": {
        $part = isset($_GET['part']) ? $_GET['part'] : '1';
        $liste_mois = $pdo->getMoisSansValider();
        $aValider = [];
        $moisAValider = [];
        foreach($liste_mois as $mois){
            $anneeCourant = substr($mois["mois"], 0, 4);
            $moisCourant = substr($mois["mois"], 4, 2);
            if(!array_key_exists($anneeCourant, $aValider)){
                $aValider[$anneeCourant] = [];
                var_dump($anneeCourant);
            }
            
            if(!in_array($moisCourant, $aValider[$anneeCourant])){
                $aValider[$anneeCourant][] = $moisCourant;
            }
            
        }
        if($part === "2"){
            $visiteurs = $pdo->lesVisiteursParDate($_GET['lstmois']);
        }
        if(isset($_GET['lstvisiteurs'])){
            $afficherFiche = true;
            $fiche["forfait"] = $pdo->getLesFraisForfait($_GET['lstvisiteurs'], $_GET['lstmois']);
            $fiche["horsForfait"] = $pdo->getLesFraisHorsForfait($_GET['lstvisiteurs'], $_GET['lstmois']);
        }
        
        include("vues/v_listeMoisComptable.php");
        break;
    }
    case "voirFrais":{
        var_dump($_POST);
       break;
    }
    
    case "validerFicheFrais": {
        $pdo->validerFicheFrais($_POST['idvisiteur'], $_POST['mois']);
        setFlash("La fiche a bien été validé");
        header('location:index.php?uc=validationFrais&action=demandeValiderFrais');
        break;
    }

}