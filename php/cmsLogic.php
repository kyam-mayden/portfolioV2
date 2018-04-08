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

function getImgDropDown (PDO $db):array {
    $query=$db->prepare("SELECT `id`,`path` FROM `images` WHERE `deleted` =0;");
    if ($query->execute()) {
        $items=$query->fetchall();
        return $items;
    } else {
        echo 'Image list error';
    }
}

/**
 * Takes an array of $items and turns into a string to make a drop-down list
 *
 * @param $items array of items (options) to be made into a drop-down
 * @return string of options
 */
function makeDropDown (array $items): string {
    $dropDownString = "";
    foreach ($items as $item) {
        $dropDownString .= '<option value="' . $item['id'] . '">' . $item['path'] . '</option>';
    }
    return $dropDownString;
}

function addProject($postData, $db) {
    $query = $db ->prepare("INSERT INTO `portfolio` (`name`, `url`, `description`, `github`,`date`) 
                            VALUES (:name, :url, :description, :github, :date);");
    if(array_key_exists('name',$postData)) {
        $query->bindValue(':name', $postData['name']);
    };
    if(array_key_exists('url',$postData)) {
        $query->bindValue(':url', $postData['url']);
    };
    if(array_key_exists('description',$postData)) {
        $query->bindValue(':description', $postData['description']);
    };
    if(array_key_exists('github',$postData)) {
        $query->bindValue(':github', $postData['github']);
    };
    if(array_key_exists('date',$postData)) {
        $query->bindValue(':date', $postData['date']);
    };
    $query->execute();
}
