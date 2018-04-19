<?php
require_once('php/displayFunctions.php');
require('php/adminFunctions.php');

session_start();

var_dump($_POST);


var_dump(stripPassword($_POST['password']));

$_SESSION['loggedIn']=logIn($_POST['username'],$_POST['password'],$db);

ifLoggedIn($_SESSION['loggedIn']);