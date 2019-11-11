<?php

require_once 'Model/Friend.php';
require_once 'View/Vue.php';
require_once 'Model/Model.php';


class ControllerFriend extends Model { //La classe hérite de Model pour récupérer la connexion a la bdd + l'exe des requêtes

    private $friend;

    public function __construct() { //Construction de l'objet Friend
        $this->friend = new Friend();
    }

    public function getOtherUsers($id1, $id2) {
        return $this->friend->getOthers($id1, $id2);
    }

    public function getUserAskedFriends($id) {
        return $this->friend->getAsked($id);
    }

    public function getUserFriends($id) {
        return $this->friend->getFriends($id);
    }

    public function getUserFriendRequest($id) {
        return $this->friend->friendRequest($id);
    }

    public function addAsFriend($user_id, $target_id){
        if (($this->friend->checkFriendship1($user_id, $target_id) == null) && ($this->friend->checkFriendship2($user_id, $target_id) == null)) {
            $this->friend->addFriend($user_id, $target_id);
        }
    }

    public function acceptFriendship($userA, $target_id) {
        $this->friend->acceptFriend($userA, $target_id);
        $this->friend->mutual($target_id, $userA);
    }

    public function deleteFriendship($id1, $id2) {
        $this->friend->delete($id1, $id2);
        $this->friend->delete($id2, $id1);
    }

    public function refuseRequest($id1, $id2) {
        $this->friend->delete($id1, $id2);
    }

    public function cancelAsk($id1, $id2) {
        $this->friend->delete($id1, $id2);
    }

    public function friendNumber($id) {
        $test = $this->friend->number($id)->fetch();
        return $test[0];
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

}