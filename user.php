<?php
$title = "User";
require_once("head.php");

if(!isset($_GET["name"])) {
  mysqli_close($connection);
  redirect("404.html");
}

$name = $_GET["name"];
$select = mysqli_query($connection, "SELECT * FROM users WHERE name='{$name}'");
if(mysqli_num_rows($select) == "1") {
  $fetch = mysqli_fetch_array($select);
  $id = $fetch["id"];
  $created = $fetch["created"];
  $email = $fetch["email"];
  $can_email = $fetch["can_email"];
  $picture = $fetch["picture"];
  $banner = $fetch["banner"];
} else {
  mysqli_close($connection);
  redirect("404.html");
}

if(isset($_POST["send-email"])) {
  if($is_localhost == false) send_email($email, $_POST["subject"], $_POST["message"], $my_name, $_POST["email-address"], true);
  else echo "You cannot send an email on localhost.";
}
?>
<main>
  <section>
    <img class='banner' <?php echo "src='{$banner}' alt='Banner for {$name}'"; ?> height='100%' width='100%'/>
    <img class='picture' <?php echo "src='{$picture}' alt='Picture for {$name}'"; ?> height='100%' width='100%'/>
    <h1><?php echo $name; ?></h1>
    <p><?php echo "User since {$created}."; ?></p>
    <hr>
    <?php
    if(isset($my_id) and $can_email == true) {
      echo "
      <h2>Contact</h2>
      <form action='contact.php' method='POST'>
        <div class='inline'>
          <label for='sender'>Name</label>
          <input id='sender' type='text' name='sender' value='{$my_name}' disabled/>
        </div>
        <div class='inline'>
          <label for='email-address'>Return Email*</label>
          <input id='email-address' type='email' name='email-address' value='{$my_email}' required disabled/>
        </div>
        <div class='inline'>
          <label for=email-subject>Subject*</label>
          <input id='email-subject' type='text' name='subject' placeholder='' required/>
        </div>
        <div class='inline'>
          <label for='email-message'>Message*</label>
          <textarea id='email-message' name='message' min='10' required></textarea>
        </div>
        <input type='submit' name='send-email' value='Send Email'/>
      </form>";
    } else if(isset($my_id)) echo "<p>This user has disabled contact.</p>";
    else echo "<p>Sign-in to contact this user.</p>";
    ?>
  </section>

  <section id='communities'>
    <h2>Communities</h2>
    <article id='communities-created'>
      <h3>Created</h3>
      <?php
      $select_created_communities = mysqli_query($connection, "SELECT * FROM communities WHERE created_by='{$id}' ORDER BY id DESC");
      if(mysqli_num_rows($select_created_communities) > "0") {
        echo "<div class='communities'>";
        while($fetch_created_communities = mysqli_fetch_array($select_created_communities)) {
          $created_community_created = $fetch_created_communities["created"];
          $created_community_name = $fetch_created_communities["name"];
          $created_community_picture = $fetch_created_communities["picture"];
          echo "
          <div class='community'>
            <img src='{$created_community_picture}' alt='Picture for {$created_community_name}' height='100%' width='100%'/>
            <div class='meta'>
              <span><a href='community.php?name={$created_community_name}'>{$created_community_name}</a></span>
              <span>created {$created_community_created}</span>
            </div>
          </div>";
        }
        echo "</div>";
      } else echo "<p>{$name} has not created any communities yet.</p>";
      ?>
    </article>
    <h3>Administrating</h3>
    <?php
    $select_administrating_communities = mysqli_query($connection, "SELECT * FROM communities WHERE admin='{$id}' ORDER BY id DESC");
    if(mysqli_num_rows($select_administrating_communities) > "0") {
      echo "<div class='communities'>";
      while($fetch_administrating_communities = mysqli_fetch_array($select_administrating_communities)) {
        $administrating_community_created = $fetch_administrating_communities["created"];
        $administrating_community_name = $fetch_administrating_communities["name"];
        $administrating_community_picture = $fetch_administrating_communities["picture"];
        echo "
        <div class='community'>
          <img src='{$administrating_community_picture}' alt='Picture for {$administrating_community_picture}' height='100%' width='100%'/>
          <div class='meta'>
            <span><a href='community.php?name={$administrating_community_name}'>{$administrating_community_name}</a></span>
            <span>created {$administrating_community_created}</span>
          </div>
        </div>";
      }
      echo "</div>";
    } else echo "<p>{$name} is not admin for any communities yet.</p>";
    ?>
  </section>

  <section id='posts'>
    <h2>Posts</h2>
    <?php
    $select_posts = mysqli_query($connection, "SELECT * FROM posts WHERE posted_by='{$id}' ORDER BY id DESC");
    if(mysqli_num_rows($select_posts) > "0") {
      echo "<div class='posts'>";
      while($fetch_post = mysqli_fetch_array($select_posts)) {
        $posted = $fetch_post["posted"];
        $posted_in = $fetch_post["posted_in"];
        $select_posted_in = mysqli_query($connection, "SELECT name FROM communities WHERE id='{$posted_in}'");
        $fetch_posted_by = mysqli_fetch_array($select_posted_in);
        $posted_in = $fetch_posted_by["name"];
        $title = $fetch_post["title"];
        $content = $fetch_post["content"];
        $likes = $fetch_post["likes"];
        $dislikes = $fetch_post["dislikes"];
        echo "
        <div class='post'>
          <p><a href='post.php?title={$title}'>{$title}</a> posted in <a href='community.php?name={$posted_in}'>{$posted_in}</a> on {$posted}.</p>
          <p>{$likes} likes and {$dislikes} dislikes.</p>
        </div>";
      }
      echo "</div>";
    } else echo "<p>{$name} has not posted to any communities yet.</p>";
    ?>
  </section>

  <section id='replies'>
    <h2>Replies</h2>
    <?php
    $select_replies = mysqli_query($connection, "SELECT * FROM replies WHERE reply_by='{$id}' ORDER BY id DESC");
    if(mysqli_num_rows($select_replies) > "0") {
      echo "<div class='replies'>";
      while($fetch_replies = mysqli_fetch_array($select_replies)) {
        $replied = $fetch_replies["replied"];
        $replied_in = $fetch_replies["replied_in"];
        $select_replied_in = mysqli_query($connection, "SELECT * FROM posts WHERE id='{$replied_in}'");
        $fetch_replied_in = mysqli_fetch_array($select_replied_in);
        $replied_in_name = $fetch_replied_in["title"];
        $posted_in = $fetch_replied_in["posted_in"];
        $select_posted_in = mysqli_query($connection, "SELECT name FROM communities WHERE id='{$posted_in}'");
        $fetch_posted_in = mysqli_fetch_array($select_posted_in);
        $posted_in_name = $fetch_posted_in["name"];
        $content = $fetch_replies["content"];
        echo "
        <div class='reply'>
          <p>Replied in <a href='post.php?title={$replied_in_name}'>{$replied_in_name}</a> on <a href='community.php?name={$posted_in_name}'>{$posted_in_name}</a> on {$replied}.</p>
          <p>{$content}</p>
        </div>";
      }
      echo "</div>";
    } else echo "<p>{$name} has not replied to any posts yet.</p>";
    ?>
  </section>
</main>
<?php
require_once("foot.php");
?>
