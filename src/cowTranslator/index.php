<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    metadata([
        "title" => '🐮 Cow translator',
        "description" => "This cow translator 🐮 allows simple humans like you to communicate with these beautiful and charismatic cows 🐮✨"
    ]);
    css("form", "cowTranslator");
    ?>
</head>

<body>
    <?php
    if ($showPageContent) {
        navbarStart();
        navbarButton("Home", "/", "fa fa-home");
        navbarEnd();
    ?>
        <div class="mainContainer">
            <div class="main">
                <div class="content">
                    <h1 class="box glowing center">Cow translator 🐄</h1>
                    <div class="glowing box">
                        <p>Status : <span class="status">OK</span></p>
                    </div>
                    <div class="box glowing inputs">
                        <div>
                            <div class="buttons">
                                <button onclick="copyHuman()" class="green">Copy</button>
                                <button onclick="resetHuman()" class="red">Reset</button>
                            </div>
                            <textarea class="textInput" placeholder="Human language"></textarea>
                        </div>
                        <div>
                            <div class="buttons">
                                <button onclick="copyCow()" class="green">Copy</button>
                                <button onclick="resetCow()" class="red">Reset</button>
                            </div>
                            <textarea class="cowInput" placeholder="Cow language"></textarea>
                        </div>
                    </div>
                </div>
                <hr class="onlyShowWhenMobileWidth">
                <div class="sidebar">
                    <h1 class="box glowing center">
                        Links
                    </h1>
                    <div class="links box glowing">
                        <a href="https://github.com/SkwalExe/cowTranslator.js"><i class="fa fa-github"></i>cowTranslator.js</a>
                        <a href="https://github.com/SkwalExe/cow-translator"><i class="fa fa-github"></i>cowTranslator CLI</a>
                        <a href="https://github.com/SkwalExe/cow-encryptor"><i class="fa fa-github"></i>cowEncryptor</a>
                    </div>

                    <hr>

                    <h1 class="box glowing center">
                        Pages
                    </h1>
                    <?php
                    pages();
                    ?>

                    <hr>

                    <h1 class="box glowing center">
                        Projects
                    </h1>
                    <?php
                    projects();
                    ?>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/gh/SkwalExe/cowTranslator.js@v1.1.0/dist/cow-translator.min.js"></script>

    <?php
        loadingScreen();
        footer();
    }
    js("cowTranslator");
    ?>

</body>

</html>