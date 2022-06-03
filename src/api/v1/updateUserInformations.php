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

if (requirePost("username", "bio", "email")) {
  $username = $_POST['username'];
  $bio = $_POST['bio'];
  $email = $_POST['email'];



  if ($username != $_SESSION['username'] && userExists($username)) {
    http_response_code(409);
    $response["error"] = "This username is already in use.";
    echo json_encode($response);
    die();
  }

  if (!isValidUsername($username)) {
    $response["error"] = "Username must be at least 3 characters and at most 20 characters and must only contain letters, numbers, dashes and underscores.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  if (strlen($bio) > 5000) {
    $response["error"] = "Bio must be at most 5000 characters.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }


  if (!isValidEmail($email)) {
    $response["error"] = "Invalid email address.";
    http_response_code(409);
    echo json_encode($response);
    die();
  }

  if ($email != $_SESSION['email'] && userExists($email, "email")) {
    http_response_code(409);
    $response["error"] = "This email address is already in use.";
    echo json_encode($response);
    die();
  }

  global $db;
  $sql = "UPDATE users SET username = ?, bio = ? WHERE id = ?";
  $stmt = $db->prepare($sql);
  $stmt->execute([$username, $bio, $_SESSION['id']]);
  if ($_SESSION['email'] == $email) {
    $response["message"] = "Profile informations saved!";
  } else {

    $response["message"] = "Profile informations saved! We sent you an email to confirm your new email address.";
    $token = bin2hex(random_bytes(32));

    $sql = "UPDATE users SET newEmail = ?, newEmailToken = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$email, $token, $_SESSION['id']]);

    $to = $_SESSION['email'];
    $subject = "Confirm your new email address";
    $content = "<p>Hello {$_SESSION['username']}, you recently tried to change your email adress to : $email, please click <a href='https://skwal.net/profile/edit/?id={$_SESSION['id']}&token=$token&action=confirmNewEmail'>here</a> to confirm this modification</p>";
    $content .= "<br /><p style='color: red'>If you didn't request this modification then someone has access to your account, plese <a href='https://skwal.net/profile/newPassword'>change your password</a></p>";
    sendMail($to, $subject, $content);
  }

  $response["success"] = true;
  http_response_code(201);
  echo json_encode($response);
} else {
  $response["error"] = "Missing post paramter, required: username, bio, email";
  http_response_code(422);
  echo json_encode($response);
}
