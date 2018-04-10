<?php
require_once('../php/displayFunctions.php');

$db = connectDatabase();

function sanitizeString($string) {
    return filter_var($string, FILTER_SANITIZE_STRING);
}

function sanitizeUrl($url) {
    return filter_var($url, FILTER_SANITIZE_URL);
}

function sanitizeNum($num) {
    return filter_var($num, FILTER_SANITIZE_NUMBER_INT);

}

//get abouts
function getAbout (PDO $db):array {
    $query=$db->prepare("SELECT `name`, `content` FROM `static` ORDER BY `id` ASC;");
    $query->execute();
    return $query->fetchAll();
}

//update abouts

function updateAbout (array $postData,PDO $db) {
    $query = $db->prepare("UPDATE `static` SET `content`= :title WHERE  `id`=1");
    $query->bindValue(':title', sanitizeString($postData['title']));
    $query->execute();
    $query = $db->prepare("UPDATE `static` SET `content`= :about1 WHERE  `id`=2");
    $query->bindValue(':about1', sanitizeString($postData['about1']));
    $query->execute();
    $query = $db->prepare("UPDATE `static` SET `content`= :about2 WHERE  `id`=3");
    $query->bindValue(':about2', sanitizeString($postData['about2']));
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
        $dropDownString .= '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
    }
    return $dropDownString;
}

function addProject($postData, $db) {
    $query = $db ->prepare("INSERT INTO `portfolio` (`name`, `url`, `description`, `github`,`date`) 
                            VALUES (:name, :url, :description, :github, :date);");
    if(array_key_exists('name',$postData)) {
        $query->bindValue(':name', sanitizeString($postData['name']));
    };
    if(array_key_exists('url',$postData)) {
        $query->bindValue(':url', sanitizeUrl($postData['url']));
    };
    if(array_key_exists('description',$postData)) {
        $query->bindValue(':description', sanitizeString($postData['description']));
    };
    if(array_key_exists('github',$postData)) {
        $query->bindValue(':github', sanitizeUrl($postData['github']));
    };
    if(array_key_exists('date',$postData)) {
        $query->bindValue(':date', $postData['date']);
    };
    $query->execute();
}

/**
 * Gets portfolio items names from DB and turns into an array
 *
 * @param $db PDO to select from
 * @return array of pf item names
 */
function portfolioList (PDO $db):array {
    $query=$db->prepare("SELECT `id`, `name` FROM `portfolio` WHERE `deleted` = 0;");
    $query->execute();
    return $query->fetchall();
}

function getProject($postData, $db) {
    $query = $db->prepare("SELECT `id`,`name`,`url`,`description`,`github`,`date` 
                           FROM `portfolio` WHERE `id` = :id;");
    $query->bindParam(':id', $postData['projectSelect']);
    $query->execute();
    return $query->fetch();
}

function updateProject($postData, $db) {
    $query = $db->prepare("REPLACE `portfolio` (`id`,`name`,`url`,`description`,`github`,`date`)
                          VALUES(:id, :name, :url, :description, :github, :date);");
    $query->bindValue(':id', sanitizeNum($postData['id']));
    if(array_key_exists('name',$postData)) {
        $query->bindValue(':name', sanitizeString($postData['name']));
    };
    if(array_key_exists('url',$postData)) {
        $query->bindValue(':url', sanitizeUrl($postData['url']));
    };
    if(array_key_exists('description',$postData)) {
        $query->bindValue(':description', sanitizeString($postData['description']));
    };
    if(array_key_exists('github',$postData)) {
        $query->bindValue(':github', sanitizeUrl($postData['github']));
    };
    if(array_key_exists('date',$postData)) {
        $query->bindValue(':date', $postData['date']);
    };
    $query->execute();
}

function deleteProject($postData, $db){
    $query = $db->prepare("UPDATE `portfolio` SET `deleted`=1 WHERE `id`=:id;");
    if(array_key_exists('projectSelect', $postData)) {
        $query->bindParam(':id', $postData['projectSelect']);
    }
    $query->execute();
    return "project id:" .$postData['projectSelect'] . " deleted";
}

function getImages($db) {

}