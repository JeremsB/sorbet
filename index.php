<?php
/*
function debug($var){
	echo "<pre>".var_export($var)."</pre>";
}
*/
session_start();

require 'Controller/Router.php';

$routeur = new Routeur();
$routeur->routerRequete();
