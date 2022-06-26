<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

$defaultPage = "introduction";
$defaultModule = ".";

$module = $_GET['module'] ?? $defaultModule;
$page = $_GET['page'] ?? $defaultPage;

$dirContent = array_diff(scandir("pages"), ['..']);

$modules = array_filter($dirContent, function ($file) {
  return is_dir("pages/$file");
});
if (!in_array($module, $modules)) {
  redirect("/docs/", ["Error!", "Invalid module parameter", "error"]);
} else {
  $dirContent = array_diff(scandir("pages/" . $module), ["..", "."]);

  $pages = array_filter($dirContent, function ($file) {
    return strpos($file, ".md") !== false;
  });

  $pages = array_map(function ($file) {
    return substr($file, 0, -3);
  }, $pages);

  if (!in_array($page, $pages)) {
    $redirectTo = ($module == $defaultModule) ? "/docs/" : "/docs/$module/";
    redirect($redirectTo, ["Error!", "Invalid page parameter", "error"]);
  } else {
    $pageContent = file_get_contents("pages/$module/$page.md");
    $pageContentHTML = parseMarkdown($pageContent);

    $sidebarContent = file_get_contents("pages/$module/_sidebar.md");
    $sidebarContentHTML = parseMarkdown($sidebarContent);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  metadata();
  css();
  ?>
</head>

<body>
  <?php
  if ($showPageContent) {
    navbarStart();
    if ($module != $defaultModule)
      navbarButton("Documentation home page", "/docs", "fa fa-home");
    navbarButton("Home", "/", "fa fa-home");
    navbarEnd();
  ?>
    <div class="mainContainer">
      <div class="main">
        <div class="content">
          <div class="box glowing markup">
            <?= $pageContentHTML ?>
          </div>
        </div>
        <hr class="onlyShowWhenMobileWidth">
        <div class="sidebar">
          <h1 class="box glowing center">
            Pages
          </h1>
          <div class="links box glowing">
            <?= $sidebarContentHTML ?>
          </div>
        </div>
      </div>
    </div>
  <?php
    loadingScreen();
    footer();
  }
  js();
  ?>
</body>

</html>