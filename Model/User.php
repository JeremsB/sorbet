<?php

require_once 'Model/Model.php';

class User extends Model
{ //La classe hérite de Model pour récupérer la connexion a la bdd + l'exe des requêtes

    //Vérifie si l'email existe déjà dans la base
    function mailExist($mail)
    {

        $requete = "SELECT * FROM t_user WHERE mail = ?"; //Selectionne tout où le mail est égal au mail saisi

        $existMail = $this->executerRequete($requete, array($mail));
        $existMail = $existMail->fetch();

        return $existMail;
    }

    //Vérifie si le code client existe déjà dans la base
    function loginExist($login)
    {
        $requete = "SELECT * FROM t_clients WHERE cl_login = ?"; //Selectionne tout où le login est égal au login saisi

        $existLogin = $this->executerRequete($requete, array($login));
        $existLogin = $existLogin->fetch();

        return $existLogin;
    }

    //Récupère les informations pour la connexion de l'utilisateur
    public function infosUser($login, $pwd)
    {
        $requete = 'SELECT * FROM t_user WHERE login=? AND pwd=?';
        return $this->executerRequete($requete, array($login, $pwd));
    }

}