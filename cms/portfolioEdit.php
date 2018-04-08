<?php
session_start();
require_once('../php/displayFunctions.php');
require_once('../php/cmsLogic.php');

$projectArray=portfolioList($db);

var_dump($_POST);

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
    <form method="POST" action="portfolioEdit.php">
        <label for="projectSelect">Select project</label>
        <select name="projectSelect">
            <?php echo makeDropDown($projectArray) ?>
        </select>
        <input type="submit">
    </form>
    <form method="POST" action="portfolioAdd.php">
        <input type="hidden" name="id" value="ID FROM ARRAY">
        <div>
            <label for="name">Project Name</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="url">URL</label>
            <input type="text" name="url">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea cols="60" rows="6" type="text" name="description"></textarea>
        </div>
        <div>
            <label for="github">Github URL</label>
            <input type="text" name="github">
        </div>
        <div>
            <label for="date">Creation date</label>
            <input type="date" name="date">
        </div>
        <input type="submit">
    </form>
</div>
</body>
</html>