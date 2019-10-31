<title><?php echo $_SESSION['user']['login']; ?> ! </title>

<?php ob_start(); ?> <!--Stocke le code de la page dans la variable $contenu appelée dans le gabarit-->

<h3>C'est un test et ça marche!</h3>
<h4>Bienvenue <?php echo $_SESSION['user']['login']; ?> ! Votre couleur est <span style="color: <?php echo $_SESSION['user']['color'];?>">celle-ci</span></h4>
<img src="Content/img/default.png" style="width: 50px; border: 2px solid <?php echo $_SESSION['user']['color'];?>">
Vous êtes <?php echo $_SESSION['user']['firstname']; echo " ".$_SESSION['user']['lastname'];?> et vous êtes né le <?php echo $_SESSION['user']['birth'];?> et j'ai pas formaté la date EXCELLENT

<style>
    table {
        border-collapse: collapse;
        border: 1px solid black;
        margin-top: 10px;
    }
    th, td {
        border: 1px solid black;
        padding: 15px;
        text-align: left;
    }
</style>


<table>
    <tr>
        <th scope="col">Photo</th>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Birth</th>
        <th scope="col">Email</th>
        <th scope="col">Ajouter</th>
    </tr>
    <?php foreach ($users as $user) {?>
    <tr>
        <td><img src="Content/img/<?php echo $user['picture'];?>" style="width: 35px; border: 2px solid <?php echo $user['color'];?>"></td>
        <td><?php echo $user['lastname']; ?></td>
        <td><?php echo $user['firstname']; ?></td>
        <td><?php echo $user['birth']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><a href="index.php?action=addFriend&id_user=<?php echo $_SESSION['user']['id'];?>&target_id=<?php echo $user['id_user'];?>">Ajouter</a></td>
    </tr>
    <?php } ?>
</table>

<?php $contenu = ob_get_clean();?> <!-- Stocke dans la variable $contenu -->

<?php require "View/gabarit.php";?> <!-- Appelle le template du site -->