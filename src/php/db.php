<?php
try {
  $db = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8", $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);
} catch (Exception $e) {
  $arr = [
    "We have problems connecting to the database. Please try again later.",
    "Cannot connect to the database.",
    "Cannot connect to the database. Please try again later.",
    "The database is not available. Please try again later.",
    "We encountered a problem connecting to the database. Please try again later."
  ];
  shuffle($arr);

  echo ($arr[0]);
  die();
}
