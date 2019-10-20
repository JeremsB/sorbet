<title>Inscription</title>

<link rel="stylesheet" href="Contenu/form.css" />
<meta charset="utf-8">


<?php ob_start(); ?>

    <?php if(isset($_SESSION['flash']))  $this->ctrlClient->displayAlert();?>
      <div class="affichage">
        <div class="container">
            <legend>Inscription</legend>
            <form method="post" action="index.php?action=inscription" class="row justify-content-md-center">

                <div class="col-md-4">
                    <label for="identifiant">Code client: </label>
                    <input id="identifiant" class="inputtext" name="identifiant" placeholder="Code client" autofocus="" required="">
                </div>
		<div class="col-md-4">
                    <label for="nom">Nom: </label>
                    <input id="nom" class="inputtext" name="nom" placeholder="Nom" autofocus="" required="">
                </div>
                <div class="col-md-4">
                    <label for="mail">Email: </label>
                    <input id="mail" class="inputtext" name="mail" placeholder="Email" autofocus="" required="">
                    <br />
                    <br />
                    <input class="ajouterPanier" type="submit" name="submit" value="Valider">
                </div>

            </form>

        </div>
      </div>

<?php $contenu = ob_get_clean();?>

<?php require "View/gabarit.php";?>
