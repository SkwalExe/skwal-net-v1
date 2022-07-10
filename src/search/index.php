<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

if (requireGet("q")) {
  $q = $_GET['q'];
  $serverData['query'] = $q;
  $page = $_GET['page'] ?? 1;
  $serverData['page'] = $page;
  $searchFor = $_GET['searchFor'] ?? "posts";
  $serverData['searchFor'] = $searchFor;
} else {
  redirect("/forum/", ['Error', 'Missing search query', 'error']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  metadata();
  css();
  pageCss('searchBar', "form", "avatar", "post", 'searchPage', "user");
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
        <div class="content">
          <form method="GET" action="/search" class="box glowing search-bar">
            <input placeholder="How to split a string with javascript" required value="<?= htmlentities($q) ?>" name="q" type="text">
            <input type="hidden" name="searchFor" value="<?= $searchFor ?>">
            <button><i class="fa fa-search"></i></button>
          </form>

          <div class="box glowing flex tabs">
            <p class="tab posts-tab <?= $searchFor == "posts" ? "selected" : "" ?>">Posts</p>
            <p class="tab users-tab <?= $searchFor == "users" ? "selected" : "" ?>">Users</p>
          </div>

          <div class="results"></div>

        </div>
        <hr class="onlyShowWhenMobileWidth">
        <div class="sidebar">

          <h1 class="box glowing center">
            Pages
          </h1>
          <?php
          pages();
          ?>
          <hr>
          <h1 class="box glowing center">
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
  }
  js();
  pageJs('searchPage');
  ?>
</body>

</html>