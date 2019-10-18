<title>Administration</title>

<?php ob_start(); ?> <!--Stocke le code de la page dans la variable $contenu appelée dans le gabarit-->

  <?php if(isset($_SESSION['flash']))  $this->ctrlClient->displayAlert();?> <!-- Permet l'affichage des messages flash -->
  <div class="affichage">
    <div class="container">
        <legend>Connexion</legend>
        <form method="post" action="index.php?action=connexion" class="row justify-content-md-center">

                <div class="col-md-4">
                    <label for="identifiant">Username :</label>
                    <input name="identifiant" type="text" id="identifiant" class="inputtext"  placeholder="Code client"/>
                </div>
                <div class="col-md-4">
                    <label for="password">Mot de Passe :</label>
                    <input type="password" name="password" id="password" class="inputtext" placeholder="Mot de passe"/>
                    <br />
                    <br />
                    <input class="ajouterPanier" type="submit" value="Connexion" />
                </div>

        </form>

        <a href="index.php?action=inscription" rel="nofollow noopener noreferrer" style="color: white; text-decoration: underline;">Pas encore inscrit ?</a>
    </div>
  </div>

<?php $contenu = ob_get_clean();?> <!-- Stocke dans la variable $contenu -->

<?php require "View/gabarit.php";?> <!-- Appelle le template du site -->
