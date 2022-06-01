<?php

include $_SERVER['DOCUMENT_ROOT'] . "/php/global.php";

$response = [
  "success" => false,
  "message" => "",
  "error" => "",
  "data" => null
];

if ($_SERVER['REQUEST_METHOD'] != "POST") {
  $response['error'] = "Only POST requests are accepted";
  echo json_encode($response);
  http_response_code(405);
  die();
}

if ($_SERVER['CONTENT_TYPE'] != "application/json") {
  $response["error"] = "Content-Type must be application/json";
  echo json_encode($response);
  http_response_code(409);
  die();
}

$json = file_get_contents('php://input');
$_POST = json_decode($json, true);

if (!isset($_POST)) {
  $response['error'] = "Invalid JSON";
  echo json_encode($response);
  http_response_code(400);
  die();
}

if (requirePost("email")) {
  $email = $_POST['email'];

  if (!userExists($email, "email")) {
    $response["error"] = "This email is not registered.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  $user = new User($email, "email");

  if (rateLimit("new-password-" . $user->id, 5, "day", 5, 5, 1, $seconds)) {
    http_response_code(429);
    header(sprintf("Retry-After: %d", floor($seconds)));
    $response["error"] = "Already 5 password reset request were emitted for this account today, please try again later.";
    echo json_encode($response);
    die();
  }
  $token = bin2hex(random_bytes(32));

  $sql = "UPDATE users SET newPasswordToken = ? WHERE id = ?";

  $stmt = $db->prepare($sql);
  $stmt->execute([$token, $user->id]);


  $subject = "Reset your password";
  $content = "<p>Hello {$user->username}, you recently tried to change/reset your password, please click <a href='https://skwal.net/profile/newPassword?token=$token&action=confirmNewPassword&id={$user->id}'>here</a> to confirm this modification</p>";
  $content .= "<br /><p style='color: red'>If you didn't request this modification then someone has access to your account, plese <a href='https://skwal.net/profile/newPassword'>change your password</a></p>";
  sendMail($email, $subject, $content);

  $response['message'] = "We sent you an email to reset your password";
  $response["success"] = true;
  http_response_code(200);
  echo json_encode($response);
} else {
  $response["error"] = "Missing post paramter, required: email";
  http_response_code(422);
  echo json_encode($response);
}
