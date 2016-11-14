<?php
require_once("include/fct.inc.php");
require_once("include/class.pdogsb.inc.php");
include("vues/v_entete.php");
session_start();

$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
if(!isset($_REQUEST['uc']) || !$estConnecte){
    $_REQUEST['uc'] = 'connexion';
}
$uc = $_REQUEST['uc'];
switch ($uc){
    case 'connexion':{
        include("controleurs/c_connexion.php");
            break;
    }
    case 'etatFrais':{
        include("controleurs/c_etatFrais.php");
            break;
    }
    case 'gererFrais':{
        include("controleurs/c_gererFrais.php");
            break;
    }
    //Mission1 :
    case 'validationFrais':{
        include("controleurs/c_validerFrais.php");
            break;
    }
    //Mission2 Travail no1: 
    case 'suiviPaiement':{
        include("controleurs/c_suivi_paiement.php");
        break;
    }
    //Mission2 Travail no 2:
    case 'generatePdf':{
        $idVisiteur=$_REQUEST['idVisiteur'];
        $leMois=$_REQUEST['leMois'];
        include("vues/v_pdf_EtatFrais.php");
        break;
    }
}
include("vues/v_pied.php");
?>
