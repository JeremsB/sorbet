<?php

require_once 'Model/Model.php';

class User extends Model { //La classe hérite de Model pour récupérer la connexion a la bdd + l'exe des requêtes

    //Fonction d'ajout de l'utilisateur dans la base de données
    public function addUser($login, $lastname, $firstname, $birth, $color, $email, $password, $newsletter){

        $query = "INSERT INTO t_user (login, lastname, firstname, birth, color, email, password, newsletter) VALUES (?,?,?,?,?,?,?,?)"; //Insertion dans la table client

        $this->executerRequete($query, array($login, $lastname, $firstname, $birth, $color, $email, $password, $newsletter)); //Execution de la requête

    }

    //Vérifie si l'email existe déjà dans la base
    function emailExist($email)
    {
        $requete = "SELECT * FROM t_user WHERE email = ?"; //Selectionne tout où le mail est égal au mail saisi

        $existEmail = $this->executerRequete($requete, array($email));
        $existEmail = $existEmail->fetch();

        return $existEmail;
    }

    //Vérifie si le code client existe déjà dans la base
    function loginExist($login)
    {
        $requete = "SELECT * FROM t_user WHERE login = ?"; //Selectionne tout où le login est égal au login saisi

        $existLogin = $this->executerRequete($requete, array($login));
        $existLogin = $existLogin->fetch();

        return $existLogin;
    }

    //Récupère les informations pour la connexion de l'utilisateur
    public function infosUser($login, $pwd)
    {
        $requete = 'SELECT * FROM t_user WHERE login=? AND password=?';
        return $this->executerRequete($requete, array($login, $pwd));
    }

}