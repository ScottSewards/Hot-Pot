<?php
if(isset($_POST["submit-create-post"])) {
  $new_post_title = htmlspecialchars(addslashes($_POST["post-title"]));
  $new_post_content = htmlspecialchars(addslashes($_POST["post-content"]));
  mysqli_query($connection, "INSERT INTO posts (post_by_id, post_in_id, post_date, title, content) VALUES ('{$my_id}', '{$community_id}', '{$datetime}', '{$new_post_title}', '{$new_post_content}')");
  head_to_self();
}
?>
<section id='create-post'>
  <h2>Create Post</h2>
  <form id='create-post-form' method='POST'>
    <div class='inline'>
      <label for='post-title'>Title</label>
      <input id='post-title' type='text' name='post-title' required>
    </div>
    <div>
      <label for='post-content'>Content</label>
      <textarea id='post-content' name='post-content' required></textarea>
    </div>
    <input type='submit' name='submit-create-post' value='Post'>
  </form>
</section>
