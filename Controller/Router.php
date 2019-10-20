<?php


require_once 'Controller/ControllerClient.php';
require_once 'Controller/ControllerUser.php';
require_once 'View/Vue.php';

class Routeur
{

    private $ctrlClient;
    private $ctrlUser;


    public function __construct()
    {
        $this->ctrlClient = new ControllerClient();
        $this->ctrlUser = new ControllerUser();
    }

    // Route une requête entrante : exécute l'action associée
    public function routerRequete()
    {

        try {

            if (isset($_GET['page'])) { //Dirige vers les pages, ex: envoie sur la page connexion mais ne connecte pas contrairement a action = connexion

                if ($_GET['page'] == 'home') {
                    if (!isset($_SESSION['user'])) { //Si la variable session user n'existe pas (Si personne de connecté)
                        require "View/viewConnexion.php";
                        unset($_SESSION['flash']);
                    } else {
                        if ($_SESSION['user']['profile'] == "admin") { //Utilisateur = admin
                            /*
                            $commandes = $this->ctrlCommande->getAllCommandesPasValideesTP();
                            $detailsCommande = $this->ctrlCommande->getInfosCommandes();

                            $codeClient = [];
                            foreach ($commandes as $commande) {
                                $donnee = $this->ctrlClient->getCodeClient($commande["co_id"]);
                                $codeClient[$commande["co_id"]] = $donnee["cl_login"];
                            }
                            */
                            require 'View/viewAdmin.php';
                        } else if ($_SESSION['user']['profile'] == "pro") { //Utilisateur = pro
                            require 'View/viewPro.php';
                        } else { //Utilisateur = client
                            $idClient = $_SESSION['user']['id'];
                            require 'View/viewHome.php';
                        }
                    }
                } else if ($_GET['page'] == 'register') {
                    require 'View/viewRegister.php';
                } else {
                    if (isset($_SESSION['user'])) {
                        if ($_SESSION['user']['profile'] == "admin") { //Utilisateur = admin
                            $idUser = $_SESSION['user']['id'];
                            require 'View/viewAdmin.php';
                        } else if ($_SESSION['user']['profile'] == "pro") { //Utilisateur = pro
                            $idUser = $_SESSION['user']['id'];
                            require 'View/viewPro.php';
                        } else { //Utilisateur = client
                            $idUser = $_SESSION['user']['id'];
                            require 'View/viewHome.php';
                        }
                    } else {
                        require "View/viewConnexion.php";
                    }
                }
            } else if (isset($_GET['action'])) {

                if ($_GET['action'] == 'register') { //Inscription
                    if (!empty($_POST['username']) and !empty($_POST['identifiant']) and !empty($_POST['nom'])) {
                        $login = htmlspecialchars($this->getParametre($_POST, "identifiant"));
                        $nom = htmlspecialchars($this->getParametre($_POST, "nom"));
                        $mail = htmlspecialchars($this->getParametre($_POST, "mail"));
                        $this->ctrlClient->inscription($login, $nom, $mail);
                    } else {
                        $_SESSION['flash']['danger'] = "Veuillez remplir tous les champs";
                        header('Location:index.php?page=inscription');
                    }
                } else if ($_GET["action"] == "connexion") { //Connexion

                    if (!empty($_POST)) {

                        $login = $this->getParametre($_POST, "username");
                        $pwd = md5($this->getParametre($_POST, "password"));

                        $this->ctrlClient->connexion($login, $pwd);
                    }
                } else if ($_GET["action"] == "deconnexion") { //Déconnexion
                    session_destroy();
                    $this->redirect("index.php?page=connexion");
                }
            } else {
                require 'View/viewHome.php';
            }

        } catch
        (Exception $e) {
            $this->erreur($e->getMessage());
        }

    }

    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }

    // Recherche un paramètre dans un tableau
    private function getParametre($tableau, $nom)
    {
        if (isset($tableau[$nom])) {
            return $tableau[$nom];
        }/*
        else
            throw new Exception("Paramètre '$nom' absent");*/
    }

    //Fonction de redirection
    function redirect($url)
    {

        if (!headers_sent()) {
            header('Location: ' . $url);
            exit;
        } else {
            echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
            exit;
        }
    }

}
