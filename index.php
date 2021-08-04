<?php

require __DIR__ . "/vendor/autoload.php";

use \Source\Entity\User;

if(isset($_POST['login'])){

	$obUser = new User();

	$obUser->login = $_POST['login'];
	$obUser->password = $_POST['password'];

	$obUser->cadastrar(); 

	var_dump($obUser);
	exit;

}

require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/layout/form.php';
require_once __DIR__ . '/layout/footer.php';

 ?>