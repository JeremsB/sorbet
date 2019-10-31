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
                        } else if ($_SESSION['user']['profile'] == "user") { //Utilisateur = user
                            $id_user = $_SESSION['user']['id'];
                            $users = $this->ctrlUser->getOtherUsers($id_user);
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
                    if (!empty($_POST['login']) and !empty($_POST['lastname']) and !empty($_POST['firstname'])
                        and !empty($_POST['birth']) and !empty($_POST['email']) and !empty($_POST['password'])
                        and !empty($_POST['confPassword'])) {
                        if ($_POST['password'] == $_POST['confPassword']) {
                            $login = htmlspecialchars($this->getParametre($_POST, "login"));
                            $lastname = htmlspecialchars($this->getParametre($_POST, "lastname"));
                            $firstname = htmlspecialchars($this->getParametre($_POST, "firstname"));
                            $birth = htmlspecialchars($this->getParametre($_POST, "birth"));
                            $color = htmlspecialchars($this->getParametre($_POST, "color"));
                            $email = htmlspecialchars($this->getParametre($_POST, "email"));
                            $password = htmlspecialchars($this->getParametre($_POST, "password"));
                            $newsletter = htmlspecialchars($this->getParametre($_POST, "newsletter"));
                            $this->ctrlUser->registeration($login, $lastname, $firstname, $birth, $color, $email, $password, $newsletter);
                            header('Location:index.php?page=home');
                        } else {
                            $_SESSION['flash']['danger'] = "Veuillez saisir deux mots de passes identiques";
                            header('Location:index.php?page=register');
                        }
                    } else {
                        $_SESSION['flash']['danger'] = "Veuillez remplir tous les champs";
                        header('Location:index.php?page=register');
                    }
                } else if ($_GET["action"] == "connexion") { //Connexion

                    if (!empty($_POST)) {
                        $login = $this->getParametre($_POST, "username");
                        $pwd = $this->getParametre($_POST, "password");

                        $this->ctrlUser->connexion($login, $pwd);
                        $id_user = $_SESSION['user']['id'];
                        $this->redirect("index.php?page=home&id_user=$id_user");
                    }
                } else if ($_GET["action"] == "deconnexion") { //Déconnexion

                    session_destroy();
                    $this->redirect("index.php?page=connexion");

                } else if ($_GET["action"] == "addFriend") { //Envoie une demande d'ami

                    $user_id = $_GET["id_user"];
                    $target_id = $_GET["target_id"];
                    $this->ctrlUser->addAsFriend($user_id, $target_id);
                    $this->redirect("index.php?page=home&id_user=$user_id");
                }
            } else {
                $this->redirect("index.php?page=home");
            }

        } catch
        (Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

    }

    // Affiche une erreur
    /*
    private function erreur($msgErreur)
    {
        $vue = new View("Error");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
    */

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
