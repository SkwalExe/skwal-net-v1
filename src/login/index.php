<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>


  <?php
  defaultHeaders();
  css("colors",  "global", "footer", "layout", "loadingScreen", "navbar", "tiles", "form");
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
      <div class="small content">



        <div class="box glowing">
          <h1 class="section">Login</h1>
        </div>

        <div class="box glowing">
          <form>
            <input type="hidden" name="identificator" value="email">
            <div class="input">
              <p class="inputLabel">Email</p>
              <input type="email" autocomplete="email" name="identification" placeholder="name@example.com" required>
            </div>
            <div class="input">
              <p class="inputLabel">Password</p>
              <input type="password" autocomplete="current-password" name="password" placeholder="P4assw0rd!!" required>
            </div>

            <button type="submit">Login</button>
          </form>
          <hr>
          <div class="flex">
            <a href="/register">Register</a>
            <p> - </p>
            <a href="/profile/newPassword">Forgot Password</a>
          </div>
        </div>

      </div>

    </div>
  </div>

  <?php
  loadingScreen();
  footer();

  js("functions", "global", "navbar", "links", "tiles", "loadingScreen", "login");
  ?>

</body>

</html>