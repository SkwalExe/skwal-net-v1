<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    defaultHeaders();
    css("colors", "global", "footer", "loadingScreen", "layout", "navbar", "notifications", "tiles");
    ?>

</head>

<body>



    <?php

    navbarStart();
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
                <h1 class="sideBarTitle">
                    Links
                </h1>
                <div class="links box glowing">
                    <a _href="https://github.com/SkwalExe/"><img src="/assets/github.png" alt="">Github</a>
                    <a _href="https://discord.skwal.net"><img src="/assets/discord.png" alt="">Discord</a>
                    <a _href="https://twitter.com/@SkwalExe"><img src="/assets/twitter.png" alt="">Twitter</a>
                    <a _href="/about"><img src="/assets/question.png" alt="">About</a>
                    <a _href="https://www.paypal.com/paypalme/SkwalDev"><img src="/assets/paypal.png" alt="">Paypal</a>
                    <a _href="https://liberapay.com/SkwalExe"><img src="/assets/liberapay.png" alt="">Liberapay</a>
                    <a _href="https://ko-fi.com/SkwalExe"><img src="/assets/kofi.webp" alt="">Ko-fi</a>
                    <a _href="https://www.patreon.com/SkwalExe"><img src="/assets/patreon.png" alt="">Patreon</a>
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
    js("functions", "global", "notifications", "navbar", "links", "tiles", "loadingScreen");
    ?>

</body>

</html>