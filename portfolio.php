<?php
require_once('php/displayFunctions.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Kyam Harris | Portfolio</title>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/portfolioStyles.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto+Condensed" rel="stylesheet">
</head>
<body>
<header>
    <img src="assets/jumbo.jpg">
    <nav>
        <div class="interiorLinks">
            <a href="index.php" class="hvr-underline-from-left">Home</a>
            <a href="#portfolio" class="hvr-underline-from-left">Portfolio</a>
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
<main id="portfolio">
    <div class="container">
        <h1 id="portfolioTitle">
            Portfolio
        </h1>
<!--        <form name="search" class="searchBar">-->
<!--            <input type="text" id ="skillsSearch" placeholder="Search by skill..." />-->
<!--            <input type="submit">-->
<!--        </form>-->
    </div>
    <section class="gridContainer">
        <?php echo buildPortfolio($db) ?>
    </section>
    <footer>
        <a href="login.php">Admin login</a>
    </footer>
</main>
</body>
</html>