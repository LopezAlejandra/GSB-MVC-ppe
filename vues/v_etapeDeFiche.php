

<!--affichage du détail de la fiche de frais de ce 
visiteur pour ce mois (avec les frais forfaits 
et les frais hors forfait). -->

<label>Fiche de Frais du <?php echo $mois;?> </label>  
 <form action="index.php?uc=validerFrais&action=validerFiche" method="post">
    <br/> État : <?php echo $libEtat?> depuis le <?php echo $dateModif ?>, 
    montant validé : <?php echo $montant ?> €.<br/><br/> <!--état de fiche avant d'être validée-->
        <input class="button" type="submit" value="Valider Fiche" /> <!--Valide la fiche-->
 </form>
 <table>
  <caption>Frais Forfaits </caption>
    <tr>
        <!--Retourne sous forme d'un tableau associatif toutes les quantités par type de Frais(idFrais) -->
        <?php
        foreach($LesFraisForfait as $unFraisForfait)
        //LesFraisForfait(appele la méthode getLesFraisForfait de c_validerFrais.php dans case=voirEtatFiche);
            {
            $idFrais = $unFraisForfait['idfrais'];
            $quantite = $unFraisForfait['quantite'];
        ?>
        <td>
            <input type="text" name="lesFrais[<?php echo $idFrais ?>]" value="<?php echo $quantite ?>"/> <!--Modification possible de frais forfaits-->
        </td>
        <?php
            }
        ?>
 </table> <br />
         <table><caption>Descriptif des éléments hors forfait -<?php //echo $nbJustificatifs ?> justificatifs reçus -
       </caption>
             <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>                
             </tr>
        <?php      
          foreach ( $LesFraisHorsForfait as $unFraisHorsForfait ) 
		  {
			$date = $unFraisHorsForfait['date'];
			$libelle = $unFraisHorsForfait['libelle'];
			$montant = $unFraisHorsForfait['montant'];
		?>
             <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
             </tr>
        <?php 
          }
		?>
    </tr>
 </table>


                    