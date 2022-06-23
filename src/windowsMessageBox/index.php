<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    metadata();
    css("colors",  "global", "footer", "layout", "loadingScreen", "form",  "navbar", "tiles");
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/windowsmessagebox@0.4.1/dist/wmsgbox.min.css">

</head>

<body>

    <?php
    navbarStart();

    navbarButton("Home", "/", "fa fa-home");

    navbarEnd();
    ?>
    <div class="mainContainer">

        <div class="main">
            <div class="small content">

                <h1 class="center box glowing">
                    WindowsMessageBox.js demo
                </h1>

                <div class="box glowing">
                    <p>
                        WindowsMessageBox.js - Create Windows-like 🪟 message boxes 💬 for your website
                    </p>
                </div>

                <div class="box glowing">
                    <div class="form">
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

                    <div class="flexwrap">
                        <button class="messageBox">Open message box</button>
                        <button class="red" onclick="windowsMessageBox.removeAll()">Clear all message boxes</button>
                    </div>
                </div>
                <div class="box glowing">
                    <div class="input">
                        <p class="inputLabel">Javascript</p>
                        <input style='width: 100%' class="javascript" readonly></input>
                    </div>
                </div>

            </div>
            <hr class="onlyShowWhenMobileWidth">
            <div class="sidebar">
                <h1 class="center glowing box">
                    Links
                </h1>
                <div class="links box glowing">
                    <a href="https://github.com/SkwalExe/WindowsMessageBox.js"><i class="fa-brands fa-github"></i>WindowsMessageBox.js</a>
                </div>

                <hr>


                <h1 class="center glowing box">
                    Pages
                </h1>
                <?php
                pages();
                ?>

                <hr>

                <h1 class="center glowing box">
                    Projects
                </h1>
                <?php
                projects();
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/SkwalExe/WindowsMessageBox.js@v0.4.1/dist/windowsMessageBox.min.js"></script>

    <?php
    loadingScreen();
    footer();

    js("functions", "global", "navbar", "links", "tiles", "loadingScreen", "messageBoxDemo");
    ?>

</body>

</html>