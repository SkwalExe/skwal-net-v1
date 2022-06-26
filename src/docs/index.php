<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

$defaultSection = "introduction";
$defaultModule = ".";

$module = $_GET['module'] ?? $defaultModule;
$section = $_GET['section'] ?? $defaultSection;

$dirContent = array_diff(scandir("sections"), ['..']);

$modules = array_filter($dirContent, function ($file) {
  return is_dir("sections/$file");
});
if (!in_array($module, $modules)) {
  redirect("/docs/", ["Error!", "Invalid module parameter", "error"]);
} else {
  $dirContent = array_diff(scandir("sections/" . $module), ["..", "."]);

  $sections = array_filter($dirContent, function ($file) {
    return strpos($file, ".md") !== false;
  });

  $sections = array_map(function ($file) {
    return substr($file, 0, -3);
  }, $sections);

  if (!in_array($section, $sections)) {
    $redirectTo = ($module == $defaultModule) ? "/docs/" : "/docs/$module/";
    redirect($redirectTo, ["Error!", "Invalid section parameter", "error"]);
  } else {
    $sectionContent = file_get_contents("sections/$module/$section.md");
    $sectionContentHTML = parseMarkdown($sectionContent);

    $sidebarContent = file_get_contents("sections/$module/_sidebar.md");
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
            <?= $sectionContentHTML ?>
          </div>
        </div>
        <hr class="onlyShowWhenMobileWidth">
        <div class="sidebar">
          <h1 class="box glowing center">
            Sections
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