<?php

require_once 'Model/Model.php';

class Friend extends Model { //La classe hérite de Model pour récupérer la connexion a la bdd + l'exe des requêtes


    //Fonction de suppression d'un ami
    public function delete($id1, $id2){
        $query = "DELETE FROM t_friend WHERE userA = ? AND target = ?";
        $this->executerRequete($query, array($id1, $id2));
    }

    //Récupère tous autres les utilisateurs hors amis
    public function getOthers($id1, $id2, $id3)
    {
        $query = 'SELECT * FROM t_user WHERE id_user != ? AND id_user NOT IN (SELECT target FROM t_friend WHERE userA = ?) AND id_user NOT IN (SELECT userA FROM t_friend WHERE target = ? AND accept = 0)';
        return $this->executerRequete($query, array($id1, $id2, $id3));
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

    public function number($id) {
        $query = "SELECT COUNT(id_friend) FROM `t_friend` WHERE userA = ? AND accept = 1";
        return $this->executerRequete($query, array($id));
    }

}