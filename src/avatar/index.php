<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");
$path = __DIR__ . "../../../user-content/avatar/default.png";

if (requireGet('username')) {
  $username = $_GET['username'];
  if (userExists($username, "username")) {
    $user = new User($username, "username");
    $path = __DIR__ . "../../../user-content/avatar/" . $user->avatar;
  }
}

$image_info = getimagesize($path);

header("Content-type: {$image_info['mime']}");

readfile($path);
exit;
