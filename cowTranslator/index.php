<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    defaultHeaders();
    css("colors", "global", "footer", "layout", "form", "loadingScreen");
    ?>

</head>

<body>

    <?php
    navbarStart();

    navbarButton("Home", "/", "home.png");

    navbarEnd();
    ?>
    <div class="mainContainer">

        <div class="main">
            <div class="content">
                <div class="titleBox box glowing">
                    <div class="markup">
                        <h1>Cow translator 🐄</h1>
                    </div>
                </div>
                <div class="glowing box">
                    <p>Status : <span class="status">OK</span></p>
                </div>
                <div class="box glowing inputs">
                    <div>
                        <div class="buttons">
                            <button onclick="copyHuman()" class="green">Copy</button>
                            <button onclick="resetHuman()" class="red">Reset</button>
                        </div>
                        <textarea class="textInput" placeholder="Human language"></textarea>
                    </div>
                    <div>
                        <div class="buttons">
                            <button onclick="copyCow()" class="green">Copy</button>
                            <button onclick="resetCow()" class="red">Reset</button>
                        </div>
                        <textarea class="cowInput" placeholder="Cow language"></textarea>
                    </div>
                </div>
            </div>
            <hr class="onlyShowWhenMobileWidth">
            <div class="sidebar">
                <h1 class="sideBarTitle">
                    Links
                </h1>
                <div class="links box glowing">
                    <a href="https://github.com/SkwalExe/cowTranslator.js"><img src="/assets/github.png" alt="">Github repo</a>
                </div>

                <hr>

                <div class="oneColumnTiles">
                    <h1 class="sideBarTitle">
                        Pages
                    </h1>
                    <?php
                    pages();
                    ?>
                </div>

                <hr>

                <div class="oneColumnTiles">
                    <h1 class="sideBarTitle">
                        Projects
                    </h1>
                    <?php
                    projects();
                    ?>
                </div>
            </div>
        </div>
    </div>



    <?php

    loadingScreen();
    footer();

    $url = noCache("https://cdn.jsdelivr.net/gh/SkwalExe/cowTranslator.js@main/src/cowTranslator.min.js");

    echo "<script src='$url'></script>";

    js("functions", "global", "navbar", "links", "tiles", "cowTranslator", "loadingScreen");
    ?>



</body>

</html>