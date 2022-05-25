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
  }

  public function toArray()
  {
    return [
      'id' => $this->id,
      'username' => $this->username,
      'email' => $this->email,
      'isAdmin' => $this->isAdmin,
      'isBanned' => $this->isBanned,
      'isVerified' => $this->isVerified
    ];
  }


  public function verifyPassword($password)
  {
    return password_verify($password, $this->password);
  }
}
