<?php

require_once 'Model/Model.php';

class Bet extends Model { //La classe hérite de Model pour récupérer la connexion a la bdd + l'exe des requêtes

    //Fonction de suppression d'un ami
    public function delete($id1, $id2){
        $query = "DELETE FROM t_friend WHERE userA = ? AND target = ?";
        $this->executerRequete($query, array($id1, $id2));
    }

}