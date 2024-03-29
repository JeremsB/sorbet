<?php

require_once 'Model/Model.php';

class User extends Model { //La classe hérite de Model pour récupérer la connexion a la bdd + l'exe des requêtes

    //Fonction d'ajout de l'utilisateur dans la base de données
    public function addUser($login, $lastname, $firstname, $birth, $color, $email, $password, $newsletter){

        $query = "INSERT INTO t_user (login, lastname, firstname, birth, color, email, password, newsletter) VALUES (?,?,?,?,?,?,?,?)"; //Insertion dans la table client

        $this->executerRequete($query, array($login, $lastname, $firstname, $birth, $color, $email, $password, $newsletter)); //Execution de la requête

    }

    //Fonction de mise à jour des infos de l'utilisateur
    public function update($id, $login, $lastname, $firstname, $birth, $color, $email, $newsletter){
        $query = "UPDATE t_user SET login = ?, lastname = ?, firstname = ?, birth = ?, color = ?, email = ?, newsletter = ? WHERE id_user = ?";
        $this->executerRequete($query, array($login, $lastname, $firstname, $birth, $color, $email, $newsletter, $id)); //Execution de la requête
    }

    //Fonction de suppression d'un utilisateur
    public function delete($id){
        $query = "DELETE FROM t_user WHERE id_user = ?";
        $this->executerRequete($query, array($id));
    }

    //Vérifie si l'email existe déjà dans la base
    function emailExist($email)
    {
        $requete = "SELECT * FROM t_user WHERE email = ?"; //Selectionne tout où le mail est égal au mail saisi

        $existEmail = $this->executerRequete($requete, array($email));
        $existEmail = $existEmail->fetch();

        return $existEmail;
    }

    //Vérifie si le pseudo existe déjà dans la base
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

    //Récupère l'expérience de l'utilisateur
    public function getExp($id)
    {
        $query = 'SELECT exp FROM t_user WHERE id_user = ?';
        return $this->executerRequete($query, array($id));
    }

    //Modifie l'expérience de l'utilisateur
    public function setExp($xp, $id)
    {
        $query = 'UPDATE t_user SET exp = ? WHERE id_user = ?';
        return $this->executerRequete($query, array($xp, $id));
    }

    //Récupère tous autres les utilisateurs hors amis
    public function getOthers($id1, $id2)
    {
        $query = 'SELECT * FROM t_user WHERE id_user != ? AND id_user NOT IN (SELECT target FROM t_friend WHERE userA = ?)';
        return $this->executerRequete($query, array($id1, $id2));
    }

    //Récupère les demandes d'amis envoyées (non répondues) par l'utilisateur
    public function getAsked($id)
    {
        $query = 'SELECT * FROM `t_user` WHERE id_user IN (SELECT target FROM t_friend WHERE userA = ? AND accept = 0)';
        return $this->executerRequete($query, array($id));
    }

    //Récupère les amis de l'utilisateur
    public function getFriends($id)
    {
        $query = 'SELECT * FROM `t_user` WHERE id_user IN (SELECT target FROM t_friend WHERE userA = ? AND accept = 1)';
        return $this->executerRequete($query, array($id));
    }

    //Ajoute un ami dans la base friend
    public function addFriend($user_id, $target_id)
    {
        $query = "INSERT INTO t_friend (userA, target) VALUES (?,?)";
        $this->executerRequete($query, array($user_id, $target_id));
    }

    //Vérifie si la relation existe dans un sens
    public function checkFriendship1($user_id, $target_id)
    {
        $query = "SELECT * FROM t_friend WHERE userA = ? AND target = ?";
        $friendShip1 = $this->executerRequete($query, array($user_id, $target_id));
        $friendShip1 = $friendShip1->fetch();
        return $friendShip1;
    }

    //Vérifie si la relation existe dans l'autre sens
    public function checkFriendship2($user_id, $target_id)
    {
        $query = "SELECT * FROM t_friend WHERE userA = ? AND target = ?";
        $friendShip2 = $this->executerRequete($query, array($target_id, $user_id));
        $friendShip2 = $friendShip2->fetch();
        return $friendShip2;
    }

    public function friendRequest($id) {
        $query = 'SELECT * FROM `t_user` WHERE id_user IN (SELECT userA FROM t_friend WHERE target = ? AND accept = 0)';
        return $this->executerRequete($query, array($id));
    }

    public function acceptFriend($userA, $target_id){
        $query = "UPDATE t_friend SET accept = 1 WHERE userA = ? AND target = ?";
        $this->executerRequete($query, array($userA, $target_id));
    }

    public function mutual($userA, $target_id){
        $query = "INSERT INTO t_friend (userA, target, accept) VALUES (?,?,1)";
        $this->executerRequete($query, array($userA, $target_id));
    }

}