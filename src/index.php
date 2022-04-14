<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    defaultHeaders();
    css("colors", "global", "footer", "loadingScreen", "layout");
    ?>

</head>

<body>



    <?php

    navbarStart();
    navbarButton("Cow Translator 🐄", "/cowTranslator");
    navbarButton("About", "/about");
    navbarButton("Github", "https://github.com/SkwalExe/", "github.png");
    navbarEnd();

    ?>

    <div class="mainContainer">

        <div class="main">
            <div class="content">
                <div class="box glowing">
                    <h1 class="section">
                        Pages
                    </h1>
                </div>
                <div class="tiles">
                    <?php

                    pages();

                    ?>
                </div>
            </div>
            <hr class="onlyShowWhenMobileWidth">
            <div class="sidebar">

                <div class="links box glowing">
                    <a _href="https://github.com/SkwalExe/"><img src="/assets/github.png" alt="">Github</a>
                    <a _href="https://discord.skwal.net"><img src="/assets/discord.png" alt="">Discord</a>
                    <a _href="https://twitter.com/@SkwalExe"><img src="/assets/twitter.png" alt="">Twitter</a>
                    <a _href="/about"><img src="/assets/question.png" alt="">About</a>
                </div>

                <hr>


                <div class="oneColumnTiles">
                    <h1 class="sideBarTitle">
                        My projects
                    </h1>
                    <?php
                    projects();
                    ?>
                </div>

            </div>
        </div>
    </div>


    <?php

    footer();
    loadingScreen();
    js("functions", "global",  "navbar", "links", "tiles", "loadingScreen");
    ?>

</body>

</html>