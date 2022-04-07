<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    defaultHeaders();
    css("colors", "navbar", "global", "tiles", "main", "footer");
    ?>

</head>

<body>

    <div class="navbar">
        <div class="container">

            <div class="nav-top">
                <div _href="https://github.com/SkwalExe/" class="logo">
                    <img src="assets/github.png" alt="">
                    <p class="text"><span class="purp">Skwal</span><span>Exe</span></p>
                </div>
                <div class="menu" id="toggleButton">
                    <div class="menu-line"></div>
                    <div class="menu-line"></div>
                    <div class="menu-line"></div>
                </div>

            </div>
            <ul id="navList">
                <li href="/">Home<img src="/assets/home.png"></li>
            </ul>
        </div>

    </div>

    <div class="main">

    </div>

    <?php

    footer();

    js("functions", "navbar", "links");
    ?>

</body>

</html>