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

if (requirePost("title", "content")) {

  $title = $_POST['title'];
  $content = $_POST['content'];

  if (strlen($title) > 100) {
    $response["error"] = "Title cannot be more than 100 characters.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  if (strlen($content) > 10000) {
    $response["error"] = "Content cannot be more than 10000 characters.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  if (strlen($title) < 3) {
    $response["error"] = "Title must be at least 3 characters.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  if (strlen($content) < 3) {
    $response["error"] = "Content must be at least 3 characters.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  $sql = "INSERT INTO posts (title, content, author) VALUES (?, ?, ?)";
  $stmt = $db->prepare($sql);
  $stmt->execute([$title, $content, $_SESSION['id']]);

  $response['data'] = $db->lastInsertId();
  $response['message'] = "Post published successfully";
  $response["success"] = true;
  http_response_code(201);
  echo json_encode($response);
} else {
  $response["error"] = "Missing post paramter, required: title, content";
  http_response_code(422);
  echo json_encode($response);
}
