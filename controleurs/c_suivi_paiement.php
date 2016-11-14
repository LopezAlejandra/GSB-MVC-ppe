<?php
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];
switch($action){
    case 'recupFichesValidees':
        //On recupère les fiches qui ont comme idEtat ="VA".
       $fichesfraisValidees=$pdo->getFichesFraisValidees();
        // Si une demande de suivi de fiche a été selectionné 
        if(isset($_GET['suivi_fiches'])){
            // explode()--retourne un tableau de chaînes, chacune d'elle étant une 
            // sous-chaîne du paramètre string extraite en utilisant le séparateur delimiter('-')
            $infoFiche=explode('-',$_GET['suivi_fiches']);
            
            //infoFiche[0]=mois //infoFiche[1]=idVisiteur
            if(isset($infoFiche[0])&& isset($infoFiche[1])){
            $fiche['forfait']=$pdo->getLesFraisForfaits();//fonction qui retourne tous les champs des lignes de frais forfait sous la forme d'un tableau associatif
            $fiche['horsforfait']=$pdo->getLesFraisHorsForfaits($infoFiche[1],$infoFiche[0]);//fonction qui retourne tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif
              }
        }
       include("vues/v_suiviPaiement.php");
       break; 
    
    case 'mettreEnPaiement':
        $pdo->mettreEnPaiement($_POST['idVisiteur'],$_POST['mois']); //on appélle la méthode mettreEnPaiement sur l'objet pdo pour modifier l'etat de la fiche de frais
        echo "L'état de la fiche est: Mise en paiement";
        header('location:index.php?uc=suiviPaiement&action=recupFichesValidees'); 
        break;
}
?>