<?php

class Post
{
  public function __construct($id)
  {
    global $db;
    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    $post = $stmt->fetch();

    $this->id = $post['id'];
    $this->author_id = $post['author'];
    $this->title = $post['title'];
    $this->content = $post['content'];
    $this->createdAt = $post['createdAt'];
    $this->editedAt = $post['editedAt'];
    $this->author = null;
    $this->comments = [];
    $this->views = $post['views'];

    $sql = "SELECT user FROM likes WHERE post = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id]);
    $this->likes = $stmt->fetchAll();
    $this->likes = array_column($this->likes, 'user');
    $this->likeCount = count($this->likes);
  }


  public function toArray($HTML)
  {
    return [
      'id' => $this->id,
      'author' => $this->author,
      'author_id' => $this->author_id,
      'title' => $this->title,
      'content' => $this->content,
      'createdAt' => $this->createdAt,
      'editedAt' => $this->editedAt,
      'likeCount' => $this->likeCount,
      'views' => $this->views,
      'HTML' => $HTML ? $this->HTML() : null,
    ];
  }

  public function loadAuthor()
  {
    $this->author = new User($this->author_id);
  }

  public function HTML($contentLimit = null, $showAuthor = true, $likeButton = true)
  {
    $this->loadAuthor();
    $html = "";
    $html .= "<div post-id=\"$this->id\" class=\"box glowing post\">";
    $html .= "<div class=\"header\">";
    $html .= "<div>";
    $html .= "<div class=\"flex\">";
    if ($showAuthor) {
      $html .= "<a class=\"author\" href=\"" . $this->author->profileHTML . "\">";
      $html .= "<div class=\"avatarContainer\">";
      $html .= "<img class=\"avatar\" src=\"" . $this->author->avatarUrl . "\">";
      $html .= "</div>";
      $html .= $this->author->username;
      $html .= "</a>";
      $html .= $this->author->rolesHTML();
    }
    $html .= "<h5 class=\"date\">";
    $html .= date("F j, Y", strtotime($this->createdAt));
    $html .= "</h5>";
    $html .= "</div>";
    $html .= "<h1 class=\"title\">";
    $html .= htmlentities($this->title);
    $html .= "</h1>";
    $html .= "</div>";
    $html .= "<div class=\"flex\" style=\"height: min-content; justify-content: flex-end\">";
    if ($likeButton) {
      $html .= "<div post-id=\"" . $this->id . "\" class=\"" . ((isLoggedIn() && $this->hasLiked($_SESSION['id'])) ? "liked" : "") . " noSelect likeButton\">";
      $html .= "<i class=\"fa-solid fa-heart\"></i>";
      $html .= "<span class=\"likeCount\">$this->likeCount</span>";
      $html .= "</div>";
    }
    $html .= "<div style='padding: 5px'>";
    $html .= "<i class=\"fa-solid fa-eye\"></i><span> $this->views </span>";
    $html .= "</div>";
    $html .= "</div>";
    $html .= "</div>";
    if (isset($contentLimit) && $contentLimit > 0) {
      $content = substr($this->content, 0, $contentLimit);
      if (strlen($this->content) > $contentLimit)
        $content .= "...";
    } else
      $content = $this->content;

    if ($contentLimit !== 0) {
      $html .= "<div class=\"content break markup\">";
      $html .= parseMarkdown($content);
      $html .= "</div>";
    }
    $html .= "</div>";

    return $html;
  }

  public function hasLiked($id)
  {
    global $db;
    $sql = "SELECT user FROM likes WHERE post = ? AND user = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id, $id]);
    return $stmt->rowCount() > 0;
  }

  public function like($id)
  {
    if (!$this->hasLiked($id)) {
      global $db;
      $sql = "INSERT INTO likes (post, user) VALUES (?, ?)";
      $stmt = $db->prepare($sql);
      $stmt->execute([$this->id, $id]);
      $this->likeCount++;
    }
  }

  public function unlike($id)
  {
    global $db;
    $sql = "DELETE FROM likes WHERE post = ? AND user = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id, $id]);
    $this->likeCount--;
  }

  public function delete()
  {
    global $db;
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id]);

    $sql = "DELETE FROM likes WHERE post = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id]);

    $sql = "DELETE FROM comments WHERE post = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id]);
  }

  public function load_comments()
  {
    global $db;
    $sql = "SELECT * FROM comments WHERE post = ? ORDER BY created_at DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id]);
    $comments = $stmt->fetchAll();
    foreach ($comments as $comment) {
      $this->comments[] = new Comment($comment['id']);
    }
  }

  public function incrementViews($incrementBy = 1)
  {
    global $db;
    $sql = "UPDATE posts SET views = views + ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$incrementBy, $this->id]);
  }
}
