<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
$serverData['editPost'] = false;
if (isLoggedIn()) {
  if (requireGet("id")) {
    $id = $_GET['id'];
    $post = new Post($id);
    if ($post->author_id == $_SESSION['id']) {
      $serverData['editPost'] = true;
    } else {
      redirect("/", ['Error', 'You are not the author of the post you are trying to edit', "error"]);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <?php
  metadata([
    "title" => "Create a new post",
    "description" => "Create a new post on the skwal.net's forum",
  ]);
  css();
  pageCss("form");
  ?>

</head>

<body>

  <?php
  if ($showPageContent) {
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
                <input required placeholder="Title" type="text" name="title" <?= $serverData["editPost"] ? "value='" . htmlentities($post->title) . "'" : "" ?>>
              </div>

              <div class="input">
                <p class="inputLabel">
                  Content
                </p>
                <textarea style="resize: vertical;" placeholder="Content" name="content" required><?= $serverData["editPost"] ? htmlentities($post->content) : "" ?></textarea>
              </div>

              <button type="submit">Post</button>

            </form>
          </div>

          <div toultip="preview" class="break preview box glowing">

          </div>

        </div>
        <hr class="onlyShowWhenMobileWidth">
        <div class="sidebar">
          <h1 class="center glowing box">Projects</h1>
          <?php
          projects();
          ?>
        </div>
      </div>
    </div>

  <?php
    loadingScreen();
    footer();
  }
  js();
  pageJs("newPost");
  ?>

</body>

</html>