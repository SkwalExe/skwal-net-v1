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
    $sql = "SELECT user FROM likes WHERE comment = ?";
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
      'user' => $this->user,
      'content' => $this->content,
      'createdAt' => $this->createdAt,
      'user' => $this->user
    ];
  }

  public function has_liked($id)
  {
    global $db;
    $sql = "SELECT id FROM likes WHERE user = ? AND comment = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id, $this->id]);

    return $stmt->rowCount() > 0;
  }

  public function load_user()
  {
    $this->user = new User($this->user_id);
  }
  public function HTML($likeButton = true)
  {
    $this->load_user();
?>
    <div comment-id="<?= $this->id ?>" class="box glowing comment">
      <div class="header">
        <div>
          <div class="flex">

            <a class="author" href="<?= $this->user->profileHTML ?>">
              <div class="avatarContainer">
                <img class="avatar" src="<?= $this->user->avatarUrl; ?>">
              </div>
              <?= $this->user->username; ?>
            </a> -
            <h5 class="date">
              <?= date("F j, Y", strtotime($this->created_at)); ?>
            </h5>
          </div>

        </div>
        <?php if ($likeButton) { ?>
          <div class="<?= (isLoggedIn() && $this->has_liked($_SESSION['id'])) ? "liked" : "" ?> noSelect likeButton">
            <i class="fa-solid fa-heart"></i>
            <span class="likeCount"><?= $this->likeCount; ?></span>
          </div>
        <?php } ?>
      </div>


      <div class="content">
        <?= nl2br(htmlentities($this->content)); ?>
      </div>

    </div>
<?php
  }

  public function like($id)
  {
    global $db;
    $sql = "INSERT INTO likes (user, comment) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id, $this->id]);
    $this->likeCount++;
  }

  public function unlike($id)
  {
    global $db;
    $sql = "DELETE FROM likes WHERE user = ? AND comment = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id, $this->id]);
    $this->likeCount--;
  }
}
