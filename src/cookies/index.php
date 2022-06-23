<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  metadata([
    "title" => '🍪 Skwal.net cookies policy',
    "description" => "Learn more about how skwal.net uses cookies 🍪"
  ]);
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
        <h1 class="center glowing box">Cookies policy 🍪</h1>
        <div class="box glowing markup">
          <h1>What is a cookie 🍪</h1>
          <p>Cookies 🍪, or internet cookies 🌐, are small lines of text with a name, they are stored by your web browser and they are usually used to identify you when you visit a website.</p>
        </div>

        <div class="box glowing markup">
          <h1>Two types of cookies 🍪</h1>
          <h3>Essential cookies ✅</h3>
          <p>Essential cookies are cookies that can only be accessed by one website. They are used to store information that is needed to make the website work properly, for example, to keep you logged in</p>
          <h3>Non-essential cookies 🤔</h3>
          <p>Non-essential cookies are cookies that can be accessed by multiple websites, they are not essential to the website.</p>
          <p>They are used to track the pages and sites that you visit to collect data about you and more.</p>
          <p>The data collected is usually sold to third parties, for analytics, marketing purposes, and to improve advertising</p>
        </div>

        <div class="box glowing markup">
          <h1>What type of cookies do we use? 🤔</h1>
          <p>At skwal.net, we only use <strong>Essential cookies</strong>, to keep you logged in to your account</p>
          <p>We don't and will never share or sell informations about what page you visited to third parties ✅</p>
        </div>

        <div class="box glowing markup">
          <h1>Your concent</h1>
          <p>If you don't accept our use of cookies, please don't use our services</p>
        </div>
      </div>
      <hr class="onlyShowWhenMobileWidth">
      <div class="sidebar">
        <h1 class="box glowing center">
          Links
        </h1>
        <div class="links box glowing">
          <a href="/privacy">🔒 Privacy policy</a>
          <a href="/tos">📜 Terms of service</a>
        </div>
        <hr>
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
  js("functions", "global", "navbar", "links", "tiles", "loadingScreen");
  ?>
</body>

</html>