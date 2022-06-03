<?php
include $_SERVER['DOCUMENT_ROOT'] . "/php/global.php";
$response = api_response();

api();

if (isLoggedIn()) {
  $response["error"] = "Already logged in.";
  http_response_code(409);
  echo json_encode($response);
  die();
}


if (requirePost('password', 'identification')) {
  $identification = $_POST['identification'];
  $password = $_POST['password'];
  $identificator = $_POST['identificator'] ?? "username";
  if (!preg_match("/^(email|username|id)$/", $identificator)) {
    $response["error"] = "Invalid identificator, expected: email, username or id.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  if (!userExists($identification, $identificator)) {
    $response["error"] = "Cannot find any user with this $identificator.";
    http_response_code(404);
    echo json_encode($response);
    die();
  }

  if (rateLimitIp("login", 20, "hour", 20, 20, 1, $seconds)) {
    http_response_code(429);
    header(sprintf("Retry-After: %d", floor($seconds)));
    $response["error"] = "Too Many Login Attempt, retry after " . floor($seconds) . " seconds";
    echo json_encode($response);
    die();
  }

  if (rateLimit("login", 5000, "day", 5000, 5000, 1, $seconds)) {
    http_response_code(429);
    header(sprintf("Retry-After: %d", floor($seconds)));
    $response["error"] = "Limit of 5000 login per day reached, retry after " . floor($seconds) . " seconds";
    echo json_encode($response);
    die();
  }

  $user = new User($identification, $identificator);
  if (!$user->verifyPassword($password)) {
    $response["error"] = "Invalid password.";
    http_response_code(403);
    echo json_encode($response);
    die();
  }

  $_SESSION = $user->toArray();

  $response["message"] = "Successfully logged in as " . $user->username;
  $response["success"] = true;
  $response["data"] = $user->toArray();
  http_response_code(200);
  echo json_encode($response);
} else {
  $response["error"] = "Missing post parameters, required : password, identification and identificator";
  http_response_code(422);
  echo json_encode($response);
}
