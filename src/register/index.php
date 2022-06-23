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
  metadata([
    'title' => 'Create an account',
    "description" => "Create an account on the website"
  ]);
  css("colors",  "global", "footer", "layout", "loadingScreen", "navbar", "tiles", "form");
  ?>

</head>

<body>

  <?php
  if (!$error) {
    navbarStart();

    navbarButton("Home", "/", "fa fa-home");

    navbarEnd();
  ?>
    <div class="mainContainer">

      <div class="main">
        <div class="small content">



          <h1 class="center box glowing">Register <i class="fa fa-user-plus"></i></h1>

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

              <p style="text-align:center">By creating an account and using our services, you agree to our <a href="/privacy">Privacy policy 🔒</a> and to our <a href="/tos">Terms of service 📜</a></p>

            </form>
            <hr>
            <div class="flex center">
              <a href="/login"> Login to your account <i class="fa fa-sign-in"></i></a>
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