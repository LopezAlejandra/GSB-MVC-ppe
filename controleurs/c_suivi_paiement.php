<?php
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];
switch($action){
    case 'recupFichesValidees':
       $fichesfraisValidees=$pdo->getFichesFraisValidees();
       include("vues/v_suiviPaiement.php");//Fichier à créer
       break; 
    
    case 'mettreEnPaiement':
        $pdo->mettreEnPaiement($_POST['visiteur']);
        echo "L'état de la fiche est: Mise en paiement";
        header('location:index.php?uc=suiviPaiement&action=recupFichesValidees'); 
        break;
}
?>