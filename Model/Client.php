<?php

require_once 'Model/Model.php';

class Client extends Model { //La classe hérite de Model pour récupérer la connexion a la bdd + l'exe des requêtes

  //Fonction d'ajout de l'utilisateur dans la base de données
  public function ajoutClient($login, $nom, $mail, $pwd){

    $pwd = md5($pwd); //Crypte le mot de passe récupéré dans le formulaire avec le hashage MD5

    $requete = "INSERT INTO t_clients (cl_login, cl_nom, cl_mail, cl_pwd) VALUES (?,?,?,?)"; //Insertion dans la table client

    $this->executerRequete($requete, array($login, $nom, $mail, $pwd)); //Execution de la requête

  }

  //Fonction qui vérifie si l'email existe déjà dans la base
  function mailExist($mail){

      $requete = "SELECT * FROM t_clients WHERE cl_mail = ?"; //Selectionne tout où le mail est égal au mail saisi

      $existMail = $this->executerRequete($requete, array($mail));
      $existMail = $existMail->fetch();

      return $existMail;

  }

  //Fonction qui vérifie si le code client existe déjà dans la base
  function loginExist($login){

      $requete = "SELECT * FROM t_clients WHERE cl_login = ?"; //Selectionne tout où le mail est égal au code client saisi

      $existLogin = $this->executerRequete($requete, array($login));
      $existLogin = $existLogin->fetch();

      return $existLogin;
  }

  //Récupère le code client en fonction de l'id de la commande
    public function getCodeClient($idCommande){
        $requete="SELECT cl_login FROM t_clients natural JOIN t_commandes t_commandes WHERE co_id = ?";
        return $this->executerRequete($requete, array($idCommande));
    }

  //Récupère les informations pour la connexion de l'utilisateur
  public function infosClient($login, $pwd){

      $requete = 'SELECT * FROM t_clients WHERE cl_login=? AND cl_pwd=?';
      return $this->executerRequete($requete, array($login, $pwd));

  }

  //Supprime un client
    public function supprimerClient($idClient){

        $requete="DELETE FROM t_clients WHERE cl_id=?";
        $this->executerRequete($requete, array($idClient));
    }


}
?>
