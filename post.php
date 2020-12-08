<?php
$title = "Post";
require_once("head.php");

if(!isset($_GET["id"])) head_to("404.html");
else $id = $_GET["id"];

$select_post = mysqli_query($connection, "SELECT * FROM posts WHERE id='{$id}'");
if(mysqli_num_rows($select_post) == "1") {
  $fetch_post = mysqli_fetch_assoc($select_post);
  $post_id = $fetch_post["id"];

  $post_by_id = $fetch_post["post_by_id"];
  $select_user_by_post_by_id = mysqli_query($connection, "SELECT * FROM users WHERE id='{$post_by_id}'");
  $fetch_user_by_post_by_id = mysqli_fetch_assoc($select_user_by_post_by_id);
  $post_by_name = $fetch_user_by_post_by_id["name"];

  $post_in_id = $fetch_post["post_in_id"];
  $select_community_by_post_in_id = mysqli_query($connection, "SELECT * FROM communities WHERE id='{$post_in_id}'");
  $fetch_community_by_post_in_id = mysqli_fetch_assoc($select_community_by_post_in_id);
  $post_in_name = $fetch_community_by_post_in_id["name"];

  $post_date = $fetch_post["post_date"];
  $post_title = $fetch_post["title"];
  $post_content = $fetch_post["content"];
} else head_to("404.html");
?>
<main>
  <?php
  echo "
  <h1>{$post_title}</h1>
  <section>
    <p class='centre'>Posted {$post_date} by <a href='user.php?name={$post_by_name}'>$post_by_name</a> in <a href='community.php?name={$post_in_name}'>{$post_in_name}</a></p>
    <p>{$post_content}</p>
  </section>";
  ?>
  <section id='comments'>
    <h2>Comments</h2>
    <?php
    show_content("comments", $connection, "SELECT * FROM comments WHERE comment_in_id='{$post_id}' ORDER BY id");
    ?>
  </section>
  <?php
  if($signed_in) include_once("templates/create-comment.php");
  ?>
</main>
<?php
require_once("foot.php");
?>
