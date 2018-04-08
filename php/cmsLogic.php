<?php
require_once('../php/displayFunctions.php');

$db = connectDatabase();

//get abouts
function getAbout (PDO $db):array {
    $query=$db->prepare("SELECT `name`, `content` FROM `static` ORDER BY `id` ASC;");
    $query->execute();
    return $query->fetchAll();
}

//update abouts

function updateAbout (array $postData,PDO $db) {
    $query = $db->prepare("UPDATE `static` SET `content`= :title WHERE  `id`=1");
    $query->bindValue(':title', $postData['title']);
    $query->execute();
    $query = $db->prepare("UPDATE `static` SET `content`= :about1 WHERE  `id`=2");
    $query->bindValue(':about1', $postData['about1']);
    $query->execute();
    $query = $db->prepare("UPDATE `static` SET `content`= :about2 WHERE  `id`=3");
    $query->bindValue(':about2', $postData['about2']);
    $query->execute();
}
