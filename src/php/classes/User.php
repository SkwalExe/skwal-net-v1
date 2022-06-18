<?php

class User
{
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
    $this->banner = $user['banner'];
    $this->avatar = $user['avatar'];
    $this->avatarVersion = $user['avatarVersion'];
    $this->bannerVersion = $user['bannerVersion'];
    $this->createdAt = $user['createdAt'];
    $this->bio = $user['bio'];
    $this->newEmail = $user['newEmail'];
    $this->newEmailToken = $user['newEmailToken'];
    $this->newPasswordToken = $user['newPasswordToken'];
    $this->profileHTML = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . "/profile?username=" . $this->username;
    $this->roles = explode(",", $user['roles']);
    $this->posts = [];
    $this->avatarUrl = "/avatar/?username=$this->username";
    $this->bannerUrl = "/banner/?username=$this->username";
    $settings = json_decode($user['settings'], true);

    global $defaultSettings;

    $this->settings = [
      "borders" => $settings["borders"] ?? $defaultSettings["borders"],
      "color" => $settings["color"] ?? $defaultSettings["color"],
    ];



    $sql = "SELECT * FROM followers WHERE userId = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id]);
    $this->followerCount = $stmt->rowCount();
  }


  public function toArray()
  {
    return [
      'id' => $this->id,
      'username' => $this->username,
      'email' => $this->email,
      'createdAt' => $this->createdAt,
      'bio' => $this->bio,
      'banner' => $this->banner,
      'avatar' => $this->avatar,
      'profileHTML' => $this->profileHTML,
      'roles' => $this->roles,
      'settings' => $this->settings,
    ];
  }


  public function verifyPassword($password)
  {
    return password_verify($password, $this->password);
  }

  public function isFollowedBy($id)
  {
    global $db;
    $sql = "SELECT * FROM followers WHERE userId = ? AND followerId = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id, $id]);
    return $stmt->rowCount() > 0;
  }

  public function follow($id)
  {
    global $db;
    $sql = "INSERT INTO followers (userId, followerId) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id, $id]);
  }

  public function unfollow($id)
  {
    global $db;
    $sql = "DELETE FROM followers WHERE userId = ? AND followerId = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id, $id]);
  }

  public function loadPosts()
  {
    global $db;
    $this->posts = [];
    $sql = "SELECT id FROM posts WHERE author = ? ORDER BY createdAt DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id]);
    $posts = $stmt->fetchAll();
    foreach ($posts as $post) {
      $this->posts[] = new Post($post['id']);
    }
  }

  public function loadComments()
  {
    global $db;
    $this->comments = [];
    $sql = "SELECT id FROM comments WHERE user = ? ORDER BY created_at DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id]);
    $comments = $stmt->fetchAll();
    foreach ($comments as $comment) {
      $this->comments[] = new Comment($comment['id']);
    }
  }

  public function printRoles()
  {
    $roles =  [
      "admin" => ["fa-solid fa-user-shield", "This user is an admin"],
      "verified" => ["fa-solid fa-check", "This user is verified"],
    ];

    foreach ($this->roles as $role) {
      if (isset($roles[$role])) {
        echo "<i toultip='{$roles[$role][1]}' class='roleIcon {$roles[$role][0]}'></i>";
      }
    }
  }
}
