<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
$error = !requireGet("id");

if (!$error) {

  $id = $_GET['id'];

  $post = new Post($id);

  $serverData['isPostAuthor'] = (isLoggedIn() && $post->author_id == $_SESSION['id']);
  $serverData['post'] = $post->toArray();
} else
  redirect("/", ['Invalid Link', 'The post you are looking for is unavailable beacause you entered the wrong link. Missing "id" parameter', "error"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>


  <?php
  defaultHeaders();
  css("colors",  "global", "footer", "layout", "loadingScreen", "navbar", "tiles", "post", "avatar");
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
        <div class=" content">

          <?= $post->HTML(); ?>

        </div>

        <hr class="onlyShowWhenMobileWidth">
        <div class="sidebar">
          <?php
          if ($serverData['isPostAuthor']) {
          ?>
            <h1 class="glowing box center">Actions</h1>
            <div class="links box glowing">
              <a class="postDeleteButton"><i class="fa-solid fa-trash"></i> Delete</a>
            </div>
          <?php
          }
          ?>
          <h1 class="glowing box center">
            Recent posts
          </h1>

          <?php recentPosts(); ?>

        </div>
      </div>
    </div>


  <?php
    loadingScreen();
    footer();
  }


  js("functions", "global", "navbar", "links", "tiles", "loadingScreen", "post", "postView");
  ?>

</body>

</html>