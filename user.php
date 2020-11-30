<?php
if(!isset($_GET["name"])) {
  mysqli_close($connection);
  direct_to("404.html");
} else $user_name = $_GET["name"];

$title = "{$user_name} User";
require_once("head.php");

$select_user = mysqli_query($connection, "SELECT * FROM users WHERE name='{$user_name}'");
if(mysqli_num_rows($select_user) == "1") {
  $fetch_user = mysqli_fetch_array($select_user);
  $user_id = $fetch_user["id"];
  $user_created = $fetch_user["created"];
  $user_description = $fetch_user["description"];
  $user_email = $fetch_user["email"];
  $user_verified = $fetch_user["verified"];
  $user_shows_contact_form = $fetch_user["show_contact_form"];
  $user_picture = $fetch_user["picture"];
  $user_banner = $fetch_user["banner"];
} else {
  mysqli_close($connection);
  head_to("404.html");
}

if(isset($_POST["send-email"])) {
  email($user_email, $_POST["subject"], $_POST["message"], $my_name, $my_email, true);
}
?>
<main>
  <section>
    <?php
    echo "<img class='banner' src='{$user_banner}' alt='Banner for {$user_name}' height='100%' width='100%'>";
    echo "<img class='picture' src='{$user_picture}' alt='Picture for {$user_name}' height='100%' width='100%'>";
    echo "<h1>{$user_name}</h1>";

    if($user_description != null) echo "<p class='centre'>{$user_description}</p>";
    else echo "<p class='centre'>{$user_name} has not written a description.</p>";

    $user_created_to_new_date = date("jS F Y", strtotime($user_created));
    echo "<p class='centre'>User since {$user_created_to_new_date}</p>";

    if(isset($my_id) and $user_shows_contact_form == true) {
      echo "
      <hr>
      <h2>Contact</h2>
      <form method='POST'>
        <div class='inline'>
          <label for=email-subject>Subject*</label>
          <input id='email-subject' type='text' name='subject' placeholder='' required>
        </div>
        <div class='inline'>
          <label for='email-message'>Message*</label>
          <textarea id='email-message' name='message' min='10' required></textarea>
        </div>
        <input type='submit' name='send-email' value='Send Email'>
      </form>";
    } else if(isset($my_id)) echo "<p>{$user_name} has chose to not show a contact form.</p>";
    ?>
  </section>

  <section>
    <h2>Friends</h2>
    <?php
    echo "<p>{$user_name} has not made any friends yet.</p>";
    echo "<div class='users hide'>";
    echo "</div>";
    ?>
  </section>

  <section id='user-communities'>
    <h2>Communities</h2>
    <article id='user-communities-created'>
      <h3>Communities Created</h3>
      <?php
      $select_created_communities = mysqli_query($connection, "SELECT * FROM communities WHERE created_by='{$user_id}'");
      if(mysqli_num_rows($select_created_communities) > "0") {
        echo "<div class='communities'>";
        while($fetch_created_communities = mysqli_fetch_array($select_created_communities)) {
          $created_community_created = $fetch_created_communities["created"];
          $created_community_created_to_new_date = date("M Y", strtotime($created_community_created));
          $created_community_name = $fetch_created_communities["name"];
          $created_community_picture = $fetch_created_communities["picture"];
          echo "
          <div class='community'>
            <img src='{$created_community_picture}' alt='Picture for {$created_community_name}' height='0' width='100%'>
            <div class='meta'>
              <span><a href='community.php?name={$created_community_name}'>{$created_community_name}</a></span>
              <span>created {$created_community_created_to_new_date}</span>
            </div>
          </div>";
        }
        echo "</div>";
      } else echo "<p>{$user_name} has not created any communities.</p>";
      ?>
    </article>
    <article id='user-communities-administrated'>
      <h3>Communities Moderated</h3>
      <?php
      $select_moderated_communities = mysqli_query($connection, "SELECT * FROM communities WHERE moderated_by='{$user_id}'");
      if(mysqli_num_rows($select_moderated_communities) > "0") {
        echo "<div class='communities'>";
        while($fetch_moderated_communities = mysqli_fetch_array($select_moderated_communities)) {
          $moderated_community_created = $fetch_moderated_communities["created"];
          $moderated_community_created_to_new_date = date("M Y", strtotime($moderated_community_created));
          $moderated_community_name = $fetch_moderated_communities["name"];
          $moderated_community_picture = $fetch_moderated_communities["picture"];
          echo "
          <div class='community'>
            <img src='{$moderated_community_picture}' alt='Picture for {$moderated_community_picture}' height='' width='100%'>
            <div class='meta'>
              <span><a href='community.php?name={$moderated_community_name}'>{$moderated_community_name}</a></span>
              <span>created {$moderated_community_created_to_new_date}</span>
            </div>
          </div>";
        }
        echo "</div>";
      } else echo "<p>{$user_name} does not moderate any communities.</p>";
      ?>
    </article>
  </section>
  <section id='user-posts'>
    <h2>Posts</h2>
    <?php
    $select_posts = mysqli_query($connection, "SELECT * FROM posts WHERE posted_by='{$user_id}' ORDER BY id DESC");
    if(mysqli_num_rows($select_posts) > "0") {
      echo "<div class='posts'>";
      while($fetch_post = mysqli_fetch_array($select_posts)) {
        $post_id = $fetch_post["id"];
        $posted = $fetch_post["posted"];
        $posted_in = $fetch_post["posted_in"];
        $select_posted_in = mysqli_query($connection, "SELECT name FROM communities WHERE id='{$posted_in}'");
        $fetch_posted_by = mysqli_fetch_array($select_posted_in);
        $posted_in = $fetch_posted_by["name"];
        $title = $fetch_post["title"];
        $content = $fetch_post["content"];
        echo "
        <div class='post'>
          <span><a href='post.php?id={$post_id}&title={$title}'>{$title}</a> posted in <a href='community.php?name={$posted_in}'>{$posted_in}</a> on {$posted}.</span>
        </div>";
      }
      echo "</div>";
    } else echo "<p>{$user_name} has not posted to any communities.</p>";
    ?>
  </section>
  <section id='user-replies'>
    <h2>Replies</h2>
    <?php
    $select_replies = mysqli_query($connection, "SELECT * FROM replies WHERE reply_by='{$user_id}' ORDER BY id DESC");
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
          <span>Replied in <a href='post.php?title={$replied_in_name}'>{$replied_in_name}</a> on <a href='community.php?name={$posted_in_name}'>{$posted_in_name}</a> on {$replied}.</span>
          <span>{$content}</span>
        </div>";
      }
      echo "</div>";
    } else echo "<p>{$user_name} has not replied to any posts.</p>";
    ?>
  </section>
</main>
<?php
require_once("foot.php");
?>
