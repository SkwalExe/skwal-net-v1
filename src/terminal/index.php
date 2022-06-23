<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    metadata([
        'title' => 'Terminal simulator',
        'description' => 'Terminal simulator written in javascript, directly in your browser',
        'large' => true,
        "image" => "/assets/terminal.png",
    ]);
    css("colors",  "global", "terminal");
    ?>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/gh/SkwalExe/skwash.js@v0.8.3/dist/skwash.min.js"></script>

    <?php
    terminalHTML();
    js("functions", "global", "links", "terminal");
    ?>
</body>

</html>