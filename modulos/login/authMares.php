<?php

$username = $_POST["username"];
$password = $_POST["password"];


require_once('../../libprueba.php');

user_login($username, $password);

?>