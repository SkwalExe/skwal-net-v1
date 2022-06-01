<?php
include $_SERVER['DOCUMENT_ROOT'] . "/php/global.php";

$response = [
  "success" => false,
  "message" => "",
  "error" => "",
  "data" => null
];

if ($_SERVER['REQUEST_METHOD'] != "GET") {
  $response['error'] = "Only GET requests are accepted";
  echo json_encode($response);
  http_response_code(405);
  die();
}

$response["success"] = true;

if (isLoggedIn())
  $response["message"] = "Logged out.";
else
  $response["message"] = "Not logged in.";


session_unset();
session_destroy();
setcookie('PHPSESSID', null, -1, '/');

http_response_code(200);
echo json_encode($response);
