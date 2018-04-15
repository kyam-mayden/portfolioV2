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
        $dropDownString .= "<option value=" . $item['id'] . ">" . $item['name'] . "</option>";
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
    $query=$db->prepare("SELECT `id`,`name`, `portfolioItem` FROM `images`
                         WHERE deleted=0;");
    $query->execute();
    return $query->fetchall();
}

function editImage($postData, $db) {
    $query = $db->prepare("UPDATE `images` SET `portfolioItem`=:project WHERE `id`=:id;");
    $query->bindParam(':project', $postData['projectSelect']);
    $query->bindParam(':id', $postData['picSelect']);
    $query->execute();
}

function getImageTable($db) {
    $query=$db->prepare("SELECT `images`.`name` AS 'image', `portfolio`.`name` AS 'project'
                         FROM `images`
                         LEFT JOIN `portfolio`
                         ON `images`.`portfolioItem`
                         =`portfolio`.`id`
                         ;");
    $query->execute();
    return $query->fetchall();
}

function buildImageTable($images) {
    $string="";
    foreach ($images as $item) {
        if($item['project'] == null) {
            $item['project']="no project set";
        }
        $string .= "<p>" . $item['image'] ." - " . $item['project'] . "</p>";
    };
    return $string;
}

function deleteImage($postData, $db){
    $query = $db->prepare("UPDATE `images` SET `deleted`=1 WHERE `id`=:id;");
    if(array_key_exists('deleteSelect', $postData)) {
        $query->bindParam(':id', $postData['picSelect']);
    }
    $query->execute();
    return "image id:" .$postData['picSelect'] . " deleted";
}

function addImage($postData, $db, $target_file) {
    $query = $db->prepare("INSERT INTO `images` (`path`,`name`,`alt`,`portfolioItem`)
                    VALUES(:path, :name, :alt, :portfolioItem)");
    $path = ltrim($target_file,"../");
    $query -> bindParam(':path', $path);
    $query -> bindParam(":name", $postData['name']);
    $query -> bindParam(":alt", $postData['alt']);
    $query -> bindParam(":portfolioItem", $postData['projectSelect']);
    $query->execute();
}

function getAcceptedSkills($db) {
    $query = $db->prepare("SELECT `id`, `name` FROM `acceptedSkills`
                           WHERE `deleted`=0;");
    $query->execute();
    return $query->fetchall();
}

function buildSkillList($skills) {
    $string="";
    foreach ($skills as $skill) {
        $string.="<li>" . $skill['name'] . "</li>";
    }
    return $string;
}

function addSkill($postData, $db) {
    $query = $db->prepare("INSERT INTO `acceptedSkills` (`name`)
                          VALUES (:name);");
    $query -> bindParam(':name', $postData['name']);
    $query -> execute();

}

function deleteSkill($postData, $db){
    $query = $db->prepare("UPDATE `acceptedSkills` SET `deleted`=1 WHERE `id`=:id;");
    if(array_key_exists('deleteSelect', $postData)) {
        $query->bindParam(':id', $postData['skillSelect']);
    }
    $query->execute();
    return "skill id:" .$postData['picSelect'] . " deleted";
}

function projectSkills($db, $postData) {
    $skills = getSkills($db, $postData['id']);
    $skillArray=[];
    foreach($skills as $skill){
        foreach($skill as $key => $value){
            array_push($skillArray, $value);
        }
    }
    return $skillArray;
}

function buildSkillsChecklist($skills, $db, $postData) {
    $projectSkills = projectSkills($db, $postData);
    $string="";
    foreach($skills as $skill) {
        if(in_array($skill['name'], $projectSkills)){
            $string.= "<div></div><label for='" . $skill['name'] . "'>" . $skill['name'] .
                "</label><input id=" .$skill['name']. " type='checkbox' checked></div>";
        } else {
            $string.= "<div><label for='" . $skill['name'] . "'>" . $skill['name'] .
                "</label><input id=" .$skill['name']. " type='checkbox'></div>";
        }
    }
    return $string;
}

function amendSkills() {

}