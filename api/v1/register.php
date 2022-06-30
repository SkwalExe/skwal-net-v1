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

if (requirePost("password", "username", "email")) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  if (!isValidUsername($username)) {
    $response["error"] = "Username must be at least 3 characters and at most 20 characters and must only contain letters, numbers, dashes and underscores.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  if (strlen($password) < 6) {
    $response["error"] = "Password must be at least 6 characters long.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  if (!isValidEmail($email)) {
    $response["error"] = "Invalid email address.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  if (userExists($username)) {
    http_response_code(409);
    $response["error"] = "This username is already in use.";
    echo json_encode($response);
    die();
  }

  if (userExists($email, "email")) {
    http_response_code(409);
    $response["error"] = "This email address is already in use.";
    echo json_encode($response);
    die();
  }

  if (rateLimitIp("register", 5, "day", 5, 5, 1, $seconds)) {
    http_response_code(429);
    header(sprintf("Retry-After: %d", floor($seconds)));
    $response["error"] = "Too Many Requests, retry after " . floor($seconds) . " seconds";
    echo json_encode($response);
    die();
  }

  if (rateLimit("register", 1000, "day", 1000, 1000, 1, $seconds)) {
    http_response_code(429);
    header(sprintf("Retry-After: %d", floor($seconds)));
    $response["error"] = "Limit of 500 registrations per day reached, retry after " . floor($seconds) . " seconds";
    echo json_encode($response);
    die();
  }

  $id = createUser($username, $password, $email);

  $user = new User($id);

  $user->loginAs();
  $response["message"] = "Successfully registered and logged in as " . $username;
  $response["success"] = true;
  $response["data"] = $user->toArray();

  http_response_code(201);
  echo json_encode($response);
} else {
  $response["error"] = "Missing post parameters, required : username, password, email";
  http_response_code(422);
  echo json_encode($response);
}
