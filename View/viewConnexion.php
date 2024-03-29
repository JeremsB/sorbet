<title>Sorbet' - Connexion</title>

<?php ob_start(); ?>
<!--Stocke le code de la page dans la variable $contenu appelée dans le gabarit-->

<?php if (isset($_SESSION['flash']))  $this->ctrlUser->displayAlert(); ?>
<!-- Permet l'affichage des messages flash -->
<div class="affichage">
  <div class="container">

    <form method="post" action="index.php?action=connexion">
      <legend>Connexion</legend>
      <div class="form-group">
        <label for="exampleInputEmail1">Username :</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password :</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <small id="emailHelp" class="form-text text-muted">Please enter a password</small>
      </div>
      <input  class="btn btn-primary" type="submit" value="Connexion" />
    </form>

    <a href="index.php?page=register" rel="nofollow noopener noreferrer">Pas encore inscrit ?</a>

  </div>
</div>

<?php $contenu = ob_get_clean(); ?>
<!-- Stocke dans la variable $contenu -->

<?php require "View/gabarit.php"; ?>
<!-- Appelle le template du site -->