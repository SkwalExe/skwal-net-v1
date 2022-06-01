<?php

class User
{
  public $id;
  public $username;
  public $email;
  public $password;
  public $isAdmin;
  public $isBanned;
  public $isVerified;


  public function __construct($identification, $type = "id")
  {
    global $db;
    $sql = "SELECT * FROM users WHERE $type = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$identification]);
    $user = $stmt->fetch();
    $this->id = $user['id'];
    $this->username = $user['username'];
    $this->email = $user['email'];
    $this->password = $user['password'];
    $this->isAdmin = $user['isAdmin'];
    $this->isBanned = $user['isBanned'];
    $this->isVerified = $user['isVerified'];
    $this->banner = $user['banner'];
    $this->avatar = $user['avatar'];
    $this->avatarVersion = $user['avatarVersion'];
    $this->bannerVersion = $user['bannerVersion'];
    $this->createdAt = $user['createdAt'];
    $this->bio = $user['bio'];
    $this->newEmail = $user['newEmail'];
    $this->newEmailToken = $user['newEmailToken'];
    $this->newPasswordToken = $user['newPasswordToken'];
  }


  public function toArray()
  {
    return [
      'id' => $this->id,
      'username' => $this->username,
      'email' => $this->email,
      'isAdmin' => $this->isAdmin,
      'isBanned' => $this->isBanned,
      'isVerified' => $this->isVerified,
      'createdAt' => $this->createdAt,
      'bio' => $this->bio,
      'banner' => $this->banner,
      'avatar' => $this->avatar
    ];
  }


  public function verifyPassword($password)
  {
    return password_verify($password, $this->password);
  }
}
