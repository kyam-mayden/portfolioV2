<?php
session_start();
require_once('../php/displayFunctions.php');
require_once('../php/cmsLogic.php');

if(array_key_exists('addSkill', $_POST)){
    addSkill($_POST, $db);
} if(array_key_exists('deleteSelect', $_POST)){
    deleteSkill($_POST, $db);
} if (array_key_exists('skillsChanges', $_POST)){
//    deleteSkills($_POST, $db);
    updateSkills($_POST, $db);
}

$projectArray=portfolioList($db);
$acceptedSkills=getAcceptedSkills($db);


//var_dump(buildSkillsChecklist($acceptedSkills, $db, $_POST));
var_dump($_POST);
//var_dump(projectSkills($db, $_POST));
//var_dump("||||||");
//var_dump($acceptedSkills);

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete a project</title>
    <link rel="stylesheet" type="text/css" href="../css/cmsStyles.css">
</head>
<body>
<a href="index.php">back to main page</a>
<ul><h1>List of accepted skills</h1>
    <?php echo buildSkillList($acceptedSkills);?>
</ul>
<h1>Add a skill
</h1>
<form method="POST" action="skills.php">
    <label for="name">Skill Name</label>
    <input type="text" name="name" placeholder="Enter new skill name">
    <input type="submit" name="addSkill">
</form>
<h1>Delete a skill</h1>
<form method="POST" action="skills.php">
    <label for="skillSelect" >Select image</label>
    <select name="skillSelect"><?php echo makeDropDown($acceptedSkills); ?>
    </select>
    <input type="submit" name="deleteSelect">
</form>

<h1>Add/remove skills from project</h1>

<form method="POST" action="skills.php">
    <label for="projectSelect">Select project</label>
    <select name="id">
        <?php echo makeDropDown($projectArray) ?>
    </select>
    <input type="submit" name="projectSelect">
</form>

<form method="POST" action="skills.php">
    <ul class="checkBoxes">
        <input type="hidden" name="project" value="<?php echo $_POST['id'] ?>">
        <?php echo buildSkillsChecklist($acceptedSkills, $db, $_POST) ?>
    </ul>
    <input type="submit" name="skillsChanges">
</form>