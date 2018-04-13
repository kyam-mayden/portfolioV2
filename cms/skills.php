<?php
session_start();
require_once('../php/displayFunctions.php');
require_once('../php/cmsLogic.php');




if(array_key_exists('addSkill', $_POST)){
    addSkill($_POST, $db);
} if(array_key_exists('deleteSelect', $_POST)){
    deleteSkill($_POST, $db);
}


$skills=getAcceptedSkills($db);
var_dump($_POST);
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
    <?php echo buildSkillList($skills);?>
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
    <select name="skillSelect"><?php echo makeDropDown($skills); ?>
    </select>
    <input type="submit" name="deleteSelect">
</form>




assign skills to project in th is page

<li>Name</li>