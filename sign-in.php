<?php
$title = "Sign-in";
require_once("head.php");
if($signed_in) head_to("user-dashboard.php");

if(isset($_POST["sign-in"])) {
  $sign_in_email = htmlspecialchars(addslashes($_POST["sign-in-email"]));
  $sign_in_password = htmlspecialchars(addslashes($_POST["sign-in-password"]));
  $select_user_by_email = mysqli_query($connection, "SELECT * FROM users WHERE email='{$sign_in_email}'");
  if(mysqli_num_rows($select_user_by_email) == "1") {
    $fetch_user_by_email = mysqli_fetch_assoc($select_user_by_email);
    if(password_verify($sign_in_password, $fetch_user_by_email["password"])) {
      $_SESSION["signed_in"] = true;
      $_SESSION["user"] = $fetch_user_by_email;
      $my_id = $_SESSION["user"]["id"];
      mysqli_query($connection, "INSERT INTO user_sign_ins (user_id, sign_in_date, ip_address) VALUES ('{$my_id}', '{$datetime}', '{$ip_address}')");
      head_to("user-dashboard.php");
    } else $error = "Your email or passward was incorrect.";
  } else $error = "Your email or passward was incorrect.";
}
?>
<main>
  <section>
    <h1>Sign-in</h1>
    <form method='POST'>
      <div class='inline'>
        <label for='sign-in-email'>Email</label>
        <input id='sign-in-email' type='email' name='sign-in-email' placeholder='george.orson@welles.com' autocomplete='on' autofocus required>
      </div>
      <div class='inline'>
        <label for='sign-in-password'>Password</label>
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
</main>
<?php
require_once("foot.php");
?>
