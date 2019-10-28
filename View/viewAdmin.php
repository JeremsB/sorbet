<title>Administration</title>

<?php ob_start(); ?> <!--Stocke le code de la page dans la variable $contenu appelée dans le gabarit-->


<h3>C'est un test et ça marche!</h3>
<h4>Bienvenue <?php echo $_SESSION['user']['login']; ?> ! Votre couleur est <span style="color: <?php echo $_SESSION['user']['color'];?>">celle-ci</span></h4>

<?php $contenu = ob_get_clean();?> <!-- Stocke dans la variable $contenu -->

<?php require "View/gabarit.php";?> <!-- Appelle le template du site -->