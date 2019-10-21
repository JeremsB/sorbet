<title>Administration</title>

<?php ob_start(); ?> <!--Stocke le code de la page dans la variable $contenu appelée dans le gabarit-->


<h3>C'est un test et ça marche!</h3>
<img src="Content/img/pouce.jpg" alt="pouce">
<?php $contenu = ob_get_clean();?> <!-- Stocke dans la variable $contenu -->

<?php require "View/gabarit.php";?> <!-- Appelle le template du site -->