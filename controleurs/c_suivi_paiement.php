<?php
$action = $_REQUEST['action'];
$idUtilisateur = $_SESSION['idVisiteur'];
switch($action){
    case 'demandeSuiviPaiement':
        $fichesfraisValidees=$pdo->getFichesFraisValidees();
        
    break;
    }
?>