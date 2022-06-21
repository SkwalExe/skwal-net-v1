<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
$error = true;
$serverData['editPost'] = false;
if (isLoggedIn()) {
  $error = false;
  if (requireGet("id")) {
    $id = $_GET['id'];
    $post = new Post($id);
    if ($post->author_id == $_SESSION['id']) {
      $error = false;
      $serverData['editPost'] = true;
    } else {
      $error = true;
      redirect("/", ['Error', 'You are not the author of the post you are trying to edit', "error"]);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <?php
  defaultHeaders();
  css("colors",  "global", "footer", "layout", "loadingScreen", "form",  "navbar", "tiles");
  ?>

</head>

<body>

  <?php
  navbarStart();

  navbarButton("Home", "/", "fa fa-home");

  navbarEnd();
  ?>
  <div class="mainContainer">

    <div class="main">
      <div class="small content">

        <h1 class="center box glowing">
          New post
        </h1>

        <div class="box glowing">
          <form>

            <?= $serverData['editPost'] ? "<input type='hidden' name='id' value='{$post->id}' >" : "" ?>

            <div class="input">
              <p class="inputLabel">
                Title
              </p>
              <input required placeholder="Title" type="text" name="title" <?= $serverData["editPost"] ? "value='{$post->title}'" : "" ?>>
            </div>

            <div class="input">
              <p class="inputLabel">
                Content
              </p>
              <textarea style="resize: vertical;" placeholder="Content" name="content" required><?= $serverData["editPost"] ? $post->content : "" ?></textarea>
            </div>

            <button type="submit">Post</button>

          </form>
        </div>

      </div>
      <hr class="onlyShowWhenMobileWidth">
      <div class="sidebar">


        <h1 class="center glowing box">
          Pages
        </h1>
        <?php
        pages();
        ?>

        <hr>

        <h1 class="center glowing box">
          Projects
        </h1>
        <?php
        projects();
        ?>
      </div>
    </div>
  </div>

  <?php
  loadingScreen();
  footer();

  js("functions", "global", "navbar", "links", "tiles", "loadingScreen", "newPost");
  ?>

</body>

</html>