<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    defaultHeaders();
    css("colors",  "global", "footer", "layout", "loadingScreen", "form",  "navbar", "notifications", "tiles");
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

                <div class="box glowing title">
                    <h1 class="section break">
                        WindowsMessageBox.js demo
                    </h1>
                </div>

                <div class="box glowing">
                    <p>
                        WindowsMessageBox.js - Create Windows-like 🪟 message boxes 💬 for your website
                    </p>
                </div>

                <div class="box glowing">
                    <div class="flexInputs">
                        <div class="input">
                            <p class="inputLabel">Message box title</p>
                            <input placeholder="My title" type="text" value="My title" class="title">
                        </div>
                        <div class="input">
                            <p class="inputLabel">Content</p>
                            <input placeholder="This is the content of the message box" value="Hello World!" type="text" class="message">
                        </div>

                        <div class="input">
                            <p class="inputLabel">Type</p>
                            <select class="type">
                                <option value="info">Info</option>
                                <option value="warning">Warning</option>
                                <option value="error">Error</option>
                            </select>
                        </div>

                        <div class="input">
                            <p class="inputLabel">Position on the screen</p>
                            <select class="position">
                                <option value="random">random</option>
                                <option value="normal">normal</option>
                            </select>
                        </div>

                        <div class="input">
                            <p class="inputLabel">Button content</p>
                            <input placeholder="OK" value="OK" type="text" class="buttonContent">
                        </div>

                    </div>
                    <br>

                    <p class="info">Possibility to add more buttons when using the library</p>
                    <hr>
                    <button class="messageBox">Open message box</button>
                    <hr>
                    <div class="input">
                        <p class="inputLabel">Javascript</p>
                        <input style='width: 100%' class="javascript" readonly></input>
                    </div>
                </div>

            </div>
            <hr class="onlyShowWhenMobileWidth">
            <div class="sidebar">
                <h1 class="sideBarTitle">
                    Links
                </h1>
                <div class="links box glowing">
                    <a href="https://github.com/SkwalExe/WindowsMessageBox.js"><img src="/assets/github.png" />WindowsMessageBox.js</a>
                </div>

                <hr>


                <div class="oneColumnTiles">
                    <h1 class="sideBarTitle">
                        Pages
                    </h1>
                    <?php
                    pages();
                    ?>
                </div>

                <hr>

                <div class="oneColumnTiles">
                    <h1 class="sideBarTitle">
                        Projects
                    </h1>
                    <?php
                    projects();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/SkwalExe/windowsMessageBox.js@main/src/windowsMessageBox.min.js"></script>

    <?php
    loadingScreen();
    footer();

    js("functions", "global", "notifications", "navbar", "links", "tiles", "loadingScreen", "messageBoxDemo");
    ?>

</body>

</html>