<!--
<section>
 <form>
  <label for="nomAnnonce">Nom annonce</label> </br>
  <input type="text" name="nomAnnonce" size=30/> </br> </br>

  <label for="Description">Description</label> </br>
  <input type="text" name="Description" size=30/> </br> </br>

  <label for="Prix">Prix</label> </br>
  <input type="number" name="Prix"> </br> </br>

  <label for="Url">URL</label> </br>
  <input type="url" name="Url"> </br> </br>

  <input type="submit" value="Envoyer">
</form>
</section>
-->

<?php if ($_SESSION['oUser'] instanceof User) { ?>
    <!-- On définie la méthode pour recevoir nos données, ici POST
    Du coup, les données du formulaire seront récupérées en PHP via la variable $_POST -->
    <form id="formAddAnnonce" action="index.php" method="POST" enctype="multipart/form-data">
        <!-- On groupe nos différents champs de formulaire via des balises FIELDSET -->
        <fieldset>
            <legend> Votre annonce </legend>

            <label for="title">Titre de l'annonce :</label><br />
            <input type="text" id="title" name="title" placeholder="Titre" value="<?php
            if (isset($_POST['title'])) {
                echo $_POST['title'];
            }
            ?>"/>
            <br /><br />

            <label for="description">Description de l'annonce :</label><br />
            <textarea id="description" name="description" placeholder="Description">
                <?php
                if (isset($_POST['description'])) {
                    echo $_POST['description'];
                }
                ?>
            </textarea>
            <br /><br />

            <label for="price">Prix :</label> (Optionnel)<br />
            <input type="text" id="price" name="price" placeholder="Prix" value="<?php
                   if (isset($_POST['price'])) {
                       echo $_POST['price'];
                   }
                   ?>"/>
            <br/>
            <br />

            <input type="file" name="image">

        </fieldset>
        </br>
        </br>
        <input type="submit" name="depotAnnonceForm" value="valider"/>
    </form>
<?php } else { ?>
    Veuillez vous connecter pour accéder au service
<?php } ?>