<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    defaultHeaders();
    css("colors",  "global", "footer", "layout", "loadingScreen", "form", "navbar", "tiles");
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



                <h1 class="glowing box center">
                    Memz.js demonstration
                </h1>
                <div class="box glowing">
                    <p>
                        Reload the page to stop the demo.
                    </p>
                </div>
                <div class="box glowing">
                    <div class="flexwrap" style="justify-content: center;">
                        <button class="red" onclick="Memz.all()">Memz.all()</button>
                        <button class="red" onclick="Memz.original()">Memz.original()</button>
                        <button onclick="Memz.errorSounds()">Memz.errorSounds()</button>
                        <button onclick="Memz.music()">Memz.music()</button>
                        <button onclick="Memz.messageBoxes()">Memz.messageBoxes()</button>
                        <button onclick="Memz.errorIcon()">Memz.errorIcon()</button>
                        <button onclick="Memz.invertColors()">Memz.invertColors()</button>
                        <button onclick="Memz.rotateElements()">Memz.rotateElements()</button>
                        <button onclick="Memz.zoomElements()">Memz.zoomElements()</button>
                        <button onclick="Memz.blockAllInputs()">Memz.blockAllInputs()</button>
                        <button onclick="Memz.changeCursor()">Memz.changeCursor()</button>
                    </div>
                </div>
                <div class="box glowing">
                    <p>The MEMZ trojan is a malware in the form of a trojan horse made for Microsoft Windows. MEMZ was originally created by Leurak for YouTuber danooct1's Viewer-Made Malware series</p>
                </div>
            </div>
            <hr class="onlyShowWhenMobileWidth">
            <div class="sidebar">
                <h1 class="glowing box center">
                    Links
                </h1>
                <div class="links box glowing">
                    <a _href="https://github.com/SkwalExe/memz.js"><i class="fa fa-github"></i>Memz.js</a>
                    <a _href="https://www.youtube.com/watch?v=f8LNz6gE_20"><i class="fa fa-youtube"></i>Original Virus</a>
                    <a _href="https://github.com/SkwalExe/Malwares/tree/main/Trojans/MEMZ"><i class="fa fa-download"></i>Download</a>
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

    <script src="https://cdn.jsdelivr.net/gh/SkwalExe/memz.js@0.1.0/dist/memz.min.js"></script>

    <?php
    loadingScreen();
    footer();

    js("functions", "global", "navbar", "links", "tiles", "loadingScreen");
    ?>



</body>

</html>