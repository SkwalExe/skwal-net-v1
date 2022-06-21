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

if (requirePost("title", "content", "id")) {

  $title = $_POST['title'];
  $content = $_POST['content'];
  $id = $_POST['id'];

  if (!postExists($id)) {
    $response["error"] = "Post does not exist.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  $post = new Post($id);

  if ($post->author_id != $_SESSION['id']) {
    $response["error"] = "You are not the author of the post you are trying to edit";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

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

  $sql = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
  $stmt = $db->prepare($sql);
  $stmt->execute([$title, $content, $post->id]);

  $response['data'] = $post->id;
  $response['message'] = "Post edited successfully";
  $response["success"] = true;
  http_response_code(200);
  echo json_encode($response);
} else {
  $response["error"] = "Missing post paramter, required: title, content, id";
  http_response_code(422);
  echo json_encode($response);
}
