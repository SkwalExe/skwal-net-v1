<?php

include $_SERVER['DOCUMENT_ROOT'] . "/php/global.php";

$response = api_response();
api();


if (!isLoggedIn()) {
  $response["error"] = "Not logged in.";
  http_response_code(409);
  echo json_encode($response);
  die();
}

if (requirePost('id')) {

  if (rateLimitIp("likes-{$_SESSION['id']}", 100, "hour", 100, 100, 1, $seconds)) {
    http_response_code(429);
    header(sprintf("Retry-After: %d", floor($seconds)));
    $response["error"] = "You cannot like or unlike more than 100 posts per hour, retry after " . floor($seconds) . " seconds";
    echo json_encode($response);
    die();
  }

  $id = $_POST['id'];

  if (!postExists($id)) {
    $response["error"] = "Post does not exist.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  $post = new Post($id);

  if (!$post->hasLiked($_SESSION['id'])) {
    $response["error"] = "You have not liked this post.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  $post->unlike($_SESSION['id']);

  $response["success"] = true;
  $response["message"] = "Post unliked successfully";
  http_response_code(201);
  echo json_encode($response);
} else {
  $response["error"] = "Missing post paramter, required: id";
  http_response_code(422);
  echo json_encode($response);
}
