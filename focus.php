<?php
require_once('displayFunctions.php');
$focus=buildFocus($db,$_GET['id']);
$skills=buildSkills($db,$_GET['id']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Kyam Harris | Portfolio</title>
	<link rel="stylesheet" type="text/css" href="normalize.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" type="text/css" href="portfolioStyles.css">
    <link rel="stylesheet" type="text/css" href="focus.css">

    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto+Condensed" rel="stylesheet">
</head>
<body>
<header>
    <nav>
        <div class="interiorLinks">
            <a href="index.php" class="hvr-underline-from-left">Home</a>
            <a href="portfolio.php" class="hvr-underline-from-left">Portfolio</a>
        </div>
        <div class="contact">
            <a href="https://twitter.com/KyamLeigh" id="twitter" target="_blank">
                <img src="assets/contact/twitter.svg">
            </a>
            <a href="https://www.linkedin.com/in/kyam-harris-8715027a/" id="linkedIn" target="_blank">
                <img src="assets/contact/linkedIn.svg">
            </a>
            <a href="https://github.com/marty-crane" id="github" target="_blank">
                <img src="assets/contact/github.svg">
            </a>
            <a href="mailto:kyam.lh@googlemail.com?Subject=Portfolio.." id="email" target="_blank">
                <img src="assets/contact/email.png">
            </a>

        </div>
    </nav>
</header>
<main class="showcase">
    <div class="container" id="showcase">
        <h1>
            Focus
        </h1>
    </div>
    <section class="container">
            <article class="focusItem">
                <h1 id="title"> <?php echo $focus['name']?> </h1>
                <h3><?php echo $focus['date']?></h3>
                <div class="links">
                    <a href="<?php echo $focus['github']?>" class="portfolioGithub" id="github" target="_blank">
                        <img src="assets/contact/github.svg">
                    </a>
                    <a href="<?php echo $focus['url']?>" class="portfolioGithub" id="github" target="_blank">
                        <img src="assets/contact/url.ico">
                    </a>
                </div>
                <img class='portfolioImg' src="<?php echo $focus['path']?>" alt="<?php echo $focus['alt']?>"/>
                <div class="focusText">
                    <p class="skills"><?php echo $skills?></p>
                    <p class="description"><?php echo $focus['description']?></p>
                </div>
            </article>
    </section>
</main>
</body>
</html>