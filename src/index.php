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
                <li href="https://github.com/SkwalExe/">Github<img src="/assets/github.png"></li>
            </ul>
        </div>

    </div>

    <div class="main">
        <p class="bio">Hello 👋 I'm Léopold Koprivnik Ibghy, aka SkwalExe. I'm a 14 y/o French 🇫🇷 programming 💻 and Linux 🐧 lover. I use GitHub everyday since 2022/02/12. I code in rust 🦀, bash 🐚, and web languages 🌐. I also love making online courses.</p>

        <h1 class="section">
            My projects
        </h1>
        <div class="tilesContainer">
            <div class="tiles">

                <?php projects() ?>

            </div>
        </div>
    </div>

    <div class="footer">
        © 2018-<?= date('Y') ?>, Léopold Koprivnik Ibghy, all rights reserved
        <br>This website is open source and is available on <a href="https://github.com/SkwalExe/skwal.net">GitHub</a>
    </div>

    <?php
    js("functions", "navbar", "links");
    ?>

</body>

</html>