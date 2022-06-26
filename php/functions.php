<?php

// Imports for rate limiting functions
use bandwidthThrottle\tokenBucket\Rate;
use bandwidthThrottle\tokenBucket\TokenBucket;
use bandwidthThrottle\tokenBucket\storage\FileStorage;

// Imports for markdown parsing functions
use League\CommonMark\GithubFlavoredMarkdownConverter;

/**
 * Determine if the website is hosted on a localhost or on a production environment.
 * @return bool
 */
function local()
{
    // return whether the request comes from localhost or not
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

    // the server is running on localhost, always bypass caching
    // else use the $version variable set in variables.php
    $param = local()
        ? random_int(0, 100000)
        : $version;

    return trim($url) . "?version=" . $param;
}

/**
 * Import css files and bypass caching
 * 
 * ```php
 * // only import default stylesheets
 * css();
 * 
 * // importe "foo" stylesheet and default stylesheets
 * css("foo");
 * 
 * // prevent importing default stylesheets
 * dontLoadDefaultCss();
 * css(...);
 * ``` 
 */
function css()
{
    global $loadDefaultCss;
    global $showPageContent;
    static $functionAlreadyCalled = false;

    if (!$functionAlreadyCalled) {
        $functionAlreadyCalled = true;

        // Import POPPINS font
        echo "<style>";
        echo "@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap')";
        echo "</style>";

        // Toasteur.js stylesheet
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toasteur@0.2.1/dist/themes/toasteur-default.min.css">';
        // MessageBox.js stylesheet
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/messagebox.js@0.4.0/dist/themes/messagebox-default.min.css">';
        // Toultip.js stylesheet
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toultip@0.2.0/dist/themes/toultip-default.min.css">';

        // Pass username to css as --username variable
        // needed for the terminal stylesheet
        echo "<style>";
        echo ":root {";
        echo "--username: '" . (addslashes($_SESSION['username']) ?? 'skwal') . "';";
        echo "}";
        echo "</style>";

        // Load the default stylesheets
        if ($loadDefaultCss) {
            css("colors", "global");
            // load stylesheets for standard pages
            if ($showPageContent) {
                css("footer", "loadingScreen", "layout", "navbar", "tiles");
            }
        }
    }

    $files = func_get_args();

    // load each function argument as a stylesheet
    foreach ($files as $file) {
        $file = "/css/$file.css";
        echo "<link rel=\"stylesheet\" href=\"" . noCache($file) . "\">";
    }
}

/**
 * Import js files and bypass caching
 * 
 * ```php
 * // only import default scripts
 * js();
 * 
 * // importe "foo" script and default scripts
 * js("foo");
 * 
 * // prevent importing default scripts
 * dontLoadDefaultJs();
 * js(...);
 * ```
 */
function js()
{
    global $scripts;
    global $showPageContent;
    global $redirectNotification;
    global $serverData;
    global $loadDefaultJs;
    global $redirected;

    static $functionAlreadyCalled = false;

    if (!$functionAlreadyCalled) {
        $functionAlreadyCalled = true;

        // Load fontawesome
        echo '<script src="https://kit.fontawesome.com/2fd86e1bdd.js" crossorigin="anonymous"></script>';
        // Load Toasteur.js
        echo '<script src="https://cdn.jsdelivr.net/gh/SkwalExe/Toasteur.js@v0.2.1/dist/toasteur.min.js"></script>';
        // Load Toultip.js
        echo '<script src="https://cdn.jsdelivr.net/gh/SkwalExe/Toultip.js@v0.2.0/dist/toultip.min.js"></script>';
        // Load MessageBox.js
        echo '<script src="https://cdn.jsdelivr.net/gh/SkwalExe/MessageBox.js@v0.4.0/dist/messagebox.min.js"></script>';

        $serverData["showPageContent"] = $showPageContent;
        $json_data = json_encode($serverData);
        // Encode as JSON and pass server data to js as serverData variable
        echo "<script> var serverData = " . $json_data . "</script>";

        // Import default scripts
        if ($loadDefaultJs) {
            js("functions", "global", "links");
            // Import scripts for standard pages
            if ($showPageContent) {
                js("navbar", "tiles", "loadingScreen");
            }
        }

        // Console warning
        echo '<script>';
        echo 'console.log("%cSTOP!!", "color: red;font-size:100px;");';
        echo 'console.log("%cWhat you see here is the developer console of your web browser. \nIt is a tool intended for the developer, and which allows to inject code into the page, do not copy any code here, it could be malicious code which will give access to some of your personal information to hackers.", "color: red;font-size:20px;");';
        echo '</script>';

        if (!$showPageContent && $redirected) {
            // Include the "wait while you are being redirected" message
            include $scripts . '/redirected.php';
        }

        echo ($redirectNotification ?? '');

        include($scripts . '/noscript.php');
    }

    $files = func_get_args();

    // load each function argument as a script
    foreach ($files as $file) {
        $file = "/js/$file.js";
        echo "<script src=\"" . noCache($file) . "\"></script>";
    }
}


