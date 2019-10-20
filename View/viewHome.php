<title>Administration</title>

<?php ob_start(); ?> <!--Stocke le code de la page dans la variable $contenu appelée dans le gabarit-->


<h3 style="color: greenyellow; text-align: center; margin-bottom: 0px;">C'est un test et ça marche!</h3>
<img src="Content/img/pouce.jpg" alt="pouce" style="width: 100%">
<?php $contenu = ob_get_clean();?> <!-- Stocke dans la variable $contenu -->

<?php require "View/gabarit.php";?> <!-- Appelle le template du site -->