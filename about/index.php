<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    metadata([
        "title" => '📜 About skwal.net',
        "description" => "Learn more about skwal.net, the history of the website and of its creator",
        "large" => true,
        "image" => "/assets/banner.png"
    ]);
    css();
    ?>
</head>

<body>

    <?php
    if ($showPageContent) {
        navbarStart();
        navbarButton('<img src="https://ko-fi.com/img/githubbutton_sm.svg" alt="">', "https://ko-fi.com/W7W7AMXI6");
        navbarButton("Home", "/", "fa fa-home");
        navbarEnd();
    ?>

        <div class="mainContainer">
            <div class="main">
                <div class="content">

                    <h1 class="glowing box center">
                        About skwal.net
                    </h1>

                    <div class="box glowing markup">
                        <h1>What is skwal.net 🤔</h1>
                        <p>We want to create a <strong>welcoming and caring place</strong> for everyone to discover cool & interesting things, share their knowledge, ideas, and creations.</p>

                        <p>Skwal.net is a forum about <strong>programming</strong> but you can find content on other domains </p>
                    </div>
                    <div class="box glowing markup">
                        <p>My name is <strong>Léopold Koprivnik Ibghy</strong> aka <strong>SkwalExe</strong>, I am <strong>14 years old french 🇫🇷 student</strong>, I created skwal.net in 2018, when I was <strong>10 years old</strong> and I continue to maintain it.</p>
                        <p>When I wrote the first line of code for this forum, I didn't know <strong>anything</strong> about coding, I learned everything I know while coding this website, it represents my <strong>first experience with programming</strong>.</p>
                        <p>I love <strong>FOSS</strong>, and I am very interested in <strong>the history of linux 🐧</strong></p>
                        <p>I love creating <strong>open source, fun and interesting</strong> programs or libraries that you can find on my <a href="https://github.com/SkwalExe/">Github</a></p>
                    </div>


                </div>
                <hr class=" onlyShowWhenMobileWidth">
                <div class="sidebar">
                    <h1 class="glowing box center">
                        Links
                    </h1>
                    <div class="links box glowing">
                        <a _href="https://github.com/SkwalExe/"><i class="fa fa-github"></i>Github</a>
                        <a _href="https://discord.skwal.net"><i class="fa-brands fa-discord"></i>Discord</a>
                        <a _href="https://twitter.com/@SkwalExe"><i class="fa-brands fa-twitter"></i>Twitter</a>
                    </div>

                    <hr>

                    <h1 class="glowing box center">
                        Pages
                    </h1>
                    <?php
                    pages();
                    ?>
                    <hr>

                    <h1 class="glowing box center">
                        Projects
                    </h1>
                    <?php
                    projects();
                    ?>
                </div>
            </div>
        </div>
    <?php
        footer();
        loadingScreen();
    }
    js();
    ?>

</body>

</html>