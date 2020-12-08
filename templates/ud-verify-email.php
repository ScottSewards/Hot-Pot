<?php
if(isset($_POST["verify-email"])) {
  $token = trim(htmlspecialchars(addslashes($_POST["verification-token"])));
  $select_token = mysqli_query($connection, "SELECT verify_token FROM users WHERE id='{$my_id}'");
  $fetch_token = mysqli_fetch_assoc($select_token);
  if($token == $fetch_token["verify_token"]) {
    $_SESSION["user"]["verified"] = "1";
    mysqli_query($connection, "UPDATE users SET verified='1' WHERE id='{$my_id}'");
    mysqli_query($connection, "INSERT INTO user_verifications (user_id, verified_date, ip_address) VALUES ('{$my_id}', '{$datetime}', '{$ip_address}')");
    head_to_self();
  } else $error = "Your verification token was incorrect.";
  unset($_POST["verify-email"]);
}
?>
<section>
  <p>Your account is not verified. If you do not have an email verification token, you can <a href=''>request an email verification token here</a>.</p>
  <form class='less' method='POST'>
    <div class='inline'>
      <label for='verification-token'>Token</label>
      <input id='verification-token' type='number' name='verification-token' placeholder='027121'>
      <input type='submit' name='verify-email' value='Verify'>
    </div>
  </form>
</section>
