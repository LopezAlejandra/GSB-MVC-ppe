<?php
/**
 * Connexion d'un visiteur après vérification de son login et son mot de passe
 * 
 * Variables : $login, $mdp et $type 
 */
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch($action){
	case 'demandeConnexion':{
		include("vues/v_connexion.php");
		break;
	}
	case 'valideConnexion':{
            
		$login = $_REQUEST['login'];
                
		$mdp = $_REQUEST['mdp'];
                
                
                
              
                
		$utilisateur = $pdo->getInfosVisiteur($login,$mdp);
                
		if(!is_array($utilisateur)){
			ajouterErreur("Login ou mot de passe incorrect");
			include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}
		else{
                    
			$id = $utilisateur['id'];
			$nom =  $utilisateur['nom'];
			$prenom = $utilisateur['prenom'];
                        $type = $utilisateur['profil'];
			connecter($id,$nom,$prenom, $type);
                        include("vues/v_sommaire.php");
                        if($type === "Comptable"){
                            header('location:index.php?uc=validationFrais&action=demandeValiderFrais');
                            die();
                        }
		}
		break;
	}
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>