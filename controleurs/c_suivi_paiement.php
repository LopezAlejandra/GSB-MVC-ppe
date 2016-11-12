<?php
$action = $_REQUEST['action'];
$idUtilisateur = $_SESSION['idVisiteur'];
switch($action){
    case 'demandeSuiviPaiement':
        $fichesfraisValidees=$pdo->getFichesFraisValidees();
       include("vues/v_suiviPaiement.php");//Fichier à créer
    break;
    }
?>