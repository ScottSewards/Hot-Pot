<?php
if(!empty($_SESSION["signed_in"]) and $_SESSION["signed_in"] == true) head_to("user-dashboard.php");

$title = "Sign-in";
require_once("head.php");

if(isset($_POST["sign-in"])) {
  $sign_in_email = htmlspecialchars(addslashes($_POST["sign-in-email"]));
  $sign_in_password = htmlspecialchars(addslashes($_POST["sign-in-password"]));
  $select_sign_in_by_email = mysqli_query($connection, "SELECT * FROM users WHERE email='{$sign_in_email}'");
  if(mysqli_num_rows($select_sign_in_by_email) == "1") {
    $fetch_sign_in_by_email = mysqli_fetch_array($select_sign_in_by_email);
    if(password_verify($sign_in_password, $fetch_sign_in_by_email["password"])) {
      sign_in($fetch_sign_in_by_email);
    } else $error = "Your email or passward was incorrect.";
  } else $error = "Your email or passward was incorrect.";
}

if(isset($_POST["sign-out"])) {
  sign_out();
}
?>
<main>
  <section>
    <h1>Sign-in</h1>
    <form method='POST'>
      <div class='inline'>
        <label for='sign-in-email'>Email*</label>
        <input id='sign-in-email' type='email' name='sign-in-email' placeholder='george.orson@welles.com' autocomplete='on' autofocus required>
      </div>
      <div class='inline'>
        <label for='sign-in-password'>Password*</label>
        <input id='sign-in-password' type='password' name='sign-in-password' placeholder='CitizenKane1941' autocomplete='on' required>
        <input type='button' value='Show' name='show-sign-in-password'>
      </div>
      <div class='inline hide'>
        <label for='stay-signed-in'>Stay signed in?</label>
        <input id='stay-signed-in' type='checkbox' name='stay-signed-in' disabled>
      </div>
      <div class='inline'>
        <input id='sign-in' type='submit' name='sign-in' value='Sign-in'>
        <input id='reset-password' type='button' name='reset-passwrd' value='Reset Password' disabled>
      </div>
      <?php if(isset($error)) echo "<output name='sign-in-output'>{$error}</output>"?>
    </form>
    <p>If you don't have an account, you can <a href='sign-up.php'>sign-up here</a>.</p>
  </section>
  <section>
    <form class='less' method='POST'>
      <input type='submit' name='sign-out' value='Sign-out'>
    </form>
  </section>
</main>
<?php
require_once("foot.php");
?>
