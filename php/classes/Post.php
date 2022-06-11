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

    $sql = "SELECT user FROM likes WHERE post = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id]);
    $this->likes = $stmt->fetchAll();
    $this->likes = array_column($this->likes, 'user');
    $this->likeCount = count($this->likes);
  }


  public function toArray()
  {
    return [
      'id' => $this->id,
      'author' => $this->author,
      'author_id' => $this->author_id,
      'title' => $this->title,
      'content' => $this->content,
      'createdAt' => $this->createdAt,
      'editedAt' => $this->editedAt,
      'likeCount' => $this->likeCount
    ];
  }

  public function loadAuthor()
  {
    $this->author = new User($this->author_id);
  }

  public function HTML($contentLimit = null, $showAuthor = true, $likeButton = true)
  {
    $this->loadAuthor();
?>
    <div post-id="<?= $this->id ?>" class="box glowing post">
      <div class="header">
        <div>
          <div class="flex">
            <?php
            if ($showAuthor) {
            ?>
              <a class="author" href="<?= $this->author->profileHTML ?>">
                <div class="avatarContainer">
                  <img class="avatar" src="<?= $this->author->avatarUrl; ?>">
                </div>
                <?= $this->author->username; ?>
              </a> -
            <?php
            } ?>
            <h5 class="date">
              <?= date("F j, Y", strtotime($this->createdAt)); ?>
            </h5>
          </div>
          <h1 class="title">
            <?= htmlentities($this->title); ?>
          </h1>
        </div>
        <?php if ($likeButton) { ?>
          <div class="<?= (isLoggedIn() && $this->hasLiked($_SESSION['id'])) ? "liked" : "" ?> noSelect postLikeButton">
            <i class="fa-solid fa-heart"></i>
            <span class="likeCount"><?= $this->likeCount; ?></span>
          </div>
        <?php } ?>
      </div>

      <?php
      if (isset($contentLimit) && $contentLimit > 0) {
        $content = substr($this->content, 0, $contentLimit);
        if (strlen($this->content) > $contentLimit)
          $content .= "...";
      } else
        $content = $this->content;

      if ($contentLimit !== 0) {
      ?>
        <div class="postContent">
          <?= htmlentities(nl2br($content)); ?>
        </div>
      <?php
      }
      ?>
    </div>
<?php
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
    }
  }

  public function unlike($id)
  {
    global $db;
    $sql = "DELETE FROM likes WHERE post = ? AND user = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$this->id, $id]);
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
  }
}
