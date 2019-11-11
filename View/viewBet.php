<title>Sorbet' - Paris</title>

<?php ob_start(); ?> <!--Stocke le code de la page dans la variable $contenu appelée dans le gabarit-->

<h3>Les paris excellent!</h3>

<?php $contenu = ob_get_clean();?> <!-- Stocke dans la variable $contenu -->

<?php require "View/gabarit.php";?> <!-- Appelle le template du site -->