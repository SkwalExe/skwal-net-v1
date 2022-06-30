<?php
include $_SERVER['DOCUMENT_ROOT'] . "/php/global.php";
$response = api_response();
api('GET', null);

if (!isLoggedIn()) {
  $response["error"] = "Not logged in";
  http_response_code(409);
  echo json_encode($response);
  die();
}

$current_user->requireLogin();

$response["success"] = true;
$response["message"] = "Successfully logged out all devices";

http_response_code(200);
echo json_encode($response);
