<?php

include $_SERVER['DOCUMENT_ROOT'] . "/php/global.php";

$response = api_response();
api();


if (requirePost("text")) {
  $text = $_POST['text'];

  $rendered = parseMarkdown($text);

  $response['data'] = $rendered;
  $response['message'] = "Rendered successfuly";
  $response["success"] = true;
  http_response_code(200);
  echo json_encode($response);
} else {
  $response["error"] = "Missing post paramter, required: text";
  http_response_code(422);
  echo json_encode($response);
}
