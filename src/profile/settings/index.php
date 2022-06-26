<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

if (isLoggedIn())
  $user = new User($_SESSION['id']);
else
  redirect("/login", ["Error", "Please log in to edit your profile", "error"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>


  <?php
  metadata([
    "title" => "Edit your profile's settings",
    "description" => "Customize the look of the website",
  ]);
  css();
  pageCss("form");
  ?>

</head>

<body>

  <?php
  if ($showPageContent) {
    navbarStart();
    navbarButton("Profile", "/profile", "fa fa-user");
    navbarEnd();
  ?>
    <div class="mainContainer">

      <div class="main">
        <div class="small content">

          <h1 class="glowing box center">Settings <i class="fa fa-cog"></i></h1>

          <div class="box glowing">
            <form>
              <div class="input">
                <p class="inputLabel">Borders</p>
                <select class="borders-input" name="borders">
                  <option value="show" <?= $user->settings['borders'] ? "selected" : "" ?>>Show</option>
                  <option value="hide" <?= !$user->settings['borders'] ? "selected" : "" ?>>Hide</option>
                </select>
              </div>
              <div class="input">
                <p class="inputLabel">Color</p>
                <input value="<?= $user->settings["color"] ?>" type="color" class="color-input" name="color">
              </div>
              <hr>
              <button type="submit">Save</button>
            </form>
            <hr>
            <div class="form">
              <button class="red reset-settings">Reset settings</button>
            </div>
          </div>

        </div>

      </div>
    </div>

  <?php
    loadingScreen();
    footer();
  }
  js();
  pageJs("settings");
  ?>

</body>

</html>