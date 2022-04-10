<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    defaultHeaders();
    css("colors", "navbar", "global", "tiles", "footer");
    ?>

</head>

<body>



    <?php

    navbarStart();
    navbarButton("About", "/about");
    navbarButton("Github", "https://github.com/SkwalExe/", "github.png");
    navbarEnd();

    ?>


    <div class="main">
        <h1 class="section">
            My projects
        </h1>
        <div class="tiles">

            <?php projects() ?>

        </div>
    </div>



    <?php

    footer();

    js("functions", "navbar", "links", "tiles");
    ?>

</body>

</html>