<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  metadata([
    "title" => "Morse translator",
    "description" => "This morse translator allows you to translate morse code or taps to text",
    "large" => true,
    "image" => "/assets/morse.png"
  ]);
  css();
  pageCss('morse', "form");
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
          <h1 class="center box glowing">Morse taps to text</h1>
          <div class="box glowing">
            <h2>Unit duration (in millis)</h2>
            <input type="number" class="duration-input" min="20" max="1000" value="150" />
          </div>
          <div class="big-button-container box glowing">
            <button class="big-button">Tap here</button>
          </div>

          <div class="textareas box glowing">
            <div class="inputs">
              <div>
                <h2>Morse</h2>
                <div class="buttons">
                  <button class="morse-input-copy green">Copy</button>
                  <button class="morse-input-clear red">Clear</button>
                </div>
                <textarea class="morse-input fw"></textarea>
              </div>
              <div>
                <h2>Text</h2>
                <div class="buttons">
                  <button class="text-input-copy green">Copy</button>
                  <button class="text-input-clear red">Clear</button>
                </div>
                <textarea class="text-input fw"></textarea>
              </div>
            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/morse-lib@1.1.1/dist/morse-lib.umd.min.js"></script>
  <?php
    loadingScreen();
    footer();
  }

  js();
  pageJs("morse");
  ?>
</body>

</html>