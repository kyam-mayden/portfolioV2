<?php
session_start();
require_once('../php/displayFunctions.php');
require_once('../php/cmsLogic.php');
require_once('../php/imageUpload.php');

if(array_key_exists('deleteSelect', $_POST)){
    echo deleteImage($_POST, $db);
} elseif (array_key_exists('amendProject', $_POST)) {
    editImage($_POST,$db);
} elseif (array_key_exists('addImage',$_POST)){
    addImage($_POST, $db, $target_file);
}

$projectArray=portfolioList($db);
$imageArray=getImages($db);
$imageGet=getImageTable($db);
$imageList=buildImageTable($imageGet);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Images lol</title>
    <link rel="stylesheet" type="text/css" href="../css/cmsStyles.css">
</head>
<body>
<a href="index.php">back to main page</a>
Project -- Image
<?php echo $imageList?>

<form action="images.php" method="POST">
    <h1>Edit an image/project association</h1>
    <label for="picSelect" >Select image</label>
    <select name="picSelect"><?php echo makeDropDown($imageArray); ?>
    </select>
    <label for="projectSelect">Select project</label>
    <select name="projectSelect"><?php echo makeDropDown($projectArray); ?>
    </select>
    <input type="submit" name="amendProject">
</form>

<h1>Upload a new image</h1>
<form action="images.php" method="post" enctype="multipart/form-data">
    <label for="projectSelect">Select project</label>
    <select name="projectSelect"><?php echo makeDropDown($projectArray); ?>
    </select>
    <label for="name">Image name</label>
    <input type="text" name="name">
    <label for="alt">Image alt</label>
    <input type="text" name="alt">
    <label for="project">Project</label>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="addImage">
</form>

<h1>Delete some shit</h1>
<div>
    <form method="POST" action="images.php">
        <label for="picSelect">Select image to delete</label>
        <select name="picSelect">
            <?php echo makeDropDown($imageArray); ?>
        </select>
        <input type="submit" name="deleteSelect">
    </form>
</div>

</body>
</html>
