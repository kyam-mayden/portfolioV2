<?php
require_once('displayFunctions.php');
$db = connectDatabase();

/**
 *The function retrieves the password from the database based off the userName, de-hashes DB password and compares to input password
 *
 * @param $enteredPassword string value
 * @param $enteredUName string value
 * @param $db PDO to draw from
 *
 * @return boolean result to confirm passwords match
 */
function pullAndComparePasswords(string $enteredPassword, string $enteredUName, PDO $db):bool {
    $query = $db->prepare("SELECT `password` FROM `users` WHERE `email` = :uName;");
    $query->bindParam(':uName', $enteredUName);
    $query->execute();
    $passwordDB = $query->fetch();
    return password_verify($enteredPassword, $passwordDB['password']);
}

function stripPassword(string $password):string {
    $string1 = trim($password);
    $string2 = htmlspecialchars($string1);
    return stripslashes($string2);
}

function ifLoggedIn($loggedIn) {
    if ($loggedIn) {
        header('Location:cms/index.php');
    } else {
        header('Location: login.php');
    }
}

function logIn($username, $password, $db) {
    $password = stripPassword($password);
    $return = false;
    if (pullAndComparePasswords($password, $username, $db)) {
        $return = true;
    }
    return $return;
}