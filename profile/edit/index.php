<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
$error = true;

if (requireGet('action', 'id', 'token')) {
  $action = $_GET['action'];
  $id = $_GET['id'];
  $token = $_GET['token'];
  if (userExists($id, "id")) {
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

    if ($action == "confirmAccountDeletion") {
      $user = new User($id);
      if ($user->accountDeletionToken == $token) {
        $user->delete();
        $_SESSION = [];
        redirect("/", ["Success", "Your account has been deleted.", "success"]);
      } else {
        redirect("/", ["Error", "Invalid token.", "error"]);
      }
    }
  } else {
    redirect("/", ["Error", "Invalid user.", "error"]);
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
  metadata();
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



          <h1 class="glowing box center">Profile <i class="fa fa-user"></i></h1>

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
              <button type="submit">Save</button>
            </form>
            <hr>
            <div class="flex">
              <button style="flex: 0.5" class="blue" _href="/profile/newPassword">Change password</button>
              <button style="flex: 0.5" class="delete-account-button red">Delete your account</button>
            </div>
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