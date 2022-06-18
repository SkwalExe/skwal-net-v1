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
    navbarButton("Forum", "/forum/", "fa fa-comments");
    if (isLoggedIn())
        navbarButton("Profile", "/profile", "fa-solid fa-user");
    else
        navbarButton("Login", "/login", "fa fa-sign-in");
    navbarButton("Github", "https://github.com/SkwalExe/", "fa fa-github");
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
                    <a _href="https://github.com/SkwalExe/"><i class="fa-brands fa-github"></i> Github</a>
                    <a _href="https://discord.skwal.net"><i class="fa-brands fa-discord"></i>Discord</a>
                    <a _href="https://twitter.com/@SkwalExe"><i class="fa-brands fa-twitter"></i>Twitter</a>
                    <a _href="/about"><i class="fa fa-circle-question"></i>About</a>
                    <a _href="https://www.paypal.com/paypalme/SkwalDev"><i class="fa-brands fa-paypal"></i>Paypal</a>
                    <a _href="https://liberapay.com/SkwalExe"><img src="/assets/liberapay.png" alt="">Liberapay</a>
                    <a _href="https://ko-fi.com/SkwalExe"><i class="fa fa-mug-saucer"></i>Ko-fi</a>
                    <a _href="https://www.patreon.com/SkwalExe"><i class="fa-brands fa-patreon"></i>Patreon</a>
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