<?php
if(isset($_POST["submit-create-community"])) {
  $new_community_name = htmlspecialchars(addslashes($_POST["community-name"]));
  $select_community = mysqli_query($connection, "SELECT name FROM communities WHERE name='{$new_community_name}'");
  if(mysqli_num_rows($select_community) > "0") $error = "You cannot use this name for a community.";
  else {
    mysqli_query($connection, "INSERT INTO communities (created_date, created_by_id, name) VALUES ('{$datetime}', '{$my_id}', '{$new_community_name}')");
    $new_community_id = mysqli_insert_id($connection);
    mysqli_query($connection, "INSERT INTO community_moderators (user_id, community_id, assigned_date) VALUES ('{$my_id}', '{$new_community_id}', '{$datetime}')");
    mysqli_query($connection, "INSERT INTO community_follows (follow_from_id, follow_to_id, followed_date) VALUES ('{$my_id}', '{$new_community_id}', '{$datetime}')");
    head_to("community.php?name={$new_community_name}");
  }
}
?>
<section>
  <h2>Create Community</h2>
  <form class='less' method='POST'>
    <div class='inline'>
      <label for='community-name'>Name</label>
      <input id='community-name' type='text' name='community-name' required>
      <input type='submit' name='submit-create-community' value='Create'>
    </div>
  </form>
</section>
