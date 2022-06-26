<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

$defaultPage = "introduction";
$defaultSection = ".";

$section = $_GET['section'] ?? $defaultSection;
$page = $_GET['page'] ?? $defaultPage;

$dirContent = array_diff(scandir("pages"), ['..']);

$sections = array_filter($dirContent, function ($file) {
  return is_dir("pages/$file");
});
if (!in_array($section, $sections)) {
  redirect("/docs/", ["Error!", "Invalid section parameter", "error"]);
} else {
  $dirContent = array_diff(scandir("pages/" . $section), ["..", "."]);

  $pages = array_filter($dirContent, function ($file) {
    return strpos($file, ".md") !== false;
  });

  $pages = array_map(function ($file) {
    return substr($file, 0, -3);
  }, $pages);

  if (!in_array($page, $pages)) {
    $redirectTo = ($section == $defaultSection) ? "/docs/" : "/docs/$section/";
    redirect($redirectTo, ["Error!", "Invalid page parameter", "error"]);
  } else {
    $pageContent = file_get_contents("pages/$section/$page.md");
    $pageContentHTML = parseMarkdown($pageContent);

    $sidebarContent = file_get_contents("pages/$section/_sidebar.md");
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