/**
 * Parse projects in /scripts/projects.json, and print them randomly
 * 
 * @param int $limit The number of projects to print
 */
function projects($limit = 5)
{
    global $scripts;
    // Parse projects.json
    $json = file_get_contents($scripts . "/projects.json");
    $projects = json_decode($json, true);
    shuffle($projects);
    $projects = array_slice($projects, 0, $limit);
    $html = '';
    foreach ($projects as $project) {
        $html .= "<div class=\"tile\" _href=\"{$project['url']}\">";
        $html .= "<div class=\"head\">";
        $html .= "<span class=\"title\">";
        $html .= $project['name'];
        $html .= "</span>";
        $html .= "</div>";
        $html .= "<div class=\"body\">";
        $html .= "<p class=\"text\">";
        $html .= $project['description'];
        $html .= "</p>";
        $html .= "<img src=\"{$project['image']}\" alt=\"\" class=\"banner\">";
        $html .= "</div>";
        $html .= "</div>";
    }
    echo $html;
}

/**
 * prints all pages as tiles
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
 * Prints the HTML of the beginning of the navbar
 */
function navbarStart()
{
    global $scripts;
    include($scripts . "/navbarStart.php");
}

/**
 * Prints the HTML of the end of the navbar
 */
function navbarEnd()
{
    global $scripts;
    include($scripts . "/navbarEnd.php");
}

/**
 * Prints the html of a navbar item
 */
function navbarButton($text, $link = "#", $image = null)
{

    $imageHtml = $image ? "<i class='$image'></i>" : "";

    echo "<li href=\"$link\">$imageHtml$text</li>";
}

/**
 * Prints the HTML of the loading screen
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
 * Prints the HTML of a terminal
 */
function terminalHTML()
{
    global $scripts;
    include($scripts . "/terminal.php");
}


/**
 * Determine if the user is logged in
 * @return boolean True if the user is logged in
 */
function isLoggedIn()
{
    return isset($_SESSION['id']);
}


/**
 * Determine if a user exists based on hide username, id, or email adress
 * @param string $identification The username, id, or email address to check
 * @param string $type The type of identification to check
 * @return boolean True if the user exists
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
 * @param string $string The password to hash
 * @return string The hashed password
 */
function HashThat($string)
{
    return password_hash($string, PASSWORD_DEFAULT);
}

/**
 * Add an user to the database
 * @param string $username The username of the user
 * @param string $password The password of the user (not hashed)s
 * @param string $email The email address of the user 
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

/**
 * Check if an username is acceptable
 * @param string $username The username to check
 * @return bool true if the username is acceptable
 */
function isValidUsername($username)
{
    return preg_match("/^[a-zA-Z0-9_\-]{3,20}$/", $username);
}

/**
 * Determine if an email adress is valid
 * @param string $email The email address to check
 * @return bool true if the email is valid
 */
function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Check if post parameters are valid
 * @return bool true if every post parameter (function paremeters) are set
 */
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

/**
 * Check if get parameters are valid
 * @return bool true if every get parameter (function paremeters) are set
 */
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

/**
 * Check if the request contains the required files
 * @return bool true if the request contains the required files (function parameters)
 */
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

/**
 * Set a variable that will be printed by the js() function at the end of the page
 * this variable will redirect the user to the specified url
 * @param string $url The url to redirect to
 * @param array $notification The notification to display to the user [Title, content, type, url?]
 */
function redirect($url, $notification = null)
{
    global $redirected;
    global $redirectNotification;

    $redirected = true;

    dontShowPageContent();

    $redirectNotification = "<script>";
    $redirectNotification .= "redirect(";
    $redirectNotification .= "'" . addslashes($url) . "'";

    if ($notification) {
        $redirectNotification .= ", ['" . addslashes($notification[0]) . "'";
        $redirectNotification .= ", '" . addslashes($notification[1]) . "'";
        if (isset($notification[2]))
            $redirectNotification .= ", '" . addslashes($notification[2]) . "'";

        if (isset($notification[3]))
            $redirectNotification .= ", '" . addslashes($notification[3]) . "'";

        $redirectNotification .= ']';
    }

    $redirectNotification .= ");";
    $redirectNotification .= "</script>";
}

/**
 * Updates the session's informations
 */
function updateSession()
{
    if (isLoggedIn()) {
        $id = $_SESSION['id'];
        $user = new User($id);
        $_SESSION = $user->toArray();
    }
}

/**
 * Send a mail
 * @param string $to The email address to send to
 * @param string $subject The subject of the mail
 * @param string $content The content of the mail
 * @param string $from The email address to send from
 * @param bool $blank if true, dont add the default html header and footer
 */
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

/**
 * Returns an array representing an api response that will be sent
 * @return array The api response that will be sent
 */
