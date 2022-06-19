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
    $user->loadPosts();
    $user->loadComments();
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
  css("colors", "global", "footer", "loadingScreen", "post", "navbar", "tiles", "avatar", "profile", "form");
  ?>

</head>

<body>

  <?php
  if (!$error) {
    navbarStart();
    if (!isLoggedIn())
      navbarButton("Login", "/login", "fa fa-sign-in");
    else if (isLoggedIn() && $_SESSION['id'] != $user->id)
      navbarButton("Your profile", "/profile", "fa fa-user");
    else if ($loggedInUserProfile) {
      navbarButton("Profile customization", "/profile/edit", "fa fa-cog");
      navbarButton("Logout", "javascript:logout();", "fa fa-sign-out");
      navbarButton("Settings", "/profile/settings", "fa fa-cog");
    }
    navbarButton("Home", "/", "fa fa-home");
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
            <h1 class="break username"><?= $user->username ?><?php $user->printRoles(); ?></h1>
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
            <button onclick="copyProfileUrl()">Copy Profile URL</button>
          </div>
        </div>
        <div class="noSelect tabs">
          <p class="selected posts-button">Posts</p>
          <p class="comments-button">Comments</p>
          <p class="about-button">About</p>
        </div>
        <div class="posts">
          <?php
          if ($loggedInUserProfile)
            echo '<button class="newPostButton" href="/profile/newPost">New post</button>';
          ?>
          <div class="postsContainer">
            <?php
            foreach ($user->posts as $post) {
              echo "<div toultip='Open post' href='/post?id=$post->id'>";
              echo $post->HTML(200, false);
              echo "</div>";
            }

            if (count($user->posts) == 0) {
              echo "<h1 class='center glowing box bg1'>No posts yet</h1>";
            }
            ?>
          </div>
        </div>
        <div class="hidden comments">
          <div class="commentsContainer">
            <?php

            foreach ($user->comments as $comment) {
              echo "<div toultip='Open post' href='/post?id=$comment->post_id'>";
              echo $comment->HTML();
              echo "</div>";
            }

            if (count($user->comments) == 0) {
              echo "<h1 class='center glowing box bg1'>No comments yet</h1>";
            }

            ?>
          </div>
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


  js("functions", "global", "navbar", "links", "tiles", "loadingScreen", "profile", "post");

  ?>

</body>

</html>