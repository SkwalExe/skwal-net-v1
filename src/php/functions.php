<?php

use bandwidthThrottle\tokenBucket\Rate;
use bandwidthThrottle\tokenBucket\TokenBucket;
use bandwidthThrottle\tokenBucket\storage\FileStorage;

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
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toasteur@0.2.1/dist/themes/toasteur-default.min.css">';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/messagebox.js@0.2.0/dist/themes/messagebox-default.min.css">';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toultip@0.1.0/dist/themes/toultip-default.min.css">';
    $files = func_get_args();

    echo "<style>"; // trensmet les donnés de l'utilisateur au css
    echo ":root {";
    echo "--username: '" . ($_SESSION['username'] ?? 'skwal') . "';";
    echo "}";
    echo "</style>";

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

    echo '<script src="https://cdn.jsdelivr.net/gh/SkwalExe/Toasteur.js@v0.2.1/dist/toasteur.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/gh/SkwalExe/Toultip.js@v0.1.0/dist/toultip.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/gh/SkwalExe/MessageBox.js@v0.2.0/dist/messagebox.min.js"></script>';

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


/**
 * determine if the user is logged in
 */
function isLoggedIn()
{
    return isset($_SESSION['id']);
}


/**
 * Determine if a user exists based on hide username, id, or email adress
 */
function userExists($identification, $type = "username")
{
    global $db;

    $sql = "SELECT id FROM users WHERE $type = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$identification]);
    return $stmt->rowCount() > 0;
}

/**
 * Hash a password
 */
function HashThat($string)
{
    return password_hash($string, PASSWORD_DEFAULT);
}

/**
 * Add an user to the database
 * @return string The id of the user
 */
function createUser($username, $password, $email)
{
    $password = HashThat($password);
    global $db;

    $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$username, $password, $email]);
    return $db->lastInsertId();
}

/**
 * Checks if a resource is rate limited
 * @return bool true if the resource is rate limited
 * @param string $name The name of the rate limit
 * @param int $tokens The maximum number of request per ↓
 * @param int $unit The time unit (second, minute, hour, day, week, month, year)
 * @param int $initial The initial number of tokens
 * @param int $consume The number of tokens to consume
 * @param bool $ip rate limit per ip?
 */
function rateLimit($name, $tokens, $unit, $bucketMax, $initial, $consume, &$seconds, $ip = false)
{
    $ipString = $ip ? "-{$_SERVER['REMOTE_ADDR']}" : "";
    $storage = new FileStorage($_SERVER['DOCUMENT_ROOT'] . "/api/v1/rate-limits/$name$ipString-bucket");
    $rate = new Rate($tokens, $unit);
    $bucket = new TokenBucket($bucketMax, $rate, $storage);
    $bucket->bootstrap($initial);
    $rateLimited = !$bucket->consume($consume, $seconds);
    return $rateLimited;
}

/**
 * Checks if an ip adress is rate limited
 * @return bool true if the ip is rate limited
 * @param string $name The name of the rate limit
 * @param int $tokens The maximum number of request per ↓
 * @param int $unit The time unit (second, minute, hour, day, week, month, year)
 * @param int $initial The initial number of tokens
 * @param int $consume The number of tokens to consume
 */
function rateLimitIp($name, $tokens, $unit, $bucketMax, $initial, $consume, &$seconds)
{
    return rateLimit($name, $tokens, $unit, $bucketMax, $initial, $consume, $seconds, true);
}

function isValidUsername($username)
{
    return preg_match("/^[a-zA-Z0-9_\-]{3,20}$/", $username);
}

function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function requirePost()
{
    $args = func_get_args();
    foreach ($args as $arg) {
        if (!isset($_POST[$arg])) {
            return false;
        }
    }
    return true;
}
