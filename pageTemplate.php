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

    navbarButton("Home", "/", "home.png");

    navbarEnd();
    ?>

    <div class="main">

    </div>

    <?php

    footer();

    js("functions", "navbar", "links");
    ?>

</body>

</html>