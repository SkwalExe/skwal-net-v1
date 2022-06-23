<?php
include("{$_SERVER['DOCUMENT_ROOT']}/php/global.php");

$file = "Your IP : " . $_SERVER['REMOTE_ADDR'] . "\n";

if (isLoggedIn()) {
  $user = new User($_SESSION['id']);
  $user->loadFollowings();
  $user->loadPosts();
  $user->loadComments();
  $user->loadLikes();
  $file .= "username : " . $user->username . "\n";
  $file .= "email : " . $user->email . "\n";
  $file .= "id : " . $user->id . "\n";
  $file .= "avatar : https://skwal.net" . $user->avatarUrl . "\n";
  $file .= "banner : https://skwal.net" . $user->bannerUrl . "\n";
  $file .= "bio : " . $user->bio . "\n";
  $file .= "url of the profiles you follow : \n";
  foreach ($user->followings as $following) {
    $file .= "\thttps://skwal.net/profile?username=" . $following->username . "\n";
  }
  $file .= "Url of the posts you published : \n";
  foreach ($user->posts as $post) {
    $file .= "\thttps://skwal.net/post?id=" . $post->id . "\n";
  }
  $file .= "Url of the posts you liked : \n";
  foreach ($user->likes as $like) {
    $file .= "\thttps://skwal.net/post?id=" . $like->id . "\n";
  }
  $file .= "Url of the posts you commented : \n";
  foreach ($user->comments as $comment) {
    $file .= "\thttps://skwal.net/post?id=" . $comment->post_id . "\n";
  }
}

$serverData['toDownload'] = $file;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  defaultHeaders();
  css("colors",  "global", "footer", "layout", "loadingScreen", "navbar", "tiles");
  ?>
</head>

<body>
  <?php
  navbarStart();
  navbarButton("Home", "/", "fa fa-home");
  navbarEnd();
  ?>
  <div class="mainContainer">
    <div class="main">
      <div class="content">
        <div class="box glowing markup">
          <h1>Your privacy</h1>
          <p>This page allows users to learn how we (skwal.net, "we", "us", or "our") process their personal information.</p>
          <p>We think that privacy is a fundamental right, that's why we take the privacy of our users very seriously.</p>
          <p>We will never sell or share our users' personal information to anyone.</p>

        </div>
        <div class="box glowing markup">
          <h1>What informations do we collect about you</h1>
          <h4>If you don't have an account on this website, the only information that we will collect is:</h4>
          <ul>
            <li>The IP adress of your computer</li>
          </ul>
          <h4>If you have an account, we will also collect:</h4>
          <ul>
            <li>The username of your account</li>
            <li>Your email address</li>
            <li>The password of your account</li>
          </ul>
          <h4>Depending on how you use our website, we may also collect:</h4>
          <ul>
            <li>Your avatar</li>
            <li>Your banner</li>
            <li>The description of your profile</li>
            <li>The posts you published</li>
            <li>The comments you posted</li>
            <li>The posts or comments you liked</li>
            <li>The profiles you follow</li>
          </ul>
        </div>
        <div class="box glowing markup">
          <h1>Who can access your informations</h1>
          <p>First of all, we do NOT and will NEVER sell or share your informations to third parties.</p>
          <h4>Only us have access to</h4>
          <ul>
            <li>Your email</li>
            <li>Your password</li>
            <li>Your IP adress</li>
            <li>The post or comments you liked</li>
            <li>The profiles you follow</li>
          </ul>
          <h4>The following information can be seen by anyone on your <a href="/profile">profile page</a></h4>
          <ul>
            <li>Your username</li>
            <li>Your avatar</li>
            <li>Your banner</li>
            <li>The description of your profile</li>
            <li>The posts you published</li>
            <li>The comments you posted</li>
          </ul>
        </div>
        <div class="box glowing markup">
          <h1>How long do we keep your informations</h1>
          <p>We will keep your informations for as long as you have an account on this website.</p>
          <p>If you request the deletion of your account, we will delete EVERYTHING directly</p>
        </div>
        <div class="box glowing markup">
          <h1>How do we use your informations</h1>
          <h3>Your ip adress</h3>
          <p>We will use your ip adress to prevent spamming and to prevent abuse of this website.</p>
          <h3>Your username</h3>
          <p>We will use your username to identify you on this website.</p>
          <h3>Your email</h3>
          <p>We will use your email to identify you on this website and to send you emails</p>
          <p>We only send emails to confirm important actions, such as password resetting.</p>
          <h3>Your password</h3>
          <p>We will use your password to authenticate you on this website.</p>
        </div>
        <div class="box glowing markup">
          <h1>How do we protect your informations</h1>
          <p>We store your informations in a secured database.</p>
          <p>Your password is encrypted using a secure hashing algorithm, even us, the developers of this website, do not have access to your password.</p>
          <p>We use a secure connection to the database and the server</p>
          <p>We prevent hackers from accessing your account with different security measures.</p>
          <ul>
            <li>We force our users to use secured connections to our website.</li>
            <li>We first send verification emails to confirm important actions, such as password resetting and email modifications.</li>
            <li>We force our users to set secured password for their account</li>
          </ul>
        </div>
        <div class="box glowing markup">
          <h1>Your rights</h1>
          <p>You have the right to</p>
          <h3>See the informations we know about you</h3>
          <p>To download all the informations we know about you, please click <a href="javascript:download('your_informations.txt', serverData['toDownload'])">here</a></p>
          <p>We cannot show you your password for security reasons</p>
          <h3>Change your informations</h3>
          <p>You can change your informations on your <a href="/profile/edit">profile settings</a></p>
          <h3>Delete your informations</h3>
          <p>You can ask us to delete all your informations on your <a href="/profile/edit">profile settings</a></p>
          <p>The deletion of your informations is direct, permanent and cannot be undone.</p>
        </div>
      </div>
      <hr class="onlyShowWhenMobileWidth">
      <div class="sidebar">
        <h1 class="box glowing center">
          Links
        </h1>
        <div class="links box glowing">
          <a href="/profile/edit">📝 Change your informations</a>
          <a href="/profile/edit">🗑️ Delete your informations</a>
          <a href="/tos">📜 Terms of service</a>
          <a href="/cookies">🍪 Cookies policy</a>
        </div>
        <hr>
        <h1 class="box glowing center">
          Pages
        </h1>
        <?php
        pages();
        ?>
      </div>
    </div>
  </div>
  <?php
  loadingScreen();
  footer();
  js("functions", "global", "navbar", "links", "tiles", "loadingScreen");
  ?>
</body>

</html>