

<!--affichage du détail de la fiche de frais de ce 
visiteur pour ce mois (avec les frais forfaits 
et les frais hors forfait). -->

 <form action="index.php?uc=validerFrais&action=validerFiche" method="post">
     <label>Fiche de Frais du <?php echo $mois;?> </label>  
    <br/> État : <?php echo $libEtat?> depuis le <?php echo $dateModif ?>, 
    montant validé : <?php echo $montantValide ?> €.<br/><br/> <!--état de fiche avant d'être validée-->
        <input class="button" type="submit" value="Valider Fiche" /> <!--Valide la fiche-->
 </form>
                    