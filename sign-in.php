<?php
$title = "Sign-in";
require_once("head.php");

if(isset($my_id)) redirect("dashboard.php");

if(isset($_POST["reset-password"])) {
  SendEmail(
    $email,
    "{$my_sign}, Reset Your Password",
    "<a href='sewards.me/dashboard.php?verify=true'>Click here to reset your password.</a>",
    "Password Reseter",
    "noreply@sewards.me",
    false
  );
}

if(isset($_POST["submit-sign-in"])) {
  $email = htmlspecialchars(addslashes($_POST["email-address"]));
  $password = htmlspecialchars(addslashes($_POST["password"]));
  $select = mysqli_query($connection, "SELECT * FROM signatures WHERE email='{$email}'");
  $fetch = mysqli_fetch_array($select);
  if(password_verify($password, $fetch['password'])) {
    $_SESSION['id'] = $fetch['id'];
    $_SESSION['signature'] = $fetch['signature'];
    $_SESSION['email'] = $fetch['email'];
    redirect("dashboard.php");
  } else echo "The email address or passward was incorrect.";
}
?>
<main>
  <section>
    <h1>Sign-in</h1>
    <form action='sign-in.php' method='post'>
      <fieldset>
        <legend>Sign-in</legend>
        <div class='inline'>
          <label for='sign-in-email-address'>Email*</label>
          <input id='sign-in-email-address' type='email' name='email-address' placeholder='orson@welles.com' required/>
        </div>
        <div class='inline'>
          <label for='sign-in-password'>Password*</label>
          <input id='sign-in-password' type='password' name='password' placeholder='CitizenKane1941' autocomplete='' required/>
          <input type='button' value='Show' name='show-password'/>
        </div>
        <div class='inline'>
          <label for='stay-signed-in'>Stay signed in?</label>
          <input id='stay-signed-in' type='checkbox' name='stay-signed-in' disabled/>
        </div>
        <div class='inline'>
          <input id='submit-sign-in' type='submit' name='submit-sign-in' value='Sign-in'/>
          <input id='request-reset-password' type='button' value='Reset Password' disabled/>
        </div>
      </fieldset>
    </form>
    <p>Don't have a signature? <a href='sign-up.php'>Sign-up here</a>.</p>
  </section>
</main>
<?php
require_once("foot.php");
?>
