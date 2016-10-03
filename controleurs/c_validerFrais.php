<?php
 include("vues/vue_sommaire_comptable.php");
$action= $_REQUEST['action'];
switch ($action){
    case 'selectionnerFiche':{
        $lesVisiteurs= $pdo->getLesVisiteurs();
        $lesCles=array_keys($lesVisiteurs);
        include("vues/vue_listeFiche.php");    
	break;	
    }
    
    case 'voirEtatFiche':{//
        $mois = $_REQUEST['mois'];
        $idVisiteur=$_REQUEST["lstVisiteur"];
        $lesVisiteurs = $pdo->getLesVisiteurs();
        conserverId($idVisiteur,$mois);
        $lesVisiteursFiches=$pdo->getLesInfosFicheFrais($idVisiteur,$mois);
       
        if ($mois==" "){
            ajouterErreur("... ");
                include("vues/v_erreurs.php");  
        }
        else if(!is_array( $lesVisiteursFiches )){   
            ajouterErreur("Pas de fiche de frais pour ce visiteur ce mois");
                include("vues/v_erreurs.php");
             
        }
        else{
            $lesInfosFicheFrais=$pdo->getLesInfosFicheFrais($idVisiteur,$mois);
            $dateModif=$lesInfosFicheFrais['dateModif'];
            $libEtat=$lesInfosFicheFrais['libEtat'];
            $montantValide=$lesInfosFicheFrais['montantValide'];
            
        
            $LesFraisForfait=$pdo->getLesFraisForfait($idVisiteur, $mois);
            $LesFraisHorsForfait=$pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        
        
            include("vues/v_etapeDeFiche.php");//vue à créer.
          
        }
            break;
    }
    case 'validerFiche':{
        $idVisiteur = $_SESSION['idVisiteur'];
        $mois = $_SESSION['mois'];
        $lesVisiteurs = $pdo->getLesVisiteurs();
        
        $lesInfosFicheFrais=$pdo->getLesInfosFicheFrais($idVisiteur,$mois);
        $dateModif=$lesInfosFicheFrais['dateModif'];
        $libEtat=$lesInfosFicheFrais['libEtat'];
        $montantValide=$lesInfosFicheFrais['montantValide'];
        
        $LesFraisForfait=$pdo->getLesFraisForfait($idVisiteur, $mois);
        $LesFraisHorsForfait=$pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        
        $pdo->validerFicheFrais($idVisiteur,$mois);//méthode à creer 
        
        
        include("vues/v_etatFrais.php");
       
      
            break;
    }
}
?>