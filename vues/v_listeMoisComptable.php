 <div id="contenu">
    <h3>Liste des mois des fiches de frais à valider</h3>
    <form method="GET" action="index.php">
        <label for="lstMois">Mois :</label>
        <select name="lstmois" id="lstMois">
        <?php foreach($choisirMois as $annee => $mois){ ?>
            <?php foreach($mois as $lemois){ ?>
            <option value="<?php echo $annee. $lemois ?>" <?php echo (isset($_GET['lstmois']) && $_GET['lstmois'] == $annee . $lemois) ? 'selected': ''; ?>><?php echo $lemois . " / " . $annee; ?></option>
        <?php } ?>
        <?php } ?>
        </select>

        <input type="hidden" name="uc" value="validationFrais">
        <input type="hidden" name="action" value="validationChoisirMois">
        <input type="hidden" name="liste" value="2">
        <?php if($liste === "2"){ ?>
            <label for="lstVisiteurs">Choisissez un visiteur:</label>
            <select name="lstvisiteurs" id="lstVisiteurs">
                <?php foreach($visiteurs as $levisiteur){ ?>
                    <option value="<?php echo $levisiteur->idVisiteur; ?>" <?php echo (isset($_GET['lstvisiteurs']) && $_GET['lstvisiteurs'] === $levisiteur->idVisiteur) ? 'selected' : ''; ?>><?php echo $levisiteur->nom . " " . $levisiteur->prenom; ?></option>
                <?php } ?>
            </select>
        <?php } ?>
        <button type="submit">Valider</button>
    </form>
    
    <?php if(isset($afficherFiche)&& $afficherFiche){ //si afficherFiche est different de null?>
    <h2> Frais hors forfait</h2>
    <p>
        
        
    </p>
    <table style="width:100%">
       <thead>
            <tr>
                <th>Libellé</th>
                 <th>Montant</th>
                <th>Actions</th>
            </tr>
        
        </thead>
        <tbody>
            
            <?php foreach($lafichehorsforfait['horsForfait']as $fichehf){?>
             <tr>               
                 <td><?php echo $fichehf['libelle']; ?></td>
                 <td><?php echo $fichehf['montant']; ?>€</td>
                 <td>
                     
                 </td> 
             </tr>
             
            <?php }?>
        </tbody>
        
    </table>
    
    <br/>
    <h2>Frais forfaitaires</h2>
     <table><thead>
        <tr>
            <th>Libellé</th>
            <th>Quantité</th>
        </tr>
       
    </thead>
    <tbody>
        <?php foreach($laficheforfait["forfait"] as $fichef){?>
        <tr>
            <td><?php echo $fichef["libelle"]; ?></td>
            <td><input type="text" name="frais[<?php echo $fichef["idfrais"];?>]" value="<?php echo $fichef['quantite']; ?>"></td>
        </tr>
        
        <?php }?>
    </tbody>
    </table>
    <form method="POST" action="index.php?uc=validationFrais&action=validerFicheFrais">
            <input type="submit" value="Valider la fiche">
            <input type="hidden" name="idVisiteur" value="<?php echo $_GET['lstvisiteurs']; ?>">
            <input type="hidden" name="mois" value="<?php echo $_GET['lstmois']; ?>">            
    </form>
    <?php 
    
        }?>
</div>
