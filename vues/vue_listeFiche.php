<!-- Formulaire permettant d'accéder aux fuches de frais d'un individu
     en fonction de son nom et de la date -->

<form action="index.php?uc=validerFrais&action=voirEtatFiche" method="post"> 
<legend>Visiteur et mois à sélectionner : </legend>

<!-- Sélection du visiteur -->
<label for="lstVisiteur" accesskey="n" >Visiteur : </label>
        <select id="lstVisiteur" name="lstVisiteur">
            <?php
            foreach ($lesVisiteurs as $unVisiteur)
            { 
            $idVisiteur = $unVisiteur['idVisiteur'];
            $nomVisiteur = $unVisiteur['nom'];
            $prenomVisiteur = $unVisiteur['prenom'];
            if($idVisiteur == $visiteurASelectionner){
            ?>
             <option selected value="<?php echo $idVisiteur ?>"><?php echo $nomVisiteur." - ".$prenomVisiteur ?></option>
            <?php 
            }
            else{ ?>
             <option value="<?php echo $idVisiteur ?>"><?php echo $nomVisiteur." - ".$prenomVisiteur ?></option>
              <?php
                }
            }
            ?>
        </select>

<!-- Sélection du mois -->
        <span><label for="mois">Mois : </label></span>
            <input type="text" id="mois" name="mois" value="" placeholder="aaaamm"/>
            <br/><br/>
            
           <input class="button" type="submit" value="Valider" />
           <input class="button" type="reset" value="Effacer" />
                     
                    </form>
