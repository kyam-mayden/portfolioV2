<?php

session_start();

//if($_SESSION['loggedIn'] === true) {
//    header('Location: cms/index.php');
//}
//
//if($_SESSION['failedLogIn'] === true){
//    echo 'You already tried to log in, do not mess this shit up';
//}

?>

<h1> User Log In</h1>

<form method="POST" action="cms/index.php">
    <label for="username">Username </label>
    <input type="text" name="username"><br>
    <label for="password">Password</label>
    <input type ="text" name="password">
    <input type="submit">
