<?php
if(isset($_POST["verify-email"])) {
  $input_token = htmlspecialchars(addslashes($_POST["verification-token"]));
  $input_token = trim($input_token);
  $select_token = mysqli_query($connection, "SELECT token FROM users WHERE id='{$my_id}'");
  $fetch_token = mysqli_fetch_assoc($select_token);
  if($input_token == $fetch_token["token"]) {
    $_SESSION["verified"] = "1";
    mysqli_query($connection, "UPDATE users SET verified='1' WHERE id='{$my_id}'");
  } else $error = "Your verification token was incorrect.";
}
?>
<section>
  <p>Your account is not verified. If you do not have an email verification token, you can <a href=''>request an email verification token here</a>.</p>
  <form class='less' method='POST'>
    <div class='inline'>
      <label for='verification-token'>Token</label>
      <input id='verification-token' type='number' name='verification-token' placeholder='027121'>
      <input type='submit' name='verify-email' value='Verify Email'>
    </div>
  </form>
</section>
