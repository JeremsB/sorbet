<?php

require_once 'Model/Bet.php';
require_once 'View/Vue.php';
require_once 'Model/Model.php';


class ControllerBet extends Model { //La classe hérite de Model pour récupérer la connexion a la bdd + l'exe des requêtes

    private $bet;

    public function __construct() { //Construction de l'objet Bet
        $this->bet = new Bet();
    }

    //Créé les messages d'erreurs ou de succès pour session flash
    public function displayAlert(){

        $alertType = array_keys($_SESSION['flash'])[0];
        $message = $_SESSION['flash'][$alertType];

        echo'<div class="alert alert-'.$alertType.' alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		'.$message.'
		</div>';

    }

}