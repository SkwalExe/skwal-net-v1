<?php

include $_SERVER['DOCUMENT_ROOT'] . "/php/global.php";

$response = api_response();


api("GET", null);

if (!isLoggedIn()) {
  $response["error"] = "Not logged in.";
  http_response_code(409);
  echo json_encode($response);
  die();
}


$token = bin2hex(random_bytes(32));

$sql = "UPDATE users SET accountDeletionToken = ? WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$token, $_SESSION['id']]);

$subject = "Confirm the deletion of your account";
$content = "<p>Hello {$_SESSION['username']}, you recently asked us to delete all your account and every other informations, please click <a href='https://skwal.net/profile/edit?token=$token&action=confirmAccountDeletion&id={$_SESSION['id']}'>here</a> to confirm this action. This action is permanant and cannot be undone.</p>";
$content .= "<br /><p style='color: red'>If you didn't request this modification then someone has access to your account, plese <a href='https://skwal.net/profile/newPassword'>change your password</a></p>";
sendMail($_SESSION['email'], $subject, $content);

$response['message'] = "We sent you an email to confirm the deletion of your account";
$response["success"] = true;
http_response_code(200);
echo json_encode($response);
