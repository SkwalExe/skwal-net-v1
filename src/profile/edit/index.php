<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
$error = true;

if (requireGet('action', 'id', 'token')) {
  $action = $_GET['action'];
  $id = $_GET['id'];
  $token = $_GET['token'];

  if ($action == 'confirmNewEmail') {
    $user = new User($id);
    if ($user->newEmailToken == $token) {
      $sql = "UPDATE users SET email = ?, newEmail = NULL, newEmailToken = NULL WHERE id = ?";
      $stmt = $db->prepare($sql);
      $stmt->execute([$user->newEmail, $user->id]);

      redirect("/", ["Success", "Your email has been updated.", "success"]);
    } else {
      redirect("/", ["Error", "Invalid token.", "error"]);
    }
  }
} else {

  if (isLoggedIn()) {
    $user = new User($_SESSION['id']);
    $error = false;
  } else {
    redirect("/login", ["Error", "Please log in to edit your profile", "error"]);
  }
}

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
            <h1 class="section">Profile</h1>
          </div>

          <div class="box glowing">
            <form>
              <div class="input">
                <p class="inputLabel">Username</p>
                <input value="<?= $user->username ?>" type="username" autocomplete="username" name="username" placeholder="My_Username123" required>
              </div>
              <div class="input">
                <p class="inputLabel">Bio</p>
                <textarea class="bio fw" name="bio"><?= $user->bio ?></textarea>
              </div>
              <div class="input">
                <p class="inputLabel">Email</p>
                <input required value="<?= $user->email ?>" type="email" autocomplete="email" name="email" placeholder="email@example.com" required>
              </div>
              <hr>
              <button class="blue" _href="/profile/newPassword">Change password</button>
              <hr>
              <button type="submit">Save</button>
            </form>
          </div>

        </div>

      </div>
    </div>

  <?php
    loadingScreen();
    footer();
  }
  js("functions", "global", "navbar", "links", "tiles", "loadingScreen", "profileEdit");
  ?>

</body>

</html>