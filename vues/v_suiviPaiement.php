<?php include ("vues/vue_sommaire_comptable.php");?>
<h2> Suivi de paiement</h2>
<form method="GET" action="index.php">
<select name="suivi_fiches">
    <?php  foreach($fichesfraisValidees as $unefiche){?>
    <option value="<?php echo 'Mois:'.$unefiche['mois'].'-'.$unefiche['idVisiteur'] ?>"><?php echo substr($unefiche['mois'],4,2).'--'.
            $unefiche['nom'].'--'.$unefiche['prenom'];?></option>
    <?php }?>
</select>
    <input type="submit" value="Envoyer">
 </form>