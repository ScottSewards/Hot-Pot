<?php
$title = "Post";
require_once("head.php");

if(!isset($_GET["title"])) {
  mysqli_close($connection);
  redirect("404.html");
}

$title = $_GET["title"];
$title_with_space;

$select = mysqli_query($connection, "SELECT * FROM posts WHERE title='{$title}'");
if(mysqli_num_rows($select) == "1") {
  $fetch = mysqli_fetch_array($select);
  $id = $fetch["id"];
  $posted = $fetch["posted"];

  $posted_by = $fetch["posted_by"];
  $select_posted_by = mysqli_query($connection, "SELECT name FROM users WHERE id='{$posted_by}'");
  $fetch_posted_by = mysqli_fetch_array($select_posted_by);
  $posted_by_name = $fetch_posted_by["name"];

  $posted_in = $fetch["posted_in"];
  $select_posted_in = mysqli_query($connection, "SELECT name FROM communities WHERE id='{$posted_in}'");
  $fetch_posted_in = mysqli_fetch_array($select_posted_in);
  $posted_in_name = $fetch_posted_in["name"];

  $content = $fetch["content"];
  $likes = $fetch["likes"];
  $dislikes = $fetch["dislikes"];
} else {
  mysqli_close($connection);
  redirect("404.html");
}

if(isset($_POST["submit-reply"])) {
  $replied = date("Y-m-d");
  $reply_by = $my_id;
  $replied_in = $id;
  $content = $_POST["reply"];
  mysqli_query($connection, "INSERT INTO replies (replied, reply_by, replied_in, content) VALUES ('{$replied}', '{$reply_by}', '{$replied_in}', '{$content}')");
  redirect("post.php?title={$title}");
}
?>
<main>
  <h1><?php echo $title; ?></h1>
  <article>
    <section>
      <p><?php echo "Posted $posted in <a href='community.php?name={$posted_in_name}'>{$posted_in_name}</a> by <a href='user.php?name={$posted_by_name}'>$posted_by_name</a>"; ?></p>
      <p><?php echo "$likes likes"; ?> Click to like</p>
      <p><?php echo "$dislikes dislikes"; ?> Click to dislike</p>
      <p><?php echo $content; ?></p>
    </section>
  </article>
  <section id='replies'>
    <h2>Replies</h2>
    <?php
    $select_replies = mysqli_query($connection, "SELECT * FROM replies WHERE replied_in='{$id}' ORDER BY id DESC");
    if(mysqli_num_rows($select_replies) > "0") {
      echo "<div class='replies'>";
      while($fetch_replies = mysqli_fetch_array($select_replies)) {
        $replied = $fetch_replies["replied"];
        $reply_by = $fetch_replies["reply_by"];
        $select_reply_by_name = mysqli_query($connection, "SELECT name FROM users WHERE id='{$reply_by}'");
        $fetch_reply_by_name = mysqli_fetch_array($select_reply_by_name);
        $reply_by_name = $fetch_reply_by_name["name"];
        $content = $fetch_replies["content"];
        echo "
        <div class='reply'>
          <p>by <a href='user.php?name={$reply_by_name}'>{$reply_by_name}</a> on {$replied}</p>
          <p>{$content}</p>
        </div>";
      }
      echo "</div>";
    }
    ?>
  </section>
  <section>
    <h2>Reply</h2>
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
    } else echo "<p>Sign-in to reply.</p>";
    ?>
  </section>
</main>
<?php
require_once("foot.php");
?>
