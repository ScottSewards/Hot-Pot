<?php
if(isset($_POST["post-thread"])) {
  $post_thread_title = htmlspecialchars(addslashes($_POST["post-thread-title"]));
  $post_thread_content = htmlspecialchars(addslashes($_POST["post-thread-content"]));
  mysqli_query($connection, "INSERT INTO posts (posted, posted_by, posted_in, title, content) VALUES ('{$datetime}', '{$my_id}', '{$community_id}', '{$post_thread_title}', '{$post_thread_content}')");
  head_to("community.php?name={$community_name}");
}
?>
<section id='post-thread'>
  <h2>Post Thread</h2>
  <form id='post-thread-form' method='POST'>
    <div>
      <label for='post-thread-title'>Title</label>
      <input id='post-thread-title' type='text' name='post-thread-title' required>
    </div>
    <div>
      <label for='post-thread-content'>Content</label>
      <textarea id='post-thread-content' name='post-thread-content' required></textarea>
    </div>
    <input type='submit' name='post-thread' value='Post Thread'>
  </form>
</section>
