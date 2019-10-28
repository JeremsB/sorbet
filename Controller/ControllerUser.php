<?php

require_once 'Model/User.php';
require_once 'View/Vue.php';
require_once 'Model/Model.php';


class ControllerUser extends Model { //La classe hérite de Model pour récupérer la connexion a la bdd + l'exe des requêtes

    private $user;

    public function __construct() { //Construction de l'objet Client
        $this->user = new User();
    }

    public function registeration($login, $lastname, $firstname, $birth, $color, $email, $password, $newsletter){

        $existLogin = $this->user->loginExist($login); //Récupère le résultat de la fonction loginExist
        $existEmail = $this->user->emailExist($email); //Pareil pour le mail

        if($existLogin) { //Si la variable existLogin n'est pas vide (= login déjà utilisé), on affiche un message et on "redirige" vers la page d'inscription
            $_SESSION['flash']['danger'] = "Un utilisateur avec ce pseudo existe déjà" ;
            header('Location:index.php?page=register');
        }

        else if($existEmail) { //Pareil pour le mail
            $_SESSION['flash']['danger'] = "Un utilisateur avec cette adresse email existe déjà" ;
            header('Location:index.php?page=register');
        }

        else {
            //On ajoute l'utilisateur dans la base de données
            $password = $this->pwdHash($password);
            $this->user->addUser($login, $lastname, $firstname, $birth, $color, $email, $password, $newsletter);

            //On redirige vers le formulaire de connexion
            $_SESSION['flash']['success'] = "Inscription réussie! Bienvenue" ;
            header('Location:index.php?page=connexion');

            // TODO try catch
            /*
            $_SESSION['flash']['danger'] = "Une erreur s'est produite lors de l'inscription, veuillez réessayer plus tard" ;
            header('Location:index.php?page=register');
            */
        }
    }

    public function connexion($login, $pwd) {

        $pwd = $this->pwdHash($pwd);

        $query = $this->user->infosUser($login, $pwd); //Récupère les informations de l'utilisateur en fonction de son username et de son mot de passe
        $infos = $query->fetchobject(); //Récupère sous forme d'objet

        //Créé une session si les informations de l'utilisateur sont présentes dans la base de données
        if($infos) {
            $_SESSION['user'] = ["id"  => $infos->id_user,
                "login" => $infos->login,
                "lastname" => $infos->lastname,
                "firstname" => $infos->firstname,
                "birth" => $infos->birth,
                "color" => $infos->color,
                "email" => $infos->email,
                "status" => $infos->status,
                "picture" => $infos->picture,
                "exp" => $infos->exp,
                "profile" => $infos->profile,
                "newsletter" => $infos->newsletter,
                "notifications" => $infos->notifications];
        } else { //Sinon affiche un message d'erreur
            $_SESSION['flash']['danger'] = "Les identifiants saisis sont incorrects" ;
        }

        //Redirection vers l'accueil
        //header('Location:index.php?page=home');

    }

    public function pwdHash($pwd) {
        $pwd = sha1($pwd);
        return $pwd;
    }

    public function addXp($id_user, $xp) {
        $xp_user = $this->user->getExp($id_user);
        $xp_user = $xp_user + $xp;
        $this->user->setExp($xp_user, $id_user);
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