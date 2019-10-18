<?php


require_once 'Controller/ControllerClient.php';
require_once 'View/Vue.php';

class Routeur
{

    private $ctrlClient;


    public function __construct()
    {
        $this->ctrlClient = new ControllerClient();
    }

    // Route une requête entrante : exécute l'action associée
    public function routerRequete()
    {

        try {

            if (isset($_GET['page'])) { //Dirige vers les pages, ex: envoie sur la page inscription mais n'inscrit pas contrairement a action = inscription

                if ($_GET['page'] == 'admin') {
                    if (!isset($_SESSION['client'])) { //Si la variable session client n'existe pas
                        require "View/viewConnexion.php";
                        unset($_SESSION['flash']);
                    } else {
                        //Utilisateur = téléprospecteur
                        if ($_SESSION['client']['profil'] == "teleprospecteur") {

                            $commandes = $this->ctrlCommande->getAllCommandesPasValideesTP();
                            $detailsCommande = $this->ctrlCommande->getInfosCommandes();

                            $codeClient = [];
                            foreach ($commandes as $commande) {
                                $donnee = $this->ctrlClient->getCodeClient($commande["co_id"]);
                                $codeClient[$commande["co_id"]] = $donnee["cl_login"];
                            }

                            require 'View/vueCompteTp.php';
                        } //Utilisateur = client
                        else {
                            $idClient = $_SESSION['client']['id'];
                            /*
                            $validatedOrdersNumber = $this->ctrlCommande->getValidatedOrdersNumber($idClient);
                            $nonValidatedOrdersNumber = $this->ctrlCommande->getNonValidatedOrdersNumber($idClient);
                            */
                            echo "Test";
                            require 'View/vueCompteCl.php';
                        }
                    }
                } else if ($_GET['page'] == 'infos') {
                    require 'View/vueInfos.php';
                } else if ($_GET['page'] == 'mesCommandes') {
                    if (isset($_SESSION['client'])) {
                        $idClient = $_SESSION['client']['id'];
                        $commandes = $this->ctrlCommande->getCommandes($idClient)->fetchAll();
                        $detailsCommandes = $this->ctrlCommande->getInfosCommandes();

                        require 'View/vueCommandesCl.php';
                    } else {
                        require "View/viewConnexion.php";
                    }
                } else if ($_GET["page"] == "panier") {

                    // Vérifie si il y a une connexion en cours et affiche le panier
                    if (isset($_SESSION['client'])) {

                        $panier = $_SESSION["panier"];

                        $articlesPanier = $this->ctrlArticle->getArticlesPanier($panier);
                        $total = $this->ctrlArticle->getPrixTotal($articlesPanier);
                        $idClient = $_SESSION['client']['id'];

                        if (isset($_GET['action'])) {

                            $idArticle = $this->getParametre($_GET, 'idArticle');

                            //Action d'ajout d'un article au panier
                            if ($_GET['action'] == "ajoutArticlePanier") {

                                $this->ctrlArticle->ajoutArticlePanier($idArticle, $panier);
                                $this->redirect("index.php?page=panier");
                            } //Retirer un article du panier
                            else if ($_GET['action'] == "retirerArticlePanier") {

                                $this->ctrlArticle->retirerArticlePanier($idArticle);
                                $this->redirect("index.php?page=panier");
                            } //Supprimer un article du panier
                            else if ($_GET['action'] == "supprimerArticlePanier") {

                                $this->ctrlArticle->supprimerArticlePanier($idArticle);
                                $this->redirect("index.php?page=panier");
                            } //Action de validation du panier (passer une commande)
                            else if ($_GET['action'] == "validePanier") {
                                $this->ctrlCommande->validePanier($articlesPanier, $total, $idClient);
                                $this->redirect("index.php?page=panier");
                            }
                        }
                        require "View/vuePanier.php";

                        //Sinon on le redirige vers le formulaire de connexion
                    } else
                        require "View/viewConnexion.php";

                } else { //Si l'attribut de "page" est inconnu alors renvoie a l'accueil
                    require 'View/vueAccueil.php';
                }

            } else if (isset($_GET['action'])) {

                if ($_GET['action'] == 'magasin') {
                    $this->ctrlMagasin->magasin();
                } else if ($_GET["action"] == "connexion") {

                    if (!empty($_POST)) {

                        $login = $this->getParametre($_POST, "identifiant");
                        $pwd = md5($this->getParametre($_POST, "password"));

                        $this->ctrlClient->connexion($login, $pwd);
                    }
                } //Désinscription
                else if ($_GET["action"] == "desinscrire") {
                    $idClient = $_SESSION['client']['id'];
                    $this->ctrlClient->desinscrire($idClient);
                    session_destroy();
                    $this->redirect("index.php?page=connexion");
                } //Déconnexion
                else if ($_GET["action"] == "deconnexion") {
                    session_destroy();
                    $this->redirect("index.php?page=connexion");
                } else if ($_GET['action'] == 'inscription') {

                    if (!empty($_POST['mail']) and !empty($_POST['identifiant']) and !empty($_POST['nom'])) {

                        $login = htmlspecialchars($this->getParametre($_POST, "identifiant"));
                        $nom = htmlspecialchars($this->getParametre($_POST, "nom"));
                        $mail = htmlspecialchars($this->getParametre($_POST, "mail"));

                        $this->ctrlClient->inscription($login, $nom, $mail);
                    } else {
                        $_SESSION['flash']['danger'] = "Veuillez remplir tous les champs";
                        header('Location:index.php?page=inscription');
                    }
                } else if ($_GET['action'] == "ajoutPanier") {

                    //
                    if (isset($_SESSION['client'])) {
                        $panier = $_SESSION["panier"];
                        $idArticle = $this->getParametre($_GET, 'idArticle');
                        $this->ctrlArticle->ajoutArticlePanier($idArticle, $panier);
                        $this->redirect("index.php?action=magasin");
                    } else {
                        $this->redirect("index.php?page=connexion");
                    }
                } //Validation de la commande par le TP
                else if ($_GET["action"] == "validerCommande") {

                    if (!empty($_POST)) {
                        $commandes = $this->getParametre($_POST, "commande");
                        foreach ($commandes as $idCommande)
                            $this->ctrlCommande->valideCommande($idCommande);
                        $this->redirect("index.php?page=connexion");
                    } else {
                        $this->redirect("index.php?page=connexion");
                    }

                }


            } else {
                require 'View/viewHome.php';
            }

        } catch (Exception $e) {
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
