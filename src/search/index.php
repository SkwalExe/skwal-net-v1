<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  metadata();
  css("colors",  "global", "footer", "layout", "loadingScreen", "navbar", "tiles");
  ?>
</head>

<body>
  <?php
  navbarStart();
  navbarButton("Home", "/", "fa fa-home");
  navbarEnd();
  ?>
  <div class="mainContainer">
    <div class="main">
      <div class="content">
        <h3 class="center box glowing">We are still implementing this feature, try again later</h3>
      </div>
      <hr class="onlyShowWhenMobileWidth">
      <div class="sidebar">

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
  <?php
  loadingScreen();
  footer();
  js("functions", "global", "navbar", "links", "tiles", "loadingScreen");
  ?>
</body>

</html>