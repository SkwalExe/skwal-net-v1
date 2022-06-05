<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
$error = true;

$loggedInUserProfile = false;

if (!isLoggedIn() && !requireGet("username")) {
  http_response_code(401);
  redirect("/login", ["Error", "Please log in to access your profile", "error"]);
} else {
  $username = $_GET['username'] ?? $_SESSION['username'];

  if (!userExists($username)) {
    http_response_code(404);
    redirect("/", ["Error", "Cannot find any user with this username."]);
  } else {
    $error = false;
    $user = new User($username, "username");
    $serverData["profile"] = $user->toArray();
    $loggedInUserProfile = (isLoggedIn() && $_SESSION['id'] == $user->id);
  }
}

$serverData['loggedInUserProfile'] = $loggedInUserProfile;


?>

<!DOCTYPE html>
<html lang="en">

<head>


  <?php
  defaultHeaders();
  css("colors", "global", "footer", "loadingScreen", "navbar", "tiles", "profile", "form");
  ?>

</head>

<body>

  <?php
  if (!$error) {
    navbarStart();
    if (!isLoggedIn())
      navbarButton("Login", "/login", "login.png");
    else if (isLoggedIn() && $_SESSION['id'] != $user->id)
      navbarButton("Your profile", "/profile", "profile.png");
    else if ($loggedInUserProfile) {
      navbarButton("Profile customization", "/profile/edit", "settings.png");
      navbarButton("Logout", "javascript:logout();", "logout.png");
    }
    navbarButton("Home", "/", "home.png");
    navbarEnd();
  ?>
    <div class="mainContainer">
      <div class="main glowing">
        <div <?= $loggedInUserProfile ? "toultip='Click to change your banner'" : "" ?> class="bannerContainer">
          <img src="/banner/?username=<?= $user->username ?>&v=<?= $user->bannerVersion ?>" alt="" class="banner">
        </div>
        <div class="profileContainer">
          <div <?= $loggedInUserProfile ? "toultip='Click to change your avatar'" : "" ?> class="avatarContainer">
            <img src="/avatar/?username=<?= $user->username ?>&v=<?= $user->avatarVersion ?>" alt="" class="avatar">
          </div>
          <div class="noSelect profileInformations">
            <h1 class="section break username"><?= $user->username ?></h1>
            <p><span class="followerCount"><?= $user->followerCount ?></span> Followers</p>
            <?php
            if (isLoggedIn()) {
              if ($loggedInUserProfile) {
                echo '<button _href="/profile/edit" class="blue">Edit profile</button>';
              } else {
                $following = $user->isFollowedBy($_SESSION['id']);
                echo '<button ' . (!$following ? 'style="display:none"' : '') . ' class="unfollowButton gray">Unfollow</button>';
                echo '<button ' . ($following ? 'style="display:none"' : '') . ' class="followButton red">Follow</button>';
              }
            } else {
              echo '<h5><a href="/login">Log in</a> to follow</h5>';
            }
            ?>
          </div>
        </div>
        <div class="noSelect tabs">
          <p class="selected posts-button">Posts</p>
          <p class="comments-button">Comments</p>
          <p class="about-button">About</p>
        </div>
        <div class="posts">
          <p>soon</p>
        </div>
        <div class="hidden comments">
          <p>soon</p>
        </div>
        <div class="hidden about">
          <h5 class="createdAt">Joined on <?= date("F j, Y", strtotime($user->createdAt)) ?></h5>
          <p class="break"><?= htmlentities($user->bio) ?></p>
        </div>
      </div>
    </div>

  <?php
    loadingScreen();
    footer();
  }


  js("functions", "global", "navbar", "links", "tiles", "loadingScreen", "profile");

  ?>

</body>

</html>