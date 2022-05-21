<?php


/**
 * Determine if the website is hosted on a localhost or on a server.
 * @return bool
 */
function local()
{
    return $_SERVER['SERVER_NAME'] === 'localhost';
}


/**
 * Add a paramater to an url to bypass caching
 * @param string $url The url to add the paramater to
 * @return string The url with the paramater
 */
function noCache(string $url)
{
    global $version;

    $param = local()
        ? random_int(0, 1000)
        : $version;

    return trim($url) . "?version=" . $param;
}


/**
 * Import css files and bypass caching
 * @param string ...$files The files to import
 */
function css()
{
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toultip@0.1.0/dist/themes/toultip-default.min.css">';
    $files = func_get_args();

    foreach ($files as $file) {
        $file = "/css/$file.css";
        echo "<link rel=\"stylesheet\" href=\"" . noCache($file) . "\">";
    }
}

/**
 * Import js files and bypass caching
 * @param string ...$files The files to import
 */
function js()
{

    echo '<script src="https://cdn.jsdelivr.net/gh/SkwalExe/Toultip.js@v0.1.0/dist/toultip.min.js"></script>';

    static $serverDataPassed = false;
    if (!$serverDataPassed) {
        $serverDataPassed = true;
        global $serverData;
        $json_data = json_encode($serverData);
        echo "<script> var serverData = " . $json_data . "</script>";
    }

    $files = func_get_args();

    foreach ($files as $file) {
        $file = "/js/$file.js";
        echo "<script src=\"" . noCache($file) . "\"></script>";
    }
}


/**
 * Echo default html headers
 */
function defaultHeaders()
{

    global $scripts;
    include($scripts . "/headers.php");
}


/**
 * Print all projects
 */
function projects()
{
    global $scripts;
    include($scripts . "/projects.cache.php");
}

/**
 * prints all pages
 */
function pages()
{
    global $scripts;
    include($scripts . "/pages.php");
}


/**
 * print the page footer
 */
function footer()
{
    global $scripts;

    include($scripts . "/footer.php");
}


/**
 * Initialize navbar and print it
 */
function navbarStart()
{
    global $scripts;
    include($scripts . "/navbarStart.php");
}

/**
 * Print the navbar end
 */
function navbarEnd()
{
    global $scripts;
    include($scripts . "/navbarEnd.php");
}

/**
 * print a navbar button
 */
function navbarButton($text, $link = "#", $image = null)
{

    $imageHtml = $image ? "<img src=\"/assets/$image\" alt=\"navbar button icon\">" : "";

    echo "<li href=\"$link\">$text$imageHtml</li>";
}

/**
 * prints the loading screen html
 */
function loadingScreen()
{
    global $scripts;
    include($scripts . "/loadingScreen.php");
}



/**
 * prints Skwal in ascii art
 */
function skwal_ascii()
{
    $skwalAscii  = <<< EOS
     _____ _                   _ 
    / ____| |                 | |
   | (___ | | ____      ____ _| |
    \___ \| |/ /\ \ /\ / / _` | |
    ____) |   <  \ V  V / (_| | |
   |_____/|_|\_\  \_/\_/ \__,_|_|
   EOS;

    echo $skwalAscii;
}


/**
 * prints html for a terminal
 */
function terminalHTML()
{
    global $scripts;
    include($scripts . "/terminal.php");
}
