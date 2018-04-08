<?php
session_start();
require_once('../php/displayFunctions.php');
require_once('../php/cmsLogic.php');

$projectArray=portfolioList($db);

$projectFill=getProject($_POST,$db);

//var_dump($projectFill);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Kyam Harris | Edit page</title>
    <link rel="stylesheet" type="text/css" href="../css/cmsStyles.css">
</head>
<body>
<a href="index.php">back to main page</a>
<h1>Edit some stuff</h1>
<div>
    <form method="POST" action="portfolioEdit.php">
        <label for="projectSelect">Select project</label>
        <select name="projectSelect">
            <?php echo makeDropDown($projectArray) ?>
        </select>
        <input type="submit">
    </form>
    <form method="POST" action="portfolioEdit.php">
        <input type="hidden" name="id" value="<?php echo $projectFill['id']?>" >
        <div>
            <label for="name">Project Name</label>
            <input type="text" name="name" value="<?php echo $projectFill['name']?>">
        </div>
        <div>
            <label for="url">URL</label>
            <input type="text" name="url" value="<?php echo $projectFill['url']?>">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea cols="60" rows="6" type="text" name="description"><?php echo trim($projectFill['description'])?>
            </textarea>
        </div>
        <div>
            <label for="github">Github URL</label>
            <input type="text" name="github" value="<?php echo $projectFill['github']?>">
        </div>
        <div>
            <label for="date">Creation date</label>
            <input type="date" name="date"  value="<?php echo $projectFill['date']?>">
        </div>
        <input type="submit">
    </form>
</div>
</body>
</html>