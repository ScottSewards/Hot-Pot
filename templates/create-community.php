<?php
if(isset($_POST["create-community"])) {
  $new_community_created = date("Y-m-d G:i:s");
  $new_community_created_by = $my_id;
  $new_community_moderated_by = $new_community_created_by;
  $new_community_name = htmlspecialchars(addslashes($_POST["community-name"]));
  $new_community_description = htmlspecialchars(addslashes($_POST["community-description"]));
  mysqli_query($connection, "INSERT INTO communities (created, created_by, moderated_by, name, description) VALUES ('{$new_community_created}', '{$new_community_created_by}', '{$new_community_moderated_by}', '{$new_community_name}', '{$new_community_description}')");
  head_to("community.php?name={$new_community_name}");
}
?>
<section>
  <h2>Create Community</h2>
  <form method='POST'>
    <div>
      <label for='community-name'>Community Name</label>
      <input id='community-name' type='text' name='community-name' required>
    </div>
    <div>
      <label for='community-description'>Content</label>
      <textarea id='community-description' name='community-description' required>
      </textarea>
    </div>
    <input type='submit' name='create-community' value='Create Community'>
  </form>
</section>
