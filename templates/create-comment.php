<?php
if(isset($_POST["submit-comment"])) {
  $new_comment_content = $_POST["comment-content"];
  mysqli_query($connection, "INSERT INTO comments (comment_by_id, comment_in_id, comment_date, content) VALUES ('{$my_id}', '{$post_id}', '{$datetime}', '{$new_comment_content}')");
  head_to_self();
}
?>
<section id='create-comment'>
  <h2>Create Comment</h2>
  <?php
  echo "
  <form method='POST'>
    <div class='inline'>
      <label for='comment-content'>Comment</label>
      <input id='comment-content' type='text' name='comment-content' required>
    </div>
    <input type='submit' name='submit-comment' value='Comment'/>
  </form>";
  ?>
</section>
