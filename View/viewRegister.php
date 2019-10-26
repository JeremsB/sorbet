<title>Inscription</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<meta charset="utf-8">


<?php ob_start(); ?>

    <?php if(isset($_SESSION['flash']))  $this->ctrlClient->displayAlert();?>
      <div class="affichage">
        <div class="container">
            <legend>Inscription</legend>
            <form method="post" action="index.php?action=register">

                <div class="row">
                    <div class="col-md-6">
                        <label for="login">Pseudo: </label>
                        <input id="login" class="inputtext" name="login" placeholder="Pseudo" autofocus="" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="lastname">Nom: </label>
                        <input id="lastname" class="inputtext" name="lastname" placeholder="Nom" autofocus="" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="firstname">Prénom: </label>
                        <input id="firstname" class="inputtext" name="firstname" placeholder="Prénom" autofocus="" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="birth">Date de naissance: </label>
                        <input id="birth" type="date" name="birth" placeholder="Date de naissance" autofocus="" required="">
                    </div>
                </div>
                <!-- Couleur du profil (genre une couleur au format hexa qui représente l'user genre couleur de son pseudo ou du contour de sa photo...) -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="color">Couleur du profil: </label>
                        <input id="color" type="color" name="color" placeholder="Couleur du profil" autofocus="" value="#000000" required="">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="email">Email: </label>
                        <input id="email" class="inputtext" name="email" placeholder="Email" autofocus="" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="password">Mot de passe: </label>
                        <input id="password" type="password" class="inputtext" name="password" placeholder="Mot de passe" autofocus="" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="confPassword">Confirmation du mot de passe: </label>
                        <input id="confPassword" type="password" class="inputtext" name="confPassword" placeholder="Confirmation du mot de passe" autofocus="" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        Voulez vous vous abonner à la newsletter?
                        <input id="oui" type="radio" name="newsletter" value="1" checked>
                        <label for="oui">Oui</label>
                        <input id="non" type="radio" name="newsletter" value="0">
                        <label for="non">Non</label>
                    </div>
                </div>

                <div class="row">
                        <input type="submit" name="submit" value="Valider">
                </div>

            </form>

        </div>
      </div>

<?php $contenu = ob_get_clean();?>

<?php require "View/gabarit.php";?>