function api_response()
{
    return [
        "success" => false,
        "message" => "",
        "error" => "",
        "data" => null
    ];
}

/**
 * Checks if all the requirements for the api call are satisfied
 * @param string $method The method of the api call
 * @param string $contentType The content type of the api call
 */
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

/**
 * Print recent posts as tile
 * @param int $limit The number of posts to print
 */
function printRecentPosts($limit = 5)
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
        $post->loadAuthor();
?>
        <div class="tile" href="/post?id=<?= $post->id ?>">
            <div class="head">
                <div class="flex">
                    <div class="avatarContainer">
                        <img src="<?= $post->author->avatarUrl ?>" class="avatar" />
                    </div>
                    <p><?= $post->author->username ?></p><?= $post->author->printRoles(); ?>
                </div>
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


/**
 * Determine if a post exists wiht its id
 * @param int $id The id of the post
 * @return bool True if the post exists
 */
function postExists($id)
{
    global $db;
    $sql = "SELECT id FROM posts WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->rowCount() > 0;
}

/**
 * Determine if a comment exists with its id
 * @param int $id The id of the comment
 * @return bool True if the comment exists
 */
function commentExists($id)
{
    global $db;
    $sql = "SELECT id FROM comments WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->rowCount() > 0;
}

/**
 * Returns the recent post as an array of Post objects
 * @param int $limit The number of posts to return
 * @return array The recent posts
 */
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

    return $posts;
}

/**
 * Returns the popular posts as an array of Post objects
 * @param int $limit The number of posts to return
 * @return array The popular posts
 */
function popularPosts($limit = 5)
{
    global $db;
    $sql = "SELECT id FROM posts ORDER BY (unix_timestamp(now()) - unix_timestamp(createdAt)) / views ASC LIMIT $limit";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $posts = array_map(function ($post) {
        return new Post($post['id']);
    }, $result);

    return $posts;
}

/**
 * Parse markdown to html
 * @param string $text
 * @return string The html
 */
function parseMarkdown($text)
{
    $parser = new GithubFlavoredMarkdownConverter([
        'allow_unsafe_links' => false,
        'html_input' => 'escape',

    ]);

    return $parser->convert($text);
}

/**
 * Prints the page metadata
 * @param array $params An array with the informations of the page, every key is optional
 * 
 * ```php
 * metadata([
 *   "title" => "My title",
 *   "description" => "My description",
 *   "image" => "http://myimage.com/image.png",
 *   "url" => "http://myurl.com"
 *   "site_name" => "My site name"
 * ])
 * ```
 */
function metadata($params = [])
{
    $defaultParams = [
        "title" => "Skwal.net",
        "description" => "Skwal.net forum is a safe, welcoming and caring place to discover cool stuff, share your knowledge and get help from other users",
        "image" => "/assets/logo.png",
        "large" => false,
        "url" => $_SERVER['REQUEST_URI'],
        "site_name" => "© 2018-" . date('Y') . ", Léopold Koprivnik Ibghy"
    ];

    $params = array_merge($defaultParams, $params);

    ?>
    <meta name='referrer' content='no-referrer'>
    <meta name='theme-color' content='#CE6B82'>
    <meta property='og:site_name' content='<?= htmlentities($params['site_name']) ?>'>
    <link rel='icon' type='image/ico' href='/favicon.ico'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta charset='UTF-8'>

    <title><?= htmlentities($params['title']) ?></title>
    <meta property='og:title' content='<?= htmlentities($params['title']) ?>' />
    <meta name='description' content='<?= htmlentities($params['description']) ?>'>
    <meta property='og:description' content='<?= htmlentities($params['description']) ?>' />
    <meta property='og:url' content='<?= htmlentities($params['url']) ?>' />
    <meta property='og:image' content='<?= htmlentities($params['image']) ?>' />
    <?= $params['large'] ? "<meta name='twitter:card' content='summary_large_image' />" : "" ?>

<?php

}

/**
 * set $showPageContent to false
 */
function dontShowPageContent()
{
    global $showPageContent;
    $showPageContent = false;
}

/**
 * Import the css files for the page
 */
function pageCss()
{
    global $showPageContent;
    if ($showPageContent)
        css(func_get_args());
}

/**
 * Import the js files for the page
 */
function pageJs()
{
    global $showPageContent;
    if ($showPageContent)
        js(func_get_args());
}

/**
 * Dont load default js files
 */
function dontLoadDefaultJs()
{
    global $loadDefaultJs;
    $loadDefaultJs = false;
}

/**
 * Dont load default css files
 */
function dontLoadDefaultCss()
{
    global $loadDefaultCss;
    $loadDefaultCss = false;
}

/**
 * Dont load default css and js files
 */
function dontLoadDefaultCssAndJs()
{
    dontLoadDefaultCss();
    dontLoadDefaultJs();
}
