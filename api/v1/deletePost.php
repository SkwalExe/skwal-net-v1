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

  $id = $_POST['id'];

  if (!postExists($id)) {
    $response["error"] = "Post does not exist.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  $post = new Post($id);

  if ($post->author_id != $_SESSION['id']) {
    $response["error"] = "You cannot delete another user's post.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  $post->delete();


  $response["success"] = true;
  $response["message"] = "Post deleted successfully";
  http_response_code(201);
  echo json_encode($response);
} else {
  $response["error"] = "Missing post paramter, required: id";
  http_response_code(422);
  echo json_encode($response);
}
