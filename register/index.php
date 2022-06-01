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



          <div class="box glowing">
            <h1 class="section">Register</h1>
          </div>

          <div class="box glowing">
            <form>
              <div class="input">
                <p class="inputLabel">Username</p>
                <input type="username" autocomplete="username" name="username" placeholder="myUsername123" required>
              </div>
              <div class="input">
                <p class="inputLabel">Email</p>
                <input type="email" autocomplete="email" name="email" placeholder="name@example.com" required>
              </div>
              <div class="input">
                <p class="inputLabel">Password</p>
                <input type="password" autocomplete="new-password" name="password" class="password" placeholder="P4assw0rd!!" required>
              </div>
              <div class="input">
                <p class="inputLabel">Confirm Password</p>
                <input type="password" autocomplete="new-password" class="passwordConfirmation" placeholder="P4assw0rd!!" required>
              </div>

              <button type="submit">Register</button>
            </form>
            <hr>
            <div class="flex">
              <a href="/login">Login to your account</a>
            </div>
          </div>

        </div>

      </div>
    </div>

  <?php
  }
  loadingScreen();
  footer();

  js("functions", "global", "navbar", "links", "tiles", "loadingScreen", "register");
  ?>

</body>

</html>