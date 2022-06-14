<?php

class Comment
{
  public function __construct($id)
  {
    global $db;
    $sql = "SELECT * FROM comments WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    $comment = $stmt->fetch();

    $this->id = $comment['id'];
    $this->user_id = $comment['user'];
    $this->content = $comment['content'];
    $this->created_at = $comment['created_at'];
    $this->user = null;
  }


  public function toArray()
  {
    return [
      'id' => $this->id,
      'user' => $this->user,
      'content' => $this->content,
      'createdAt' => $this->createdAt,
      'user' => $this->user
    ];
  }

  public function load_user()
  {
    $this->user = new User($this->user_id);
  }
}
