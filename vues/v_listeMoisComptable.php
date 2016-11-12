 <div id="contenu">
    <h3>Liste des mois avec des fiches de frais à valider</h3>
    <form method="GET" action="index.php">
        <label for="lstMois">Mois :</label>
        <select name="lstmois" id="lstMois">
        <?php foreach($aValider as $annee => $mois): ?>
            <?php foreach($mois as $item): ?>
            <option value="<?php echo $annee . $item ?>" <?php echo (isset($_GET['lstmois']) && $_GET['lstmois'] == $annee . $item) ? 'selected': ''; ?>><?php echo $item . " / " . $annee; ?></option>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </select>

        <input type="hidden" name="uc" value="validationFrais">
        <input type="hidden" name="action" value="demandeValiderFrais">
        <input type="hidden" name="part" value="2">
        <?php if($part === "2"): ?>
            <label for="lstVisiteurs">Liste des visiteurs :</label>
            <select name="lstvisiteurs" id="lstVisiteurs">
                <?php foreach($visiteurs as $visiteur): ?>
                    <option value="<?php echo $visiteur->id; ?>" <?php echo (isset($_GET['lstvisiteurs']) && $_GET['lstvisiteurs'] === $visiteur->idVisiteur) ? 'selected' : ''; ?>><?php echo $visiteur->nom . " " . $visiteur->prenom; ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
        <button type="submit">Valider</button>
    </form>
</div>
