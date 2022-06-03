<?php

include $_SERVER['DOCUMENT_ROOT'] . "/php/global.php";

$response = api_response();

api("POST", "multipart/form-data");

if (!isLoggedIn()) {
  $response["error"] = "Not logged in.";
  http_response_code(409);
  echo json_encode($response);
  die();
}

if (!requireGet('media')) {
  $response["error"] = "Missing get parameter : media";
  http_response_code(422);
  echo json_encode($response);
  die();
}
$media = $_GET['media'];
if (!in_array($media, ["avatar", "banner"])) {
  $response["error"] = "Invalid get parameter : media, accepted values are avatar and banner";
  http_response_code(409);
  echo json_encode($response);
  die();
}

if (requireFiles()) {

  $file = $_FILES[$media];
  $target_dir = __DIR__ . "/../../../user-content/{$media}/";
  $ext = "." . strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
  $filename = $_SESSION['id'] . $ext;
  $target_file = $target_dir . $filename;

  if (!in_array($ext, [".jpg", ".jpeg", ".png", ".gif"])) {
    $response["error"] = "Invalid file type: accepted file types are jpg, jpeg, png, gif.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  if ($_SESSION[$media] != "default.png")
    unlink($target_dir . $_SESSION[$media]);

  if (move_uploaded_file($file["tmp_name"], $target_file)) {
    $response["success"] = true;
    $response["message"] = "$media uploaded successfully.";

    $sql = "UPDATE users SET $media = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$filename, $_SESSION['id']]);

    $sql = "UPDATE users SET {$media}Version = {$media}Version + 1 WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_SESSION['id']]);
    updateSession();
    echo json_encode($response);
  } else {
    $response["error"] = "Error uploading $media.";
    http_response_code(409);
    echo json_encode($response);
  }
} else {
  $response["error"] = "Missing file : $media";
  http_response_code(422);
  echo json_encode($response);
}
