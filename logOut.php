<?php

session_start();

unset($_SESSION['loggedIn']);


unset($_SESSION['failedLogIn']);

session_destroy();

header('Location: index.php');
