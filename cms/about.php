<?php
session_start();
require_once('../php/displayFunctions.php');
require_once('../php/cmsLogic.php');

$maxTitle=30;
$maxAbout=220;

if(!empty($_POST['title']) && !(strlen($_POST['title'])>$maxTitle) && !(strlen($_POST['about1'])>$maxAbout) && !(strlen($_POST['about2'])>$maxAbout)) {
    updateAbout($_POST,$db);
} else {
    if (strlen($_POST['title'])>$maxTitle) {
        echo "title length too long";
    }
    elseif (strlen($_POST['about1'])>$maxAbout) {
        echo "about me 1 length too long";
    }
    elseif (strlen($_POST['about2'])>$maxAbout) {
        echo "about me 2 length too long";
    }
    else{}
}

//var_dump(getAbout($db));
$title = getAbout($db)[0];
$about1 = getAbout($db)[1];
$about2 = getAbout($db)[2];
//var_dump($_POST);
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
    <form method="POST" action="about.php">
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" value="<?php echo trim($title['content'])?>">
        </div>
        <div>
            <label for="about1">About me 1</label>
            <textarea name="about1" type="text" cols="60" rows="6"> <?php echo trim($about1['content'])?></textarea>
        </div>
        <div>
            <label for="about2">About me 2</label>
            <textarea name="about2" type="text" cols="60" rows="6"> <?php echo trim($about2['content'])?></textarea>
        </div>
        <input type="submit">
    </form>


</body>
