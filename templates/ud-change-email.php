<?php
if(isset($_POST["submit-email-change"])) {
  $new_email = htmlspecialchars(addslashes($_POST["new-email"]));
  $select_email = mysqli_query($connection, "SELECT email FROM users WHERE email='{$new_email}'");
  if(mysqli_num_rows($select_email) == "1") echo "You cannot use this email.";
  else {
    $update = mysqli_query($connection, "UPDATE users SET email='{$new_email}' WHERE id='{$my_id}'");
    mysqli_query($connection, "INSERT INTO user_email_changes (user_id, change_from, change_to, change_date) VALUES ('{$my_id}', '{$my_email}', '{$new_email}', '{$datetime}')");
    $_SESSION["user"]["email"] = $new_email;
    head_to_self();
  }
  unset($_POST["submit-email-change"]);
}
?>
<article>
  <h3>Change Email</h3>
  <form class='less' method='POST'>
    <div class='inline'>
      <label for='new-email'>Email</label>
      <input id='new-email' type='email' name='new-email' placeholder='<?php echo $my_email ?>' required>
      <input type='submit' name='submit-email-change' value='Change'>
    </div>
  </form>
</article>
