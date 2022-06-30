<?php

include $_SERVER['DOCUMENT_ROOT'] . "/php/global.php";

$response = api_response();
api();

if (requirePost("id", "token", "newPassword", "newPasswordConfirmation")) {
  $id = $_POST['id'];
  $token = $_POST['token'];
  $newPassword = $_POST['newPassword'];
  $newPasswordConfirmation = $_POST['newPasswordConfirmation'];

  if ($newPassword != $newPasswordConfirmation) {
    $response["error"] = "The new password and password confirmation do not match.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  $user = new User($id);

  if ($user->newPasswordToken != $token) {
    $response["error"] = "Invalid token.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }


  $sql = "UPDATE users SET password = ?, newPasswordToken = NULL WHERE id = ?";
  $stmt = $db->prepare($sql);
  $stmt->execute([HashThat($newPassword), $user->id]);

  $user->requireLogin();

  $response['message'] = "Password saved successfully!";
  $response["success"] = true;
  http_response_code(200);
  echo json_encode($response);
} else {
  $response["error"] = "Missing post paramter, required: id, token, newPassword, newPasswordConfirmation";
  http_response_code(422);
  echo json_encode($response);
}
