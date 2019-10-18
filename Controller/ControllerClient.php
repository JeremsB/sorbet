<?php

require_once 'Model/Client.php';
require_once 'View/Vue.php';
require_once 'Model/Model.php';


class ControllerClient extends Model { //La classe hérite de Model pour récupérer la connexion a la bdd + l'exe des requêtes


	private $client;

	public function __construct() { //Construction de l'objet Client
		$this->client = new Client();
	}

	public function inscription($login , $nom , $mail){

		$existLogin = $this->client->loginExist($login); //Récupère le résultat de la fonction loginExist
		$existMail = $this->client->mailExist($mail); //Pareil pour le mail

		if($existLogin) { //Si la variable existLogin n'est pas vide (= code client est déjà utilisé), on affiche un message et on "redirige" vers la page d'inscription
			$_SESSION['flash']['danger'] = "Un utilisateur avec ce code existe déjà" ;
			header('Location:index.php?page=inscription');
		}

		else if($existMail) { //Pareil pour le mail
			$_SESSION['flash']['danger'] = "Un utilisateur avec cette adresse mail existe déjà" ;
			header('Location:index.php?page=inscription');
		}

		else { //Sinon on lance l'inscription

        //Génération du mot de passe
			$pwd = strtolower(uniqid(rand()));
		    $pwd = substr($pwd,2,10);
		    //on retire toutes les ambiguités
		    $pwd = strtr(
		        //dans
		        $pwd,
		        //remplacer
		        'o0ODQGCiIl15Ss7',
		        //par
		        'BEFHJKMNPRTUVWX'
		    );

			//mail
			/*
			$mail->Username = 'Algobzh@gmail.com'; // Votre adresse email d'envoi Algobzh
			$mail->Password = 'Algobreizh000?'; // Le mot de passe de cette adresse email Algobreizh000?
			
			//Envoi du mail
			##############################################

			//Stockage dans un fichier text

			$fp = fopen ("mdp.txt", "r+");
			fseek ($fp, 0);
			fputs ($fp, $pwd);
			fclose ($fp);
			*/

			$mailEnvoye = 1;

			if ($mailEnvoye == 1){
				//On ajoute l'utilisateur dans la base de données
				$this->client->ajoutClient($login, $nom, $mail, $pwd);

				//On redirige vers le formulaire de connexion
				$_SESSION['flash']['success'] = "Inscription réussie ! Un mail vous a été envoyé avec votre mot de passe ($pwd)" ;
				header('Location:index.php?page=connexion');
			}
			else {
				$_SESSION['flash']['danger'] = "Une erreur s'est produite lors de l'inscription, veuillez réessayer plus tard" ;
				header('Location:index.php?page=inscription');
			}
		} //ferme le 1er else
	}

	public function connexion($login, $pwd){

		$requete = $this->client->infosClient($login, $pwd); //Récupère les informations du client en fonction de son code client et de son mot de passe
		$infos = $requete->fetchobject(); //Récupère sous forme d'objet

		//Créé une session si les informations de l'utilisateur sont présentes dans la base de données
		if($infos) {
			$_SESSION['client'] = ["id"  => $infos->cl_id, "login" => $infos->cl_login, "profil" => $infos->cl_profil,];

			//Créé le tableau de session du panier
			$_SESSION["panier"] = [];

		}

		else { //Sinon affiche un message d'erreur
			$_SESSION['flash']['danger'] = "Les identifiants saisis sont incorrects" ;
		}

		//Redirection vers le compte
		header('Location:index.php?page=connexion');

	}

	//Retourne le code du client
    public function getCodeClient($idCommande){
        return $this->client->getCodeClient($idCommande)->fetch();
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

	//Désinscription
	public function desinscrire($idClient){
		$this->client->supprimerClient($idClient);
	}


}
?>
