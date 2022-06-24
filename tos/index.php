<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

$defaultPage = "introduction";

if (!requireGet("page")) {
    redirect("/tos?page=$defaultPage");
}

$pageName = $_GET['page'];
$pages = [
    ["introduction", "📚 Introduction"],
    ["sanctions", "🚫 Sanctions"],
    ["legality", "‍⚖️ Legality"],
    ["prohibited-content", "⛔ Prohibited content"],
    ["spam", "🗑️ Spam"],
    ["your-content", "📝 Your content"],
];

if (!in_array($pageName, array_column($pages, 0))) {
    redirect("/tos?page=$defaultPage");
}

$markdown = file_get_contents("pages/$pageName.md");
$parsedMarkdown = parseMarkdown($markdown);

$page = array_filter($pages, function ($page) use ($pageName) {
    return $page[0] == $pageName;
});
$page = array_values($page)[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    metadata([
        "title" => '📜 Skwal Terms of Service',
        "description" => "The 📜 rules and limitations to follow to keep skwal.net a safe, welcoming and caring place for our users",
        "large" => false,
        "image" => "/assets/logo.png",
    ]);
    css("colors",  "global", "footer", "layout", "loadingScreen", "navbar", "tiles");
    ?>
</head>

<body>
    <?php
    navbarStart();
    navbarButton("Home", "/", "fa fa-home");
    navbarEnd();
    if ($showPageContent) {
    ?>
        <div class="mainContainer">
            <div class="main">
                <div class="content">
                    <div class="box glowing markup">
                        <h1><?= $page[1] ?></h1>
                        <?= $parsedMarkdown ?>
                    </div>
                </div>
                <hr class="onlyShowWhenMobileWidth">
                <div class="sidebar">
                    <h1 class="box glowing center">
                        Pages
                    </h1>
                    <div class="links box glowing">
                        <?php
                        foreach ($pages as $page_) {
                            echo "<a " . ($page_[0] == $page[0] ? "disabled" : "") . " href='/tos?page={$page_[0]}'>{$page_[1]}</a>";
                        }
                        ?>
                        <a href="/privacy">🔓 Privacy policy</a>
                        <a href="/cookies">🍪 Cookies policy</a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    loadingScreen();
    footer();
    js("functions", "global", "navbar", "links", "tiles", "loadingScreen");
    ?>
</body>

</html>