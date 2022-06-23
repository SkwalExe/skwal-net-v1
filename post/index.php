<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
$error = !requireGet("id");

if (!$error) {


  $id = $_GET['id'];

  if (!postExists($id)) {
    $error = true;
    redirect("/", ["Error", "Post does not exist", "error"]);
  } else {

    $post = new Post($id);
    $post->load_comments();
    $post->incrementViews();
    $serverData['isPostAuthor'] = (isLoggedIn() && $post->author_id == $_SESSION['id']);
    $serverData['post'] = $post->toArray();
  }
} else
  redirect("/", ['Invalid Link', 'The post you are looking for is unavailable beacause you entered the wrong link. Missing "id" parameter', "error"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>


  <?php
  metadata();
  css("colors",  "global", "footer", "layout", "loadingScreen", "navbar", "tiles", "post", "avatar", "form");
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
        <div class=" content">

          <?= $post->HTML(); ?>

          <h1 class="center box glowing">Comments</h1>

          <?php
          if (isLoggedIn()) {
          ?>
            <form class="commentForm box glowing">
              <h1>Comment</h1>
              <input type="hidden" name="id" value="<?= $post->id; ?>">
              <textarea placeholder="Very interesting" type="text" name="content"></textarea>
              <button type="submit">Post</button>
            </form>
          <?php
          }

          if (count($post->comments) == 0)
            echo "<h1 class='center'>No comments yet</h1>";
          else {
            foreach ($post->comments as $comment) {
              $comment->load_user();
              echo $comment->HTML();
            }
          }
          ?>
        </div>
        <hr class="onlyShowWhenMobileWidth">
        <div class="sidebar">
          <?php
          if ($serverData['isPostAuthor']) {
          ?>
            <h1 class="glowing box center">Actions</h1>
            <div class="links box glowing">
              <a class="postDeleteButton"><i class="fa-solid fa-trash"></i> Delete</a>
              <a href="/profile/newPost?id=<?= $post->id ?>"><i class="fa-solid fa-edit"></i> Edit</a>
            </div>
          <?php
          }
          ?>
          <h1 class="glowing box center">
            Recent posts
          </h1>

          <?php printRecentPosts(); ?>

        </div>
      </div>
    </div>


  <?php
    loadingScreen();
    footer();
  }


  js("functions", "global", "navbar", "links", "tiles", "loadingScreen", "post", "postView", "commentForm", "comment");
  ?>

</body>

</html>