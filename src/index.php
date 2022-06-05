<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    defaultHeaders();
    css("colors", "global", "footer", "loadingScreen", "layout", "navbar", "tiles");
    ?>

</head>

<body>



    <?php

    navbarStart();
    if (isLoggedIn())
        navbarButton("Profile", "/profile", "profile.png");
    else
        navbarButton("Login", "/login", "login.png");
    navbarButton("Github", "https://github.com/SkwalExe/", "github.png");
    navbarEnd();

    ?>

    <div class="mainContainer">

        <div class="main">
            <div class="content">
                <h1 class="center box glowing">
                    Pages
                </h1>
                <div class="tiles">
                    <?php

                    pages();

                    ?>
                </div>
            </div>
            <hr class="onlyShowWhenMobileWidth">
            <div class="sidebar">
                <h1 class="center box glowing">
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


                <h1 class="center box glowing">
                    My projects
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