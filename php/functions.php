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
    return in_array($_SERVER["REMOTE_ADDR"], ["127.0.0.1", "::1", "localhost"]);
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
        ? random_int(0, 100000)
        : $version;

    return trim($url) . "?version=" . $param;
}


/**
 * Import css files and bypass caching
 * @param string ...$files The files to import
 */
function css()
{
    echo "<style>";
    echo "@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap')";
    echo "</style>";

    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toasteur@0.2.1/dist/themes/toasteur-default.min.css">';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/messagebox.js@0.4.0/dist/themes/messagebox-default.min.css">';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toultip@0.2.0/dist/themes/toultip-default.min.css">';
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
    echo '<script src="https://kit.fontawesome.com/2fd86e1bdd.js" crossorigin="anonymous"></script>';
    echo '<script src="https://cdn.jsdelivr.net/gh/SkwalExe/Toasteur.js@v0.2.1/dist/toasteur.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/gh/SkwalExe/Toultip.js@v0.2.0/dist/toultip.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/gh/SkwalExe/MessageBox.js@v0.4.0/dist/messagebox.min.js"></script>';
    echo '<script>';
    echo 'console.log("%cSTOP!!", "color: red;font-size:100px;");';
    echo 'console.log("%cWhat you see here is the developer console of your web browser. \nIt is a tool intended for the developer, and which allows to inject code into the page, do not copy any code here, it could be malicious code which will give access to some of your personal information to hackers.", "color: red;font-size:20px;");';
    echo '</script>';
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

    global  $redirectNotification;
    if (isset($redirectNotification))
        echo  $redirectNotification;
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

    $imageHtml = $image ? "<i class='$image'></i>" : "";

    echo "<li href=\"$link\">$imageHtml$text</li>";
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

function requireGet()
{
    $args = func_get_args();
    foreach ($args as $arg) {
        if (!isset($_GET[$arg])) {
            return false;
        }
    }
    return true;
}

function requireFiles()
{
    $args = func_get_args();
    foreach ($args as $arg) {
        if (!isset($_FILES[$arg])) {
            return false;
        }
    }
    return true;
}

function redirect($url, $notification = null)
{
    global $redirectNotification;

    $redirectNotification = "<script>redirect('" . addslashes($url) . "'";

    if ($notification) {

        $redirectNotification .= ", ['" . addslashes($notification[0]) . "'";
        $redirectNotification .= ", '" . addslashes($notification[1]) . "'";
        if (isset($notification[2]))
            $redirectNotification .= ", '" . addslashes($notification[2]) . "'";

        if (isset($notification[3]))
            $redirectNotification .= ", '" . addslashes($notification[3]) . "']";
        else
            $redirectNotification .= ']';
    }

    $redirectNotification .= ");</script>";
}


function updateSession()
{
    if (isLoggedIn()) {
        $id = $_SESSION['id'];
        $user = new User($id);
        $_SESSION = $user->toArray();
    }
}
function sendMail($to, $subject, $content, $from = "support@skwal.net", $blank = false)
{
    if (local())
        return;

    if (!$blank) {
        $message = '<html><head><meta charset="utf-8"></head><body>';
        $message .= "<center>";
        $message .= "<header>";
        $message .= "<h1>Skwal.net</h1>";
        $message .= "</header>";
        $message .= "<div style=\"background-color: #F5F5F5; margin: 25px; border-radius: 7px; padding: 25px; width: 80%; max-width: 500px;\">";
        $message .= $content;
        $message .= "</div>";
        $message .= "<footer>";
        $message .= "<p style=\"font-size: 10px; opacity: 0.4;\">";
        $message .= "© 2018-" . getdate(time())["year"] . ", Léopold Koprivnik Ibghy, <a href='https://skwal.net'>Skwal.net</a>, all rights reserved.";
        $message .= "</p>";
        $message .= "</footer>";
        $message .= "</center>";
        $message .= '</body></html>';
    } else
        $message = $content;

    mail($to, $subject, $message, "From: $from\r\nContent-type: text/html\r\n");
}


function api_response()
{
    return [
        "success" => false,
        "message" => "",
        "error" => "",
        "data" => null
    ];
}


function api($method = "POST", $contentType = "application/json")
{
    $response = api_response();

    if ($_SERVER['REQUEST_METHOD'] != $method) {
        $response['error'] = "Only $method requests are accepted";
        echo json_encode($response);
        http_response_code(405);
        die();
    }
    if (isset($contentType)) {
        if (!str_starts_with($contentType, "multipart/form-data") &&  $_SERVER['CONTENT_TYPE'] != $contentType) {
            $response["error"] = "Content-Type must be $contentType";
            echo json_encode($response);
            http_response_code(409);
            die();
        }

        if ($contentType == "application/json") {
            $json = file_get_contents('php://input');
            $_POST = json_decode($json, true);

            if (!isset($_POST)) {
                $response['error'] = "Invalid JSON";
                echo json_encode($response);
                http_response_code(400);
                die();
            }
        }
    }
}


function recentPosts($limit = 5)
{
    global $db;
    $sql = "SELECT id FROM posts ORDER BY createdAt DESC LIMIT $limit";

    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $posts = array_map(function ($post) {
        return new Post($post['id']);
    }, $result);


    foreach ($posts as $post) {
?>
        <div class="tile" href="/post?id=<?= $post->id ?>">
            <div class="head">
                <span class="title"><?= htmlentities($post->title) ?></span>
            </div>
            <div class="body">
                <p class="text">
                    <?= nl2br(htmlentities(substr($post->content, 0, 100))) ?>...
                </p>
            </div>
        </div>
<?php
    }
}



function postExists($id)
{
    global $db;
    $sql = "SELECT id FROM posts WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->rowCount() > 0;
}
