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



    <?php

    navbarStart();
    navbarButton("Github", "https://github.com/SkwalExe/", "github.png");
    navbarEnd();

    ?>


    <div class="main">
        <p class="bio"><?= $bio ?></p>

        <h1 class="section">
            My projects
        </h1>
        <div class="tilesContainer">
            <div class="tiles">

                <?php projects() ?>

            </div>
        </div>
    </div>



    <?php

    footer();

    js("functions", "navbar", "links");
    ?>

</body>

</html>