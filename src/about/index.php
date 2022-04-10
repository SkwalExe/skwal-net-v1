<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    defaultHeaders();
    css("colors", "navbar", "global", "tiles", "footer", "layout", "markup");
    ?>

</head>

<body>

    <?php
    navbarStart();

    navbarButton("Home", "/", "home.png");

    navbarEnd();
    ?>

    <div class="mainContainer">
        <div class="main">
            <div class="content">

                <div class="box glowing markup">
                    <h1>SkwalExe</h1>

                    <img src="/assets/banner.png" alt="">

                    <h2>Short bio</h2>

                    <p><?= $bio ?></p>

                    <h2>Buy me a coffee</h2>

                    <img _href="https://ko-fi.com/W7W7AMXI6" src="https://ko-fi.com/img/githubbutton_sm.svg" alt="">

                    <h2>Skills</h2>
                    <div class="flexwrap">
                        <ul>
                            <li>🦀 Rust</li>
                            <li>🐘 PHP</li>
                            <li>🌐 Javascript</li>
                            <li>🌐 HTML5</li>
                            <li>🌐 CSS3</li>
                            <li>🐚 Shell</li>
                            <li>🤓 C</li>
                        </ul>
                        <img src="https://github-readme-stats.vercel.app/api/top-langs/?username=SkwalExe&theme=dracula&layout=compact" alt="">
                    </div>

                    <h2>Presentation</h2>

                    <p class="bold">
                        Hello 👋 I'm Léopold Koprivnik Ibghy, aka SkwalExe, the founder of skwal.net.
                    </p>
                        <p>
                            I'm a 13 y/o French 🇫🇷 programming 💻 and Linux 🐧 lover. 💖
                            <br>
                            I use GitHub everyday since 2022/02/12 🤓.
                            <br>
                            I code in rust 🦀, bash 🐚, and web languages 🌐.
                            <br>
                            I also love making online courses for free 🆓
                            <br>
                            I can speak French 🇫🇷 and English 🇬🇧.
                            <br>
                            I use arch btw 🐧.
                            <br>
                        </p>
                    <h2>Config</h2>
                    <ul>
                        <li>IDE : VSCode</li>
                        <li>OS : Linux</li>
                        <li>Distro : Arch</li>
                        <li>Shell : zsh</li>
                        <li>Terminal editor : neovim</li>
                        <li>GPU : RTX 3060</li>
                        <li>CPU : AMD ryzen 7 3700X</li>
                        <li>RAM : 64GB DDR4 3600Hz</li>
                        <li>Monitors : 1920x1080, 3440x1440</li>
                        <li><a href="https://github.com/SkwalExe/dotfiles">Dotfiles</a></li>
                    </ul>


                </div>


            </div>
            <hr class="onlyShowWhenMobileWidth">
            <div class="sidebar">

                <div class="links box glowing">
                    <a _href="https://github.skwal.net"><img src="/assets/github.png" />Github</a>
                    <a _href="https://discord.skwal.net"><img src="/assets/discord.png" alt="">Discord</a>
                </div>

                <hr>

                <div class="oneColumnTiles">
                    <?php
                    projects();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php

    footer();

    js("functions", "navbar", "links", "tiles");
    ?>

</body>

</html>