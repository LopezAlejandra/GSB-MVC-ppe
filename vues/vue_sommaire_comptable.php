    <div id="menuGauche"> 
        <section>
            
            <ul id="menuList">
                <li class="smenu">
                    <h2>Comptable :</h2><br/>
                        <?php echo "Bonjour M/Mme  ".$_SESSION['prenom']."  ".$_SESSION['nom']."<br>"  ?>
                </li>
                
                <li class="smenu"><a href="index.php?uc=validationFrais&action=validationChoisirMois">Valider fiche frais</a></li>
                <li class="smenu"><a href="index.php?uc=suiviPaiement&action=recupFichesValidees">Suivre paiement</a></li>
                <li class="smenu"><a href="index.php?uc=connexion&action=demandeConnexion">Déconnexion</a></li>
            </ul>
        </section>
    </div>