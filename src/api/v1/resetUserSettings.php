<?php
include $_SERVER['DOCUMENT_ROOT'] . "/php/global.php";

$response = api_response();

api('GET', null);

$response["success"] = true;

if (!isLoggedIn()) {
  $response["error"] = "Not logged in.";
  http_response_code(409);
  echo json_encode($response);
  die();
}

$sql = "UPDATE users SET settings = '{}' WHERE id = ?";

$stmt = $db->prepare($sql);
$stmt->execute([$_SESSION['id']]);

$response['message'] = "Settings reset.";
$response["success"] = true;
http_response_code(200);
echo json_encode($response);
