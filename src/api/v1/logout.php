<?php
include $_SERVER['DOCUMENT_ROOT'] . "/php/global.php";

$response = api_response();

api('GET', null);

$response["success"] = true;

if (isLoggedIn())
  $response["message"] = "Logged out.";
else
  $response["message"] = "Not logged in.";

logout();

http_response_code(200);
echo json_encode($response);
