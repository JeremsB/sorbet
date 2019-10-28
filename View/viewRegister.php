<title>Inscription</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<meta charset="utf-8">


<?php ob_start(); ?>

<?php if (isset($_SESSION['flash']))  $this->ctrlClient->displayAlert(); ?>
<div class="affichage">
    <div class="container">
        <legend>Inscription</legend>
        <form method="post" action="index.php?action=register">

            <div class="form-group">
                <label for="login">Pseudo: </label>
                <input id="login" class="form-control" name="login" placeholder="Pseudo" autofocus="" required="">
            </div>
            <div class="form-group">
                <label for="lastname">Nom: </label>
                <input id="lastname" class="form-control" name="lastname" placeholder="Nom" autofocus="" required="">
            </div>
            <div class="form-group">
                <label for="firstname">Prénom: </label>
                <input id="firstname" class="form-control" name="firstname" placeholder="Prénom" autofocus="" required="">
            </div>
            <div class="form-group">
                <label for="birth">Date de naissance: </label>
                <input class="form-control" id="birth" type="date" name="birth" placeholder="Date de naissance" autofocus="" required="">
            </div>
            <!-- Couleur du profil (genre une couleur au format hexa qui représente l'user genre couleur de son pseudo ou du contour de sa photo...) -->
            <div class="form-group">
                <label for="color">Couleur du profil: </label>
                <input class="form-control" id="color" type="color" name="color" placeholder="Couleur du profil" autofocus="" value="#000000" required="">
            </div>

            <div class="form-group">
                <label for="email">Email: </label>
                <input id="email" class="form-control" name="email" placeholder="Email" autofocus="" required="">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe: </label>
                <input id="password" type="password" class="form-control" name="password" placeholder="Mot de passe" autofocus="" required="">
            </div>
            <div class="form-group">
                <label for="confPassword">Confirmation du mot de passe: </label>
                <input id="confPassword" type="password" class="form-control" name="confPassword" placeholder="Confirmation du mot de passe" autofocus="" required="">
            </div>
            <div class="form-check form-check-inline">
                Voulez vous vous abonner à la newsletter?
                <input class="form-check-input" id="oui" type="radio" name="newsletter" value="1" checked>
                <label class="form-check-label" for="oui">Oui</label>
                <input class="form-check-input" id="non" type="radio" name="newsletter" value="0">
                <label class="form-check-label" for="non">Non</label>
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="submit" value="Valider">
            </div>

        </form>

    </div>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require "View/gabarit.php"; ?>