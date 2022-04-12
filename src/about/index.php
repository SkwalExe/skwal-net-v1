<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    defaultHeaders();
    css("colors", "global",  "footer", "layout", "markup");
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

                <div class="box glowing markup">
                    <h1>SkwalExe</h1>

                    <img src="/assets/banner.png" alt="">

                    <h2>Short bio</h2>

                    <p><?= $bio ?></p>

                    <h2>Skills</h2>
                    <div class="flexwrap">
                        <ul>
                            <li>🦀 Rust</li>
                            <li>🐘 PHP</li>
                            <li>🌐 Javascript</li>
                            <li>🌐 HTML5</li>
                            <li>🌐 CSS3</li>
                            <li>🐚 Shell</li>
                            <li>🤓 C</li>
                        </ul>
                        <img src="https://github-readme-stats.vercel.app/api/top-langs/?username=SkwalExe&theme=dracula&layout=compact" alt="">
                    </div>




                </div>


            </div>
            <hr class="onlyShowWhenMobileWidth">
            <div class="sidebar">

                <div class="links box glowing">
                    <a _href="https://github.com/SkwalExe/"><img src="/assets/github.png" />Github</a>
                    <a _href="https://discord.skwal.net"><img src="/assets/discord.png" alt="">Discord</a>
                </div>

                <hr>

                <div class="oneColumnTiles">
                    <?php
                    pages();
                    ?>
                </div>

                <hr>

                <div class="oneColumnTiles">
                    <?php
                    projects();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php

    footer();

    js("functions", "navbar", "links", "tiles");
    ?>

</body>

</html>