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

if (requirePost("id", "content")) {
  $id = $_POST['id'];
  $content = $_POST['content'];

  if (rateLimitIp("comment", 40, "hour", 40, 40, 1, $seconds)) {
    http_response_code(429);
    header(sprintf("Retry-After: %d", floor($seconds)));
    $response["error"] = "You cannot post more than 40 comments per hour, retry after " . floor($seconds) . " seconds";
    echo json_encode($response);
    die();
  }

  if (!postExists($id)) {
    $response["error"] = "Post does not exist.";
    http_response_code(404);
    echo json_encode($response);
    die();
  }

  $post = new Post($id);

  if (strlen($content) > 1000) {
    $response["error"] = "Comment is too long. (1000 chars max)";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  if (strlen($content) < 1) {
    $response["error"] = "Comment cannot be empty";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  $sql = "INSERT INTO comments (post, user, content) VALUES (?, ?, ?)";
  $stmt = $db->prepare($sql);
  $stmt->execute([$id, $_SESSION['id'], $content]);

  $response['message'] = "Comment published successfully";
  $response["success"] = true;
  http_response_code(201);
  echo json_encode($response);
} else {
  $response["error"] = "Missing post paramter, required: content, id (of the post)";
  http_response_code(422);
  echo json_encode($response);
}
