<?php
$action = $_REQUEST['action'];
switch ($action){
    case 'selectionnerFiche':{
        
        include("vues/vue_listeFiche.php");
        echo '</div>';
        include("vues/vue_sommaire_comptable.php");
            break;
    }
   
    case 'validerFrais':{
        $idVisiteur = $_SESSION['idVisiteur'];
        $mois = $_SESSION['mois'];
        $lesVisiteurs=$pdo->getLesVisiteurs();
        $InfosFicheFrais=$pdo->getLesInfosFicheFrais($idVisiteur,$mois);
        $dateModif=$InfosFicheFrais['dateModif'];
        $libEtat=$InfosFicheFrais['libEtat'];
        $montant=$InfosFicheFrais['montantValide'];
        
        $FraisForfait=$pdo->getLesFraisForfait($idVisiteur, $mois);
        $FraisHorsForfait=$pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        
        $pdo->validerFicheFrais($idVisiteur,$mois);
        
        include("vues/vue_listeFiche.php");
        include("vues/vue_etapeFiche.php");
        include("vues/vue_sommaire_comptable.php");
            break;
    }
   }
  ?>
    
