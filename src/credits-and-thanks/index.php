<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  metadata([
    "title" => "🙏 Credits and thanks",
    "description" => "List of people and projects who helped in the website creation"
  ]);
  css();
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
        <div class="content small">
          <h1 class="center box glowing">Credit and Thanks 🙏</h1>
          <div class="box glowing markup">
            <h1>Contributors</h1>
            <ul>
              <li><a href="https://github.com/SkwalExe"><i class="fa-brands fa-github"></i> Léopold Koprivnik (founder)</a></li>
            </ul>
          </div>
          <div class="box glowing markup">
            <h1>Projects used</h1>
            <ul>
              <li><a href="https://github.com/FortAwesome/Font-Awesome">Fontawesome <i class="fa-solid fa-font-awesome"></i></a></li>
              <li><a href="https://github.com/SkwalExe/Toultip.js">Toultip.js</a></li>
              <li><a href="https://github.com/SkwalExe/MessageBox.js">MessageBox.js</a></li>
              <li><a href="https://github.com/SkwalExe/memz.js">Memz.js</a></li>
              <li><a href="https://github.com/SkwalExe/Toasteur.js">Toasteur.js</a></li>
              <li><a href="https://github.com/SkwalExe/WindowsMessageBox.js">WindowsMessageBox.js</a></li>
              <li><a href="https://github.com/SkwalExe/cowTranslator.js">cowTranslator.js</a></li>
              <li><a href="https://github.com/SkwalExe/FakeFileSystem.js">FakeFileSystem.js</a></li>
              <li><a href="https://github.com/SkwalExe/skwash.js">Skwash.js</a></li>
              <li><a href="https://github.com/SkwalExe/cmdline-parser.js">cmdline-parser.js</a></li>
            </ul>
          </div>
        </div>
        <hr class="onlyShowWhenMobileWidth">
        <div class="sidebar">

          <h1 class="box glowing center">
            Pages
          </h1>
          <?php
          pages();
          ?>
        </div>
      </div>
    </div>
  <?php
    loadingScreen();
    footer();
  }
  js();
  ?>
</body>

</html>