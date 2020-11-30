<?php
if(!isset($_GET["id"])) {
  mysqli_close($connection);
  direct_to("404.html");
}

$id = $_GET["id"];
$title = $_GET["title"];
require_once("head.php");

$select_post = mysqli_query($connection, "SELECT * FROM posts WHERE id='{$id}'");
if(mysqli_num_rows($select_post) == "1") {
  $fetch_post = mysqli_fetch_array($select_post);
  $post_id = $fetch_post["id"];
  $posted = $fetch_post["posted"];
  $posted_by = $fetch_post["posted_by"];
  $select_posted_by = mysqli_query($connection, "SELECT name FROM users WHERE id='{$posted_by}'");
  $fetch_posted_by = mysqli_fetch_array($select_posted_by);
  $posted_by_name = $fetch_posted_by["name"];
  $posted_in = $fetch_post["posted_in"];
  $select_posted_in = mysqli_query($connection, "SELECT name FROM communities WHERE id='{$posted_in}'");
  $fetch_posted_in = mysqli_fetch_array($select_posted_in);
  $posted_in_name = $fetch_posted_in["name"];
  $content = $fetch_post["content"];
} else {
  mysqli_close($connection);
  direct_to("404.html");
}

if(isset($_POST["submit-reply"])) {
  $new_replied = date("Y-m-d G:i:s");
  $new_reply_by = $my_id;
  $new_replied_in = $post_id;
  $new_content = $_POST["reply"];
  mysqli_query($connection, "INSERT INTO replies (replied, reply_by, replied_in, content) VALUES ('{$new_replied}', '{$new_reply_by}', '{$new_replied_in}', '{$new_content}')");
  direct_to("post.php?title={$title}");
}
?>
<main>
  <?php
  echo "
  <h1>{$title}</h1>
  <section>
    <p class='centre'>Posted {$posted} by <a href='user.php?name={$posted_by_name}'>$posted_by_name</a> in <a href='community.php?name={$posted_in_name}'>{$posted_in_name}</a></p>
    <p>$content</p>
  </section>";
  ?>
  <section id='replies'>
    <h2>Replies</h2>
    <?php
    $select_replies = mysqli_query($connection, "SELECT * FROM replies WHERE replied_in='{$post_id}' ORDER BY id DESC");
    if(mysqli_num_rows($select_replies) > "0") {
      echo "<div class='replies'>";
      while($fetch_replies = mysqli_fetch_array($select_replies)) {
        $reply_replied = $fetch_replies["replied"];
        $reply_by = $fetch_replies["reply_by"];
        $select_reply_by_name = mysqli_query($connection, "SELECT name FROM users WHERE id='{$reply_by}'");
        $fetch_reply_by_name = mysqli_fetch_array($select_reply_by_name);
        $reply_by_name = $fetch_reply_by_name["name"];
        $reply_content = $fetch_replies["content"];
        echo "
        <div class='reply'>
          <p>Reply by <a href='user.php?name={$reply_by_name}'>{$reply_by_name}</a> on {$reply_replied}</p>
          <p>{$reply_content}</p>
        </div>";
      }
      echo "</div>";
    } else echo "<p>There are no replies yet.</p>";
    ?>
  </section>
  <section id='submit-a-reply'>
    <h2>Submit a Reply</h2>
    <?php
    if(isset($my_id)) {
      echo "
      <form method='POST'>
        <div class='inline'>
          <label for='reply'>Comment*</label>
          <input id='reply' type='text' name='reply' required>
        </div>
        <input type='submit' name='submit-reply' value='Reply'/>
      </form>";
    } else echo "<p>Sign-in to submit a reply.</p>";
    ?>
  </section>
</main>
<?php
require_once("foot.php");
?>
