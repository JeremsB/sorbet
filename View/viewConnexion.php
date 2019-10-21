<title>Sorbet' - Connexion</title>

<?php ob_start(); ?> <!--Stocke le code de la page dans la variable $contenu appelée dans le gabarit-->

  <?php if(isset($_SESSION['flash']))  $this->ctrlUser->displayAlert();?> <!-- Permet l'affichage des messages flash -->
  <div class="affichage">
    <div class="container">
        <legend>*Insérer une phrase d'accroche*</legend>
        <form method="post" action="index.php?action=connexion" class="row justify-content-md-center">

                <div class="col-md-4">
                    <label for="username">Username :</label>
                    <input name="username" type="text" id="username" class="inputtext"  placeholder="Username"/>
                </div>
                <div class="col-md-4">
                    <label for="password">Mot de Passe :</label>
                    <input type="password" name="password" id="password" class="inputtext" placeholder="Password"/>
                    <br />
                    <br />
                    <input type="submit" value="Connexion" />
                </div>

        </form>

        <a href="index.php?action=register" rel="nofollow noopener noreferrer">Pas encore inscrit ?</a>
    </div>
  </div>

<?php $contenu = ob_get_clean();?> <!-- Stocke dans la variable $contenu -->

<?php require "View/gabarit.php";?> <!-- Appelle le template du site -->
