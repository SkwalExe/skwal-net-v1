<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    defaultHeaders();
    css("colors",  "global", "terminal");
    ?>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/gh/SkwalExe/skwash.js@v0.7.0/dist/skwash.min.js"></script>

    <?php
    terminalHTML();
    js("functions", "global", "links", "terminal");
    ?>
</body>

</html>