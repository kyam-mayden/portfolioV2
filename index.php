<?php
require_once('displayFunctions.php');
$static = fillStatic($db);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Kyam Harris | Portfolio</title>
	<link rel="stylesheet" type="text/css" href="normalize.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto+Condensed" rel="stylesheet">
</head>
<body>
    <header>
        <img src="assets/jumbo.jpg">
        <nav>
            <div class="interiorLinks">
                <a href="#about" class="hvr-underline-from-left">About</a>
                <a href="#showcase" class="hvr-underline-from-left">Showcase</a>
                <a href="portfolio.php" class="hvr-underline-from-left">Portfolio</a>
            </div>
            <div class="contact">
                <a href="https://twitter.com/KyamLeigh" id="twitter" target="_blank">
                    <img src="assets/contact/twitter.svg" >
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
    <main class="about">
        <div class="container" id="about">
            <h1>
                <?php echo $static['title'];?>
            </h1>
        </div>
        <section class="container">
            <article class="left">
                <p><?php echo $static['about1'];?></p>
            </article>
            <article class="right">
                <p><?php echo $static['about2'];?></p>
            </article>
        </section>
        <section class ="skills container">
            <div class="skill">
                <img src="assets/skills/css.png"/>
            </div>
            <div class="skill">
                <img src="assets/skills/html.png"/>
            </div>
            <div class="skill">
                <img src="assets/skills/php.png"/>
            </div>
            <div class="skill">
                <img src="assets/skills/js.png"/>
            </div>
            <div class="skill">
                <img src="assets/skills/mysql.png"/>
            </div>
            <div class="skill">
                <img src="assets/skills/csm.png"/>
            </div>
        </section>
    </main>
    <main class="showcase">
        <div class="container" id="showcase">
            <h1>Showcase</h1>
        </div>
        <section class="container">
            <?php echo buildShowcase($db); ?>
        </section>
    </main>
</body>
</html>