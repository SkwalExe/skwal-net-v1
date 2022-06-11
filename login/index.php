<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
$error = isLoggedIn();

if ($error)
  redirect("/profile", ['Already Logged In!', "You are already logged in to your account.", "error"]);
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
  if (!$error) {
    navbarStart();

    navbarButton("Home", "/", "home.png");

    navbarEnd();

  ?>
    <div class="mainContainer">

      <div class="main">
        <div class="small content">



          <h1 class="glowing box center">Login</h1>

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
            <div class="flex center">
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
  }


  js("functions", "global", "navbar", "links", "tiles", "loadingScreen", "login");
  ?>

</body>

</html>