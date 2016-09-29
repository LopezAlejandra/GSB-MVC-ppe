<?php //fichier c_connexion.
 
    if(!isset($_REQUEST['action']) || $_REQUEST['action']!='valideConnexion' && !$fct->estConnecte()){
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
                    $visiteur = $pdo->getInfosVisiteur($login,$mdp);
                    if(!is_array( $visiteur)){
                            ajouterErreur(" Login ou mot de passe incorrect");
                            include("vues/v_connexion.php");
                            include("vues/v_contentErreurs.php");
                    } else {
                            $id = $visiteur['id'];
                            $nom =  $visiteur['nom'];
                            $prenom = $visiteur['prenom'];
                            $profil = $visiteur['profil'];
                           $fct->connecter($id,$nom,$prenom,$profil);
                          
                               //Si l'utilisateur est un comptable, le systême affichera le 
                    //sommaire dédié à ce dernier afin de lui permettre le suivi 
                    //et la validation d'une fiche de frais. 
                    //Si l'utilisateur est un visiteur, le sommaire lui permmettra 
                    //la saisi et le suivi d'une fiche de frais
                    if($profil=='comptable'){
                        include("vues/vue_sommaire_comptable.php");
                    }
                    else{
                        include("vues/v_sommaire.php");
                    } 
                }
                break;
        }
                
	default :{
		include("vue/v_connexion.php");
		break;
	}
}
?>
                    
                   