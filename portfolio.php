<?php
require_once('displayFunctions.php');

?>


<!DOCTYPE html>
<html>
<head>
	<title>Kyam Harris | Portfolio</title>
	<link rel="stylesheet" type="text/css" href="normalize.css">
	<link rel="stylesheet" type="text/css" href="Styles.css">
    <link rel="stylesheet" type="text/css" href="portfolioStyles.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto+Condensed" rel="stylesheet">
</head>
<body>
<header>
    <img src="assets/jumbo.jpg">
    <nav>
        <div class="interiorLinks">
            <a href="index.php" class="hvr-underline-from-left">Home</a>
            <a href="#showcase" class="hvr-underline-from-left">Showcase</a>
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
            Portfolio
        </h1>
<!--        <form name="search" class="searchBar">-->
<!--            <input type="text" id ="skillsSearch" placeholder="Search by skill..." />-->
<!--            <input type="submit">-->
<!--        </form>-->
    </div>
    <section class="gridContainer">
        <?php echo buildPortfolio($db) ?>
<!--        <article class="portfolioOuter">-->
<!--            <div class="portfolioItem">-->
<!--                <img src="assets/portfolio/download.jpeg"/>-->
<!--                <a href="#">Portfolio Item</a>-->
<!--                <p class="skillList"> LIST OF SKILLSLIST OF SKILLSLIST OF SKILLSLIST OF SKILLSLIST OF SKILLSLIST OF SKILLSv-->
<!--                </p>-->
<!--            </div>-->
<!--        </article>-->
<!--        <article class="portfolioOuter">-->
<!--            <div class="portfolioItem">-->
<!--                <img src="assets/portfolio/download.jpeg"/>-->
<!--                <a href="#">Portfolio Item</a>-->
<!--                <p class="skillList"> LIST OF SKILLS</p>-->
<!--            </div>-->
<!--        </article>-->
<!--        <article class="portfolioOuter">-->
<!--            <div class="portfolioItem">-->
<!--                <img src="assets/portfolio/download.jpeg"/>-->
<!--                <a href="#">Portfolio Item</a>-->
<!--                <p class="skillList"> LIST OF SKILLS</p>-->
<!--            </div>-->
<!--        </article>-->
<!--        <article class="portfolioOuter">-->
<!--            <div class="portfolioItem">-->
<!--                <img src="assets/portfolio/download.jpeg"/>-->
<!--                <a href="#">Portfolio Item</a>-->
<!--                <p class="skillList"> LIST OF SKILLS</p>-->
<!--            </div>-->
<!--        </article>-->
<!--        <article class="portfolioOuter">-->
<!--            <div class="portfolioItem">-->
<!--                <img src="assets/portfolio/download.jpeg"/>-->
<!--                <a href="#">Portfolio Item</a>-->
<!--                <p class="skillList"> LIST OF SKILLS</p>-->
<!--            </div>-->
<!--        </article>-->
<!--        <article class="portfolioOuter">-->
<!--            <div class="portfolioItem">-->
<!--                <img src="assets/portfolio/download.jpeg"/>-->
<!--                <a href="#">Portfolio Item</a>-->
<!--                <p class="skillList"> LIST OF SKILLS</p>-->
<!--            </div>-->
<!--        </article>-->
<!--        <article class="portfolioOuter">-->
<!--            <div class="portfolioItem">-->
<!--                <img src="assets/portfolio/download.jpeg"/>-->
<!--                <a href="#">Portfolio Item</a>-->
<!--                <p class="skillList"> LIST OF SKILLS</p>-->
<!--            </div>-->
<!--        </article>-->
    </section>
</main>
</body>
</html>