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

  if (!commentExists($id)) {
    $response["error"] = "Comment does not exist.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  $comment = new Comment($id);

  if ($comment->user_id != $_SESSION['id'] && !isAdmin()) {
    $response["error"] = "You cannot delete another user's comment.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  $comment->delete();


  $response["success"] = true;
  $response["message"] = "Comment deleted successfully";
  http_response_code(201);
  echo json_encode($response);
} else {
  $response["error"] = "Missing post paramter, required: id";
  http_response_code(422);
  echo json_encode($response);
}
