<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    defaultHeaders();
    css("colors",  "global");
    ?>
</head>

<body>
    <?php
    terminalHTML();
    js("functions", "global", "links", "bash-emulator.min", "terminal");
    ?>
</body>

</html>