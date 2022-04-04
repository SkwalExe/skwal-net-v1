<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    defaultHeaders();
    css("colors", "navbar", "global", "tiles", "main", "footer");
    ?>

</head>

<body>

    <div class="navbar">
        <div class="container">

            <div class="nav-top">
                <div _href="https://github.com/SkwalExe/" class="logo">
                    <img src="assets/github.png" alt="">
                    <p class="text"><span class="purp">Skwal</span><span>Exe</span></p>
                </div>
                <div class="menu" id="toggleButton">
                    <div class="menu-line"></div>
                    <div class="menu-line"></div>
                    <div class="menu-line"></div>
                </div>

            </div>
            <ul id="navList">
                <li href="https://github.com/SkwalExe/">Github<img src="/assets/github.png"></li>
            </ul>
        </div>

    </div>

    <div class="main">
        <p class="bio">Hello 👋 I'm Léopold Koprivnik Ibghy, aka SkwalExe. I'm a 14 y/o French 🇫🇷 programming 💻 and Linux 🐧 lover. I use GitHub everyday since 2022/02/12. I code in rust 🦀, bash 🐚, and web languages 🌐. I also love making online courses.</p>

        <h1 class="section">
            My projects
        </h1>
        <div class="tilesContainer">
            <div class="tiles">
                <div class="tile" _href="https://github.com/SkwalExe/cow-encryptor">
                    <div class="head">
                        <span class="title">
                            Cow encryptor 🐮
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            Encrypt your files in cow language 🐄
                        </p>
                        <img src="https://github.com/SkwalExe/cow-encryptor/raw/main/images/banner.png" alt="" class="banner">
                    </div>

                </div>

                <div class="tile" _href="https://github.com/SkwalExe/TypeRacer-F1">
                    <div class="head">
                        <span class="title">
                            TypeRacer-F1 🏎️
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            Autotyper for typeracer.com 🏎️
                        </p>
                        <img src="https://github.com/SkwalExe/TypeRacer-F1/raw/main/screenshot.gif" alt="" class="banner">
                    </div>

                </div>
                <div class="tile" _href="https://github.com/SkwalExe/TenFastFingersBot">
                    <div class="head">
                        <span class="title">
                            TenFastFingersBot
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            Bot for 10fastfingers.com ⌨️
                        </p>
                        <img src="https://github.com/SkwalExe/TenFastFingersBot/raw/main/images/screenshot.gif" alt="" class="banner">
                    </div>

                </div>
                <div class="tile" _href="https://github.com/SkwalExe/typrint">
                    <div class="head">
                        <span class="title">
                            Typrint ⌨️
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            Print text with a typing effect - Made with rust 🦀
                        </p>
                        <img src="https://github.com/SkwalExe/typrint/raw/main/images/1.gif" alt="" class="banner">
                    </div>

                </div>
                <div class="tile" _href="https://github.com/SkwalExe/mini-matrix">
                    <div class="head">
                        <span class="title">
                            Mini-matrix
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            🧑‍💻 Output random 0 and 1 or custom characters with a matrix-like effect 🔢
                        </p>
                        <img src="https://github.com/SkwalExe/mini-matrix/raw/main/images/screenshot2.png" alt="" class="banner">
                    </div>

                </div>
                <div class="tile" _href="https://github.com/SkwalExe/lsd-print">
                    <div class="head">
                        <span class="title">
                            lsd-print 🧪
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            🧪 Just a print tool, but we gave it lsd
                        </p>
                        <img src="https://github.com/SkwalExe/lsd-print/raw/main/images/1.png" alt="" class="banner">
                    </div>

                </div>
                <div class="tile" _href="https://github.com/SkwalExe/linux-on-drugs">
                    <div class="head">
                        <span class="title">
                            linux-on-drugs 💊
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            Gives custom drugs to your terminal 💊 - Output random colors really fast
                        </p>
                        <img src="https://github.com/SkwalExe/linux-on-drugs/raw/main/images/1.gif" alt="" class="banner">
                    </div>

                </div>
                <div class="tile" _href="https://github.com/SkwalExe/rmini-matrix">
                    <div class="head">
                        <span class="title">
                            Rmini-matrix
                        </span>
                        <img src="/assets/github.png" alt="" class="icon">
                    </div>
                    <div class="body">
                        <p class="text">
                            🦀 rust implementation of mini-matrix - much faster
                            <br>👨‍💻 Output random 0 and 1 or custom characters with a matrix-like effect
                        </p>
                        <img src="https://github.com/SkwalExe/rmini-matrix/raw/main/images/1.png" alt="" class="banner">
                    </div>

                </div>

                <div class="tile" _href="https://github.com/SkwalExe/rust-logging">
                    <div class="head">
                        <span class="title">
                            rust-logging
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            💬 A couple of functions to make logging in Rust easier.
                        </p>
                        <img src="https://github.com/SkwalExe/rust-logging/raw/main/images/1.png" alt="" class="banner">
                    </div>

                </div>
                <div class="tile" _href="https://github.com/SkwalExe/cow-translator">
                    <div class="head">
                        <span class="title">
                            cow-translator 🐮
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            Official moo translator to communicate with cows 🐮
                        </p>
                        <img src="https://github.com/SkwalExe/cow-translator/raw/main/images/1.png" alt="" class="banner">
                    </div>

                </div>
                <div class="tile" _href="https://github.com/SkwalExe/help-ukraine">
                    <div class="head">
                        <span class="title">
                            help-ukraine 🇺🇦
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            🇺🇦 Help ukraine in the cyberwar against russia by DDOSing russia government website
                        </p>
                        <img src="https://github.com/SkwalExe/help-ukraine/raw/main/images/1.png" alt="" class="banner">
                    </div>

                </div>
                <div class="tile" _href="https://github.com/SkwalExe/dtodo">
                    <div class="head">
                        <span class="title">
                            dtodo
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            📜 Manage the tasks you want to do every day easily
                        </p>
                        <img src="https://github.com/SkwalExe/dtodo/raw/main/images/1.png" alt="" class="banner">
                    </div>

                </div>
                <div class="tile" _href="https://github.com/SkwalExe/dotfiles">
                    <div class="head">
                        <span class="title">
                            dotfiles 💠
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            💠 My personal dotfiles
                        </p>
                        <img src="https://github.com/SkwalExe/dotfiles/raw/main/1.png" alt="" class="banner">
                    </div>

                </div>
                <div class="tile" _href="https://github.com/SkwalExe/Malwares">
                    <div class="head">
                        <span class="title">
                            Malwares 👹
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            👹 Malwares and jokewares database
                        </p>
                        <img src="https://github.com/SkwalExe/Malwares/raw/main/images/memz.gif" alt="" class="banner">
                    </div>

                </div>
                <div class="tile" _href="https://github.com/SkwalExe/les-maths">
                    <div class="head">
                        <span class="title">
                            ❌ les maths
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            ✖️ Cours de maths gratuits en francais 🇫🇷
                        </p>
                        <img src="https://github.com/SkwalExe/les-maths/raw/main/images/banner.png" alt="" class="banner">
                    </div>

                </div>

                <div class="tile" _href="https://github.com/SkwalExe/apprendre-rust">
                    <div class="head">
                        <span class="title">
                            Apprendre-rust 🦀
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            Cours gratuits de Rust 🦀 en Francais 🇫🇷
                        </p>
                        <img src="https://github.com/SkwalExe/apprendre-rust/raw/main/images/banner.png" alt="" class="banner">
                    </div>

                </div>

                <div class="tile" _href="https://github.com/SkwalExe/les-maths">
                    <div class="head">
                        <span class="title">
                            learn-rust 🦀
                        </span>
                    </div>
                    <div class="body">
                        <p class="text">
                            Free Rust 🦀 course in English 🇬🇧
                        </p>
                        <img src="https://github.com/SkwalExe/apprendre-rust/raw/main/images/banner.png" alt="" class="banner">
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="footer">
        © 2018-<?= date('Y') ?>, Léopold Koprivnik Ibghy, all rights reserved
        <br>This website is open source and is available on <a href="https://github.com/SkwalExe/skwal.net">GitHub</a>
    </div>

    <?php
    js("functions", "navbar", "links");
    ?>

</body>

</html>