<?php
if(isset($_POST["submit-change-password"])) {
  $old_password = htmlspecialchars(addslashes($_POST["old-password"]));
  $select_password = mysqli_query($connection, "SELECT password FROM users WHERE id='{$my_id}'");
  $fetch_password = mysqli_fetch_array($select_password);
  $old_password_hash = $fetch_password['password'];
  if(password_verify($old_password, $old_password_hash)) {
    $new_password = htmlspecialchars(addslashes($_POST["new-password"]));
    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    mysqli_query($connection, "UPDATE users SET password='{$new_password_hash}' WHERE id='{$my_id}'");
    mysqli_query($connection, "INSERT INTO user_password_changes (user_id, change_from, change_to, change_date) VALUES ('{$my_id}', '{$old_password_hash}', '{$new_password_hash}', '{$datetime}')");
    head_to_self();
  } else echo "Your old password was incorrect.";
  unset($_POST["submit-change-password"]);
}
?>
<article>
  <h3>Change Password</h3>
  <form method='POST'>
    <div class='inline'>
      <label for='old-password'>Old Password</label>
      <input id='old-password' type='password' name='old-password' autocomplete='off' required>
      <input type='button' value='Show' name='show-old-password'>
    </div>
    <div class='inline'>
      <label for='new-password'>New Password</label>
      <input id='new-password' type='password' name='new-password' autocomplete='off' required>
      <input type='button' value='Show' name='show-new-password'>
    </div>
    <div>
      <input type='submit' name='submit-change-password' value='Change'>
    </div>
  </form>
</article>
