<?php //fichier c_connexion.
    if(!isset($_REQUEST['action']) && $fct->estConnecte() || // établir des actions lorsqu’on recupere le profil de l’utilisateur 
($_REQUEST['action']=='accueilComptable') && $fct->estConnecte() ){
        if($_SESSION['profil']=="Comptable"){
            $_REQUEST['action']= 'accueilComptable';
        }elseif($_SESSION['profil']=="Visiteur") {
            $_REQUEST['action']= 'accueil';
        }
    }
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
                            $fct->ajouterErreur("<strong>Attention !</strong> Login ou mot de passe incorrect","alert-danger","");
                            include("vues/v_connexion.php");
                            include("vues/v_contentErreurs.php");
                    } else {
                            $id = $visiteur['id'];
                            $nom =  $visiteur['nom'];
                            $prenom = $visiteur['prenom'];
                            $profil = $visiteur['profil'];
                            $fct->connecter($id,$nom,$prenom,$profil);
                            $pdo->ajoutConnectionLog($id);//appel de la méthode ajoutConnectionLog qui enregistre les connexions des utilisateurs
                            
                            header('Location: '. URLBASE .'index.php');
                            //header('Location: /index.php');
                    }
                    break;
            }
            case 'accueil' :{
                    header('Location: '. URLBASE . 'index.php?uc=gererProfil&action=monProfil');
                    //header('Location: index.php?uc=gererProfil&action=monProfil');
                    break;
            }
            case 'accueilComptable' :{
                    
                    include("vues/v_sommaire.php");
                    include("vues/v_accueilComptable.php");
                    break;
            }
            case 'deconnexion' : {
                    $fct->deconnecter();
                    header('Location: '. URLBASE . 'index.php');
                    //header('Location: index.php');
                    break;
            }
            default :{
                    include("vues/v_connexion.php");
                    break;
            }
    }
    ?>