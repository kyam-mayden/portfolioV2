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

/**
 * Gets the user-entered password and removes harmful characters
 *
 * @param string $password password
 * @return string cleansed password
 */
function stripPassword(string $password):string {
    $string1 = trim($password);
    $string2 = htmlspecialchars($string1);
    return stripslashes($string2);
}

/**
 * Redirects user based on log in success
 *
 * @param $loggedIn boolean from pullAndComparePasswords function
 */
function ifLoggedIn(bool $loggedIn) {
    if ($loggedIn) {
        header('Location:cms/index.php');
    } else {
        header('Location: login.php');
    }
}

/**
 * Returns boolean after cleansing and checking user inputs
 *
 * @param $username string user input
 * @param $password string user input
 * @param $db PDO
 * @return bool if password and username match database
 */
function logIn(string $username, string $password, $db):bool {
    $password = stripPassword($password);
    $return = false;
    if (pullAndComparePasswords($password, $username, $db)) {
        $return = true;
    }
    return $return;
}