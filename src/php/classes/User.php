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
    $this->accountDeletionToken = $user['accountDeletionToken'];
    $this->logout_before = strtotime($user['logout_before']);


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


  public function toArray($HTML = false)
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
      'HTML' => $HTML ? $this->toHTML() : null,
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
    echo $this->rolesHTML();
  }


  public function rolesHTML()
  {
    $roles =  [
      "admin" => ["fa-solid fa-user-shield", "This user is an admin"],
      "verified" => ["fa-solid fa-check", "This user is verified"],
      "contributor" => ["fa-solid fa-code", "This user contributed to the skwal.net source code on github"],
      "bug-hunter" => ["fa-solid fa-bug", "This user found a bug or a security vulnerability"],
      "active" => ["fa-solid fa-star", "This user is active"],
    ];
    $html = "";

    foreach ($this->roles as $role) {
      if (isset($roles[$role])) {
        $html .= "<i toultip='{$roles[$role][1]}' class='roleIcon {$roles[$role][0]}'></i>";
      }
    }

    return $html;
  }

  public function delete()
  {
    // This function deletes all data about the user, including posts, comments, and followers.

    // Delete all posts
    $this->loadPosts();
    foreach ($this->posts as $post) {
      $post->delete();
    }

    // Delete all comments
    $this->loadComments();
    foreach ($this->comments as $comment) {
      $comment->delete();
    }

    // Delete all followers
    global $db;
    $sql = "DELETE FROM followers WHERE userId = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id]);

    // Delete user's avatar and banner
    if ($this->avatar != "default.png") {
      unlink($_SERVER['DOCUMENT_ROOT'] . "../user-content/avatar/" . $this->avatar);
    }

    if ($this->banner != "default.png") {
      unlink($_SERVER['DOCUMENT_ROOT'] . "../user-content/banner/" . $this->banner);
    }

    // Delete likes
    $sql = "DELETE FROM likes WHERE user = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id]);

    // Delete the user itself
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id]);
  }

  public function loadFollowings()
  {
    global $db;
    $this->followings = [];
    $sql = "SELECT * FROM followers WHERE followerId = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id]);
    $followings = $stmt->fetchAll();
    foreach ($followings as $following) {
      $this->followings[] = new User($following['userId']);
    }
  }
  public function loadLikes()
  {
    global $db;
    $this->likes = [];
    $sql = "SELECT * FROM likes WHERE user = ? AND post IS NOT NULL";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id]);
    $likes = $stmt->fetchAll();
    foreach ($likes as $like) {
      $this->likes[] = new Post($like['post']);
    }
  }

  public function requireLogin()
  {
    global $db;
    $sql = "UPDATE users SET logout_before = current_timestamp() WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id]);
  }

  public function loginAs()
  {
    $_SESSION = $this->toArray();
    $_SESSION['last_login'] = time();
  }

  public function toHTML()
  {
    $html = "<div class=\"user box glowing\">";
    $html .= "<div class=\"avatarContainer\">";
    $html .= "<img src=\"" . $this->avatarUrl . "\" alt=\"\" class=\"avatar\">";
    $html .= "</div>";
    $html .= "<h3 class=\"username break\">" . $this->username . " "  . $this->rolesHTML() . "</h3>";
    $html .= "</div>";

    return $html;
  }
}
