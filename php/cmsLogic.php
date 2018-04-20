<?php
require_once('../php/displayFunctions.php');

$db = connectDatabase();

/**
 * applies string sanitizer to input
 *
 * @param $string string to sanitize
 *
 * @return string sanitized
 */
function sanitizeString(string $string): string{
    return filter_var($string, FILTER_SANITIZE_STRING);
}

/**
 * applies url sanitizer to input
 *
 * @param $url string to sanitize
 *
 * @return string
 */
function sanitizeUrl(string $url):string {
    return filter_var($url, FILTER_SANITIZE_URL);
}

/**
 * applies sanitizer to number
 *
 * @param $num integer/float to sanitize
 *
 * @return integer/float
 */
function sanitizeNum($num) {
    return filter_var($num, FILTER_SANITIZE_NUMBER_INT);
}

/**
 * Selects name, content from DB
 *
 * @param PDO $db
 *
 * @return array of content
 */
function getAbout (PDO $db):array {
    $query=$db->prepare("SELECT `name`, `content` FROM `static` ORDER BY `id` ASC;");
    $query->execute();
    return $query->fetchAll();
}

/**
 * Applies user changes to DB for static content
 *
 * @param array $postData of user inputs
 * @param PDO $db
 */
function updateAbout (array $postData, PDO $db) {
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

/**
 * Gets array of images to create a drop-down menu
 *
 * @param PDO $db
 *
 * @return array of image id and path
 */
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
 *
 * @return string of options
 */
function makeDropDown (array $items): string {
    $dropDownString = "";
    foreach ($items as $item) {
        $dropDownString .= "<option value=" . $item['id'] . ">" . $item['name'] . "</option>";
    }
    return $dropDownString;
}

/**
 * Adds user input project changes to DB, cleanses inputs
 *
 * @param array $postData of user inputs
 * @param PDO $db
 */
function addProject(array $postData,PDO $db) {
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
 *
 * @return array of pf item names
 */
function portfolioList (PDO $db):array {
    $query=$db->prepare("SELECT `id`, `name` FROM `portfolio` WHERE `deleted` = 0;");
    $query->execute();
    return $query->fetchall();
}

/**
 * gets selected project data from DB
 *
 * @param array $postData user selection
 * @param PDO $db
 *
 * @return array of project data, or boolean if no selection
 */
function getProject(array $postData,PDO $db) {
    $query = $db->prepare("SELECT `id`,`name`,`url`,`description`,`github`,`date` 
                           FROM `portfolio` WHERE `id` = :id;");
    $query->bindParam(':id', $postData['projectSelect']);
    $query->execute();
    return $query->fetch();
}

/**
 * Inserts amended project data to DB
 *
 * @param array $postData of user amendments
 * @param PDO $db
 */
function updateProject(array $postData,PDO $db) {
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

/**
 * Adds deleted flag to selected project in DB
 *
 * @param array $postData of user selectiong
 * @param PDO $db
 *
 * @return string to inform user of deletion
 */
function deleteProject(array $postData,PDO $db):string {
    $query = $db->prepare("UPDATE `portfolio` SET `deleted`=1 WHERE `id`=:id;");
    if(array_key_exists('projectSelect', $postData)) {
        $query->bindParam(':id', $postData['projectSelect']);
    }
    $query->execute();
    return "project id:" .$postData['projectSelect'] . " deleted";
}

/**
 * Gets an array of images name & id
 *
 * @param PDO $db
 *
 * @return array of images
 */
function getImages(PDO $db):array {
    $query=$db->prepare("SELECT `id`,`name`, `portfolioItem` FROM `images`
                         WHERE deleted=0;");
    $query->execute();
    return $query->fetchall();
}

/**
 * Edits selected images data
 *
 * @param array $postData user selection
 * @param PDO $db
 */
function editImage(array $postData,PDO $db) {
    $query = $db->prepare("UPDATE `images` SET `portfolioItem`=:project WHERE `id`=:id;");
    $query->bindParam(':project', $postData['projectSelect']);
    $query->bindParam(':id', $postData['picSelect']);
    $query->execute();
}

/**
 * Gets images and corresponding projects
 *
 * @param PDO $db
 *
 * @return array of image names and project names
 */
function getImageTable(PDO $db):array {
    $query=$db->prepare("SELECT `images`.`name` AS 'image', `portfolio`.`name` AS 'project'
                         FROM `images`
                         LEFT JOIN `portfolio`
                         ON `images`.`portfolioItem`
                         =`portfolio`.`id`
                         WHERE `images`.`deleted` =0;");
    $query->execute();
    return $query->fetchall();
}

/**
 * Builds HTML elements from image array
 *
 * @param array $images images from DB
 *
 * @return string of HTML
 */
function buildImageTable(array $images):string {
    $string="";
    foreach ($images as $item) {
        if($item['project'] == null) {
            $item['project']="no project set";
        }
        $string .= "<p>" . $item['image'] ." - " . $item['project'] . "</p>";
    };
    return $string;
}

/**
 * Adds deleted flag to selected image in DB
 *
 * @param array $postData user selection
 * @param PDO $db
 *
 * @return string confirmation of deletion
 */
function deleteImage(array $postData,PDO $db):string {
    $query = $db->prepare("UPDATE `images` SET `deleted`=1 WHERE `id`=:id;");
    if(array_key_exists('deleteSelect', $postData)) {
        $query->bindParam(':id', $postData['picSelect']);
    }
    $query->execute();
    return "image id:" .$postData['picSelect'] . " deleted";
}

/**
 * Adds image to DB
 *
 * @param array $postData user input
 * @param PDO $db
 * @param string $target_file added image
 */
function addImage(array $postData,PDO $db,string $target_file) {
    $query = $db->prepare("INSERT INTO `images` (`path`,`name`,`alt`,`portfolioItem`)
                    VALUES(:path, :name, :alt, :portfolioItem)");
    $path = ltrim($target_file,"../");
    $query -> bindParam(':path', $path);
    $query -> bindParam(":name", $postData['name']);
    $query -> bindParam(":alt", $postData['alt']);
    $query -> bindParam(":portfolioItem", $postData['projectSelect']);
    $query->execute();
}

/**
 * Gets array of accepted skills
 *
 * @param PDO $db
 *
 * @return array of skills
 */
function getAcceptedSkills(PDO $db):array {
    $query = $db->prepare("SELECT `id`, `name` FROM `acceptedSkills`
                           WHERE `deleted`=0;");
    $query->execute();
    return $query->fetchall();
}

/**
 * Build HTML list items for input
 *
 * @param array $skills skills from DB
 *
 * @return string of HTML list elements
 */
function buildSkillList(array $skills):string {
    $string="";
    foreach ($skills as $skill) {
        $string.="<li>" . $skill['name'] . "</li>";
    }
    return $string;
}

/**
 * Adds new skill to DB
 *
 * @param array $postData user input
 * @param PDO $db
 */
function addSkill(array $postData,PDO $db) {
    $query = $db->prepare("INSERT INTO `acceptedSkills` (`name`)
                          VALUES (:name);");
    $query -> bindParam(':name', $postData['name']);
    $query -> execute();

}

/**
 * Add deleted flag to skill
 *
 * @param array $postData user selection
 * @param PDO $db
 *
 * @return string confirmation of deletion
 */
function deleteSkill(array $postData,PDO $db):string {
    $query = $db->prepare("UPDATE `acceptedSkills` SET `deleted`=1 WHERE `id`=:id;");
    if(array_key_exists('deleteSelect', $postData)) {
        $query->bindParam(':id', $postData['skillSelect']);
    }
    $query->execute();
    return "skill id:" .$postData['picSelect'] . " deleted";
}

/**
 * Gets list of skills for selected project
 *
 * @param PDO $db
 * @param array $postData user selection
 *
 * @return array of associated skills
 */
function projectSkills(PDO $db,array $postData):array {
    $skills = getSkills($db, $postData['id']);
    $skillArray=[];
    foreach($skills as $skill){
        foreach($skill as $key => $value){
            array_push($skillArray, $value);
        }
    }
    return $skillArray;
}

/**
 * Build HTML checkbox elements for skills
 *
 * @param array $skills all skills from DB
 * @param PDO $db
 * @param array $postData user selection of project
 *
 * @return string HTML checkbox elements
 */
function buildSkillsChecklist(array $skills,PDO $db,array $postData):string {
    $projectSkills = projectSkills($db, $postData);
    $string="";
    foreach($skills as $skill) {
        if(in_array($skill['name'], $projectSkills)){
            $string.= "<div></div><label for='" . $skill['name'] . "'>" . $skill['name'] .
                "</label><input name=".$skill['name']. " id=" .$skill['name']. " type='checkbox' checked></div>";
        } else {
            $string.= "<div><label for='" . $skill['name'] . "'>" . $skill['name'] .
                "</label><input name=".$skill['name']. " id=" .$skill['name']. " type='checkbox'></div>";
        }
    }
    return $string;
}

/**
 * Deletes skills for selected project
 *
 * @param array $postData user selection
 * @param PDO $db
 */
function deleteSkills(array $postData,PDO $db) {
    $query = $db->prepare("UPDATE `skills` SET `deleted`=1 WHERE `portfolioID`=:id;");
    $query->bindParam(':id', $postData['project']);
    $query->execute();
}

/**
 * Updates project skills on user input
 *
 * @param array $postData user input
 * @param PDO $db
 */
function updateSkills(array $postData,PDO $db) {
    forEach($postData as $key=>$value){
        if($key!="project" && $key!="skillsChanges") {
            $query = $db->prepare("INSERT INTO `skills`(`skill`,`portfolioID`) VALUES (:skill, :project);");
            $query->bindParam(':skill', $key);
            $query->bindParam(':project', $postData['project']);
            $query->execute();
        }
    }
}


