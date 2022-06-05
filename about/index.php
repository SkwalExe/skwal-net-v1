<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    defaultHeaders();
    css("colors", "global",  "footer", "layout", "markup", "loadingScreen", "navbar", "tiles");
    ?>

</head>

<body>

    <?php
    navbarStart();
    navbarButton('<img src="https://ko-fi.com/img/githubbutton_sm.svg" alt="">', "https://ko-fi.com/W7W7AMXI6");
    navbarButton("Home", "/", "home.png");

    navbarEnd();
    ?>

    <div class="mainContainer">
        <div class="main">
            <div class="content">

                <h1 class="glowing box center">
                    About skwal.net
                </h1>

                <div class="box glowing markup">
                    <img src="/assets/photo.png" alt="">
                    <p>Hi! My name is <span class="blue">Léopold Koprivnik Ibghy</span>, I founded skwal.net in <span class="blue">2018</span> and I continue to maintain it.</p>
                    <p>I am a 14 years old french student, <span class="red">I love FOSS</span> (Free and Open Source Software)</p>
                    <p>I'm a big fan of <span class="purp">Linus Torvalds</span> and I am very interested in <span class="green">the history of linux</span>, one day, I want to create my own distro</p>
                    <hr>
                    <p>I created this website to make a place where you will be able to find cool stuff !</p>
                    <p>And with the forum that I am currently creating, I want to make skwal.net a place where everyone can :</p>
                    <ul>
                        <li>Share their creations and knowledge</li>
                        <li>Ask any question</li>
                        <li>Help me to improve my projects and more...</li>
                    </ul>
                    <hr>
                    <p>I hope you will enjoy it and I hope you will find something interesting !</p>
                    <p>If you have any question, feel free to contact me on my <a href="mailto:skwal.net@gmail.com">email</a></p>
                </div>


            </div>
            <hr class=" onlyShowWhenMobileWidth">
            <div class="sidebar">
                <h1 class="glowing box center">
                    Links
                </h1>
                <div class="links box glowing">
                    <a _href="https://github.com/SkwalExe/"><img src="/assets/github.png" alt="">Github</a>
                    <a _href="https://discord.skwal.net"><img src="/assets/discord.png" alt="">Discord</a>
                    <a _href="https://twitter.com/@SkwalExe"><img src="/assets/twitter.png" alt="">Twitter</a>
                </div>

                <hr>

                <h1 class="glowing box center">
                    Pages
                </h1>
                <?php
                pages();
                ?>

                <hr>

                <h1 class="glowing box center">
                    Projects
                </h1>
                <?php
                projects();
                ?>
            </div>
        </div>
    </div>
    <?php

    footer();
    loadingScreen();

    js("functions", "global", "navbar", "links", "tiles", "loadingScreen");
    ?>

</body>

</html>