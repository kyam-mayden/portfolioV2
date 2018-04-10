<?php
session_start();
require_once('../php/displayFunctions.php');
require_once('../php/cmsLogic.php');

deleteProject($_POST, $db);

$projectArray=portfolioList($db);
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
    <h1>Delete some shit</h1>
    <div>
        <form method="POST" action="portfolioDelete.php">
            <label for="projectSelect">Select project</label>
            <select name="projectSelect">
                <?php echo makeDropDown($projectArray) ?>
            </select>
            <input type="submit" name="deleteSelect">
        </form>
    </div>
</body>
</html>
