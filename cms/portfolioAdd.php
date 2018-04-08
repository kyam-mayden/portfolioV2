<?php
session_start();
require_once('../php/displayFunctions.php');
require_once('../php/cmsLogic.php');

$imgArr = getImgDropDown($db);

if(!empty($_POST['name'])){
    addProject($_POST,$db);
} else{}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Kyam Harris | Edit page</title>
    <link rel="stylesheet" type="text/css" href="../css/cmsStyles.css">
</head>
<body>
    <a href="index.php">back to main page</a>
    <h1>Add some stuff</h1>
    <div>
        <form method="POST" action="portfolioAdd.php">
            <div>
                <label for="name">Project Name</label>
                <input type="text" name="name" placeholder="Enter new project name">
            </div>
            <div>
                <label for="url">URL</label>
                <input type="text" name="url" placeholder="Enter new project URL">
            </div>
            <div>
                <label for="description">Description</label>
                <textarea cols="60" rows="6" type="text" name="description" placeholder="Enter new project description"></textarea>
            </div>
            <div>
                <label for="github">Github URL</label>
                <input type="text" name="github" placeholder="Enter new project github URL">
            </div>
            <div>
                <label for="date">Creation date</label>
                <input type="date" name="date" placeholder="Enter creation date">
            </div>
<!--            <label for="picSelect">Select picture</label>-->
<!--            <select name="picSelect">-->
<!--                --><?php //echo makeDropDown($imgArr) ?>
<!--            </select>-->
            <input type="submit">
        </form>
    </div>
</body>
</html>