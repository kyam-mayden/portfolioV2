<?php
require_once('php/displayFunctions.php');
require('php/adminFunctions.php');

session_start();

$_SESSION['loggedIn']=logIn($_POST['username'],$_POST['password'],$db);

ifLoggedIn($_SESSION['loggedIn']);