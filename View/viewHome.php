<title><?php echo $_SESSION['user']['login']; ?> ! </title>

<?php ob_start(); ?> <!--Stocke le code de la page dans la variable $contenu appelée dans le gabarit-->

<h3>C'est un test et ça marche!</h3>
<h4>Bienvenue <?php echo $_SESSION['user']['login']; ?> ! Votre couleur est <span style="color: <?php echo $_SESSION['user']['color'];?>">celle-ci</span></h4>
<img src="Content/img/profile/default.png" style="width: 50px; border: 2px solid <?php echo $_SESSION['user']['color'];?>">
Vous êtes <?php echo $_SESSION['user']['firstname']; echo " ".$_SESSION['user']['lastname'];?> et vous êtes né le <?php echo $_SESSION['user']['birth'];?> et j'ai pas formaté la date EXCELLENT

<?php $contenu = ob_get_clean();?> <!-- Stocke dans la variable $contenu -->

<?php require "View/gabarit.php";?> <!-- Appelle le template du site -->