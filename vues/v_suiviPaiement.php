<?php include ("vues/vue_sommaire_comptable.php");?>
<h2> Suivi de paiement</h2>
<h2> Liste des fiches de frais</h2>
<form method="GET" action="index.php?uc=suiviPaiement&action=recupFichesValidees">
    <!-->liste déroulante avec les fiches concernées(déjà validées) <!-->
    <select name="suivi_fiches"> 
    <?php  foreach($fichesfraisValidees as $unefiche){?>
    <option value="<?php echo 'Mois:'.$unefiche['mois'].'-'.$unefiche['idVisiteur'] ?>">
                   <?php echo substr($unefiche['mois'],4,2).'--'. $unefiche['nom'].'--'.$unefiche['prenom'];?>
    </option>
    <?php }?>
    </select>
        <input type="submit" value="Envoyer">
</form>
    <!---> Si une demande de suivi de fiche a été selectionné on affiche les frais forfaitaires  <!--->
    <?php if(isset($fiche)){ ?> 
        <h3>Les frais forfaits</h3>
        <table style="width:100%">
            <thead>
            <tr>
                <!-->Colonnes<!-->
                <th>Libellé</th>
                <th>Quantité</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            //Tableau associatif des fiches de frais forfaitaires
            foreach($fiche['forfait'] as $ff){ ?>
                <tr>
                     <!-->Affichage du libellé et du montant<!-->
                    <td><?php echo $ff['libelle']; ?></td> 
                    <td><?php echo $ff['quantite']; ?></td>
                </tr>
      <?php }; //fin foreach?> 
            </tbody>
        </table>



        <h3>Frais hors forfait</h3>
        <table style="width:100%">
            <thead>
                <tr>
                     <!-->Colonnes<!-->
                    <th>Libellé</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                
            <?php
            //Tableau associatif des fiches de frais hors forfait
            foreach($fiche['horsforfait'] as $hf){ ?>
                <tr>
                     <!-->Affichage du libellé et du montant<!-->
                    <td><?php echo $hf['libelle']; ?></td>
                    <td><?php echo $hf['montant']; ?></td>
                </tr>
            <?php }; ?>
            </tbody>
        </table>
         <a href="index.php?uc=suiviPaiement&action=mettreEnPaiement"> <input type="submit" value="Mettre en paiement"></a>  <!-->Bouton mettre en paiement<!-->
       
 <?php }; ?>