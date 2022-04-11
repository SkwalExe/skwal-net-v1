<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    defaultHeaders();
    css("colors", "navbar", "global", "tiles", "footer", "layout", "form", "cowTranslator");
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

                    <textarea class="textInput" placeholder="Human language"></textarea>
                    <textarea class="cowInput" placeholder="Cow language"></textarea>
                </div>
            </div>
            <hr class="onlyShowWhenMobileWidth">
            <div class="sidebar">

                <div class="links box glowing">
                    <a href="https://github.com/SkwalExe/cowTranslator.js"><img src="/assets/github.png" alt="">Github repo</a>
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

    $url = noCache("https://cdn.jsdelivr.net/gh/SkwalExe/cowTranslator.js@main/src/cowTranslator.min.js");

    echo "<script src='$url'></script>";

    js("functions", "navbar", "links", "tiles", "cowTranslator");
    ?>



</body>

</html>