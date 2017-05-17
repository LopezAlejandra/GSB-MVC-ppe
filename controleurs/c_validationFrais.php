<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idUtilisateur = $_SESSION['idUtilisateur'];
switch($action){
    
    case "demandeValiderFrais": {
        
        // si la variable "part" existe,$part= $_GET["part"]; sinon $part=1;
        // cela est équivalent à 
        //     if(isset($_GET["part"]){
        //          $part=$_GET["part"];
        //      }else{
        //          $part=1;
        //      }
        $part = isset($_GET['part'])? $_GET['part'] : '1';
        // Recupérer les mois pour les fiches de frais qui n'ont pas encore été validées.
        $liste_mois = $pdo->getLesMoisNonValides();
        // var_dump($liste_mois);
        $aValider = [];//Création d'un tableau
        
        // Parcours de la liste des mois non validés
        foreach($liste_mois as $mois){
            $anneeCourante = substr($mois["mois"], 0, 4);
            $moisCourant = substr($mois["mois"], 4, 2);
            //Si l'année courante n'existe pas dans le tableau "aValider"
            if(!array_key_exists($anneeCourante, $aValider)){
                //alors: annee Courante devient la clé du tableau
                $aValider[$anneeCourante] = [];
            }
            // Si le mois courant n'appartient pas au tableau 
            // $aValider,
            if(!in_array($moisCourant, $aValider[$anneeCourante])){
                // alors:
                // On ajoute le mois au tableau avec la
                // clé $anneeCourant
                $aValider[$anneeCourante][] = $moisCourant;
            }
        }
        // Si part vaut 2
       if($part === "2"){
           // alors: on récupère les visiteurs selon le mois choisi
            $visiteurs = $pdo->getVisiteursParDate($_GET['lstmois']);
            // var_dump($visiteurs);
           }
        // Si la liste de Visiteurs existe,
        if(isset($_GET['lstvisiteurs'])){
            //alors:
            $afficherFiche = true;// Afficher fiche =vrai
            // On récupère les informations de la fiche du visiteur
            $LesInfoFicheFrais= $pdo->getLesInfosFicheFrais($_GET['lstvisiteurs'],$_GET['lstmois']);
            // On initialise les variables :
            $libelleEtat= $LesInfoFicheFrais['libEtat'];
            $montantValide=$LesInfoFicheFrais['montantValide'];
            $dateModif=$LesInfoFicheFrais['dateModif'];
            //Initialisation du tableau associatif "fiche" qui a comme clé une chaîne de caractères
            // On attribue les fiches de frais retournées par
            // la méthode "getLesFraisForfaits" du visiteur et du mois choisi précédemment
            $fiche["forfait"] = $pdo->getLesFraisForfait($_GET['lstvisiteurs'], $_GET['lstmois']);
            // Le tableau fiche avec la clé "horsForfait" concerne les fiches de frais retournées par
            // la méthode "getLesFraisForfaits" du visiteur et du mois choisi précédemment
            $fiche["horsForfait"] = $pdo->getLesFraisHorsForfait($_GET['lstvisiteurs'], $_GET['lstmois']);
                       
        }
        include("vues/v_listeMoisComptable.php");
        break;
    }
     case "validerFicheFrais": {
        $pdo->validerFicheFrais($_POST['idvisiteur'], $_POST['mois']);
        setFlash("La fiche a bien été validée");
        header('location:index.php?uc=validationFrais&action=demandeValiderFrais');
        break;
    }

    case "actualiserFrais": {
        $pdo->majFraisForfait($_POST['idvisiteur'], $_POST['mois'], $_POST['frais']);
        // Affichage du message "informations actualisées" dans la vue précédente
        setFlash("Informations actualisées"); 
        header("location:index.php?uc=validationFrais&action=demandeValiderFrais&part=2&lstmois={$_POST['mois']}&lstvisiteurs={$_POST['idvisiteur']}");
        break;
    }

    case "supprimerFrais": {
        $pdo->majFraisHorsForfait($_POST['idfrais']);
        setFlash("Informations actualisées");
        header("location:index.php?uc=validationFrais&action=demandeValiderFrais&part=2&lstmois={$_POST['lstmois']}&lstvisiteurs={$_POST['lstvisiteurs']}");
        break;
    }

    case "reporterFrais": {
        $mois = $_POST['lstmois'];
        $visiteur = $_POST['lstvisiteurs'];
        $idFrais = $_POST['idfrais'];
        $libelle = $_POST['libelle'];
        $montant = $_POST['montant'];
        $pdo->reporterHorsForfait($idFrais, $visiteur, $mois, $libelle, $montant);
        header("location:index.php?uc=validationFrais&action=demandeValiderFrais&part=2&lstmois=$mois&lstvisiteurs=$visiteur");
        break;
    }

   
   
}