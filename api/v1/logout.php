<?php
include $_SERVER['DOCUMENT_ROOT'] . "/php/global.php";

$response = [
  "success" => false,
  "message" => "",
  "error" => "",
  "data" => null
];

$response["success"] = true;

if (isLoggedIn())
  $response["message"] = "Logged out.";
else
  $response["message"] = "Not logged in.";

$_SESSION = [];

http_response_code(200);
echo json_encode($response);
