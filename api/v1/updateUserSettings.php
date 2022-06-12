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

if (requirePost("borders")) {
  $user = new User($_SESSION['id']);
  $borders = $_POST["borders"];
  global $defaultSettings;

  if (!in_array($borders, ["show", "hide"])) {
    $response["error"] = "Invalid borders value, expected : show or hide";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  $borders = $borders == "show";

  if ($user->settings['borders'] != $borders) {
    $newSettings = $user->settings;
    $newSettings["borders"] = $borders;
    $newSettings = json_encode($newSettings);

    $sql = "UPDATE users SET settings = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$newSettings, $user->id]);
  }

  $response['message'] = "Settings updated.";
  $response["success"] = true;
  echo json_encode($response);
  http_response_code(200);
} else {
  $response["error"] = "Missing post paramter, required: borders";
  http_response_code(422);
  echo json_encode($response);
}
