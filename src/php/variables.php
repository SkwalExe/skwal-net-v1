<?php

$root = $_SERVER['DOCUMENT_ROOT'];
$ip = $_SERVER["REMOTE_ADDR"];
$assets = "$root/assets";
$scripts = "$root/scripts";

$version = "microwave";

$defaultSettings = [
  "borders" => false,
  "color" => "#CE6B82",
];

$showPageContent = true;
$loadDefaultCss = true;
$loadDefaultJs = true;
$redirected = false;
