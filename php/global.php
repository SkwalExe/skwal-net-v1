<?php
include("{$_SERVER['DOCUMENT_ROOT']}/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable("{$_SERVER['DOCUMENT_ROOT']}/..");
$dotenv->load();

include("{$_SERVER['DOCUMENT_ROOT']}/php/variables.php");
include("{$_SERVER['DOCUMENT_ROOT']}/php/db.php");
include("{$_SERVER['DOCUMENT_ROOT']}/php/functions.php");

// import all files in the classes folder
foreach (glob("{$_SERVER['DOCUMENT_ROOT']}/php/classes/*.php") as $filename) {
  include $filename;
}

session_start();

$serverData = [
  "ip" => $ip,
  "version" => $version,
  "loggedIn" => isLoggedIn(),
  "user" => isLoggedIn() ? $_SESSION : null
];
