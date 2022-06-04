<?php
include $_SERVER['DOCUMENT_ROOT'] . "/php/global.php";
$response = api_response();
api();


if (!isLoggedIn()) {
  $response["error"] = "Not logged in";
  http_response_code(409);
  echo json_encode($response);
  die();
}

if (requirePost("id")) {

  $id = $_POST['id'];

  if ($id == $_SESSION['id']) {
    $response["error"] = "Cannot follow your own profile";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  if (!userExists($id, "id")) {
    $response["error"] = "Cannot find user with this id";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  $user = new User($id);

  if ($user->isFollowedBy($_SESSION['id'])) {
    $response["error"] = "Already following this user";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  if (rateLimitIp("follow", 50, "hour", 50, 50, 1, $seconds)) {
    http_response_code(429);
    header(sprintf("Retry-After: %d", floor($seconds)));
    $response["error"] = "You cannot follow more than 50 profiles per hour, retry after " . floor($seconds) . " seconds";
    echo json_encode($response);
    die();
  }

  $user->follow($_SESSION['id']);

  $response["success"] = true;
  $response["message"] = "Successfully followed user";

  http_response_code(200);
  echo json_encode($response);
} else {
  $response["error"] = "Missing post parameters, required : id";
  http_response_code(422);
  echo json_encode($response);
}
