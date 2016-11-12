<?php 
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
            // l'application compare le login et le mot de passe saisis avec 
            // les données login, mdp de la table visiteur dans la bdd pour vérifier si 
            //l'utilisateur existe dans la base de données.
                $login = $_REQUEST['login'];
                $mdp = $_REQUEST['mdp'];
                $utilisateur= $pdo->getInfosVisiteur($login, $mdp);
                if(!is_array($utilisateur)){
                    
                    ajouterErreur("Login ou mot de passe incorrect");//Un message d'erreur s'affiche lorsque le login ou mdp est inconu
                    include("vues/v_erreurs.php");
                    include("vues/v_connexion.php");
                }
                else{
                 
                    $id = $utilisateur['id'];
                    $nom =  $utilisateur['nom'];
                    $prenom = $utilisateur['prenom'];
                    $profil = $utilisateur['profil'];
                    connecter($id,$nom,$prenom,$profil);
                    include("vues/v_sommaire.php");
      
                    if($profil=='Comptable'){// Si l'utilisateur est un comptable, le programme 
                    //                       //affichera un sommaire qui concerne seulement les comptables
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