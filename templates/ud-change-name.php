<?php
if(isset($_POST["submit-name-change"])) {
  $new_name = htmlspecialchars(addslashes($_POST["new-name"]));
  $select_name = mysqli_query($connection, "SELECT name FROM users WHERE name='{$new_name}'");
  if(mysqli_num_rows($select_name) == 1) echo "You cannot use this name.";
  else {
    mysqli_query($connection, "UPDATE users SET name='{$new_name}' WHERE id='{$my_id}'");
    mysqli_query($connection, "INSERT INTO user_name_changes (user_id, change_from, change_to, change_date) VALUES ('{$my_id}', '{$my_name}', '{$new_name}', '{$datetime}')");
    $_SESSION["user"]["name"] = $new_name;
    head_to_self();
  }
  unset($_POST["submit-name-change"]);
}
?>
<article>
  <h3>Change Name</h3>
  <form class='less' method='POST'>
    <div class='inline'>
      <label for='new-name'>Name</label>
      <input id='new-name' type='text' name='new-name' placeholder='<?php echo $my_name; ?>' required>
      <input type='submit' name='submit-name-change' value='Change'>
    </div>
  </form>
</article>
