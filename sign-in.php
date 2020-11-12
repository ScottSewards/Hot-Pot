<?php
$title = "Sign-in";
require_once("head.php");

if(isset($signature) && !isset($_GET["sign"])) {
  header("Location: dashboard.php");
}

if(isset($_POST["reset-password"])) {
  SendEmail(
    $email,
    "$signature, Reset Your Password",
    "<a href='sewards.me/dashboard.php?verify=true'>Click here to reset your password.</a>",
    "Password Reseter",
    "noreply@sewards.me",
    false
  );
}

if(isset($_POST["sign-in"])) {
  $emailIn = htmlspecialchars(addslashes($_POST["email-address"]));
  $passwordIn = htmlspecialchars(addslashes($_POST["password"]));
  $signatureSelect = mysqli_query($connection, "SELECT * FROM signatures WHERE email='$emailIn'");
  $signatureFetch = mysqli_fetch_array($signatureSelect);
  $passwordHash = $signatureFetch['password'];

  if(password_verify($passwordIn, $passwordHash)) {
    $_SESSION['id'] = $signatureFetch['id'];
    $_SESSION['signature'] = $signatureFetch['signature'];
    $_SESSION['email'] = $signatureFetch['email'];
    header("Location: dashboard.php");
  } else $message = "Sign-in failed. ";
}
?>
<main>
  <section>
    <h1>Signature <?php if(isset($_GET['sign'])) echo " for " . $_GET['sign'];?></h1>
    <form action='sign-in.php' method='post'>
      <fieldset>
        <legend>Sign-in</legend>
        <div class='inline'>
          <label for='sign-in-email-address'>Email*</label>
          <input id='sign-in-email-address' type='email' name='email-address' placeholder='orsonwells@hotmail.com' required>
        </div>
        <div class='inline'>
          <label for='sign-in-password'>Password*</label>
          <input id='sign-in-password' type='password' name='password' placeholder='CitizenKane1941' autocomplete='' required>
          <input type='button' value='Show' name='show-password'>
        </div>
        <div class='inline'>
          <label for='stay-signed-in'>Stay signed in?</label>
          <input id='stay-signed-in' type='checkbox' name='stay-signed-in'>
        </div>
        <input type='submit' name='sign-in' value='Sign-in'>
      </fieldset>
    </form>
  </section>
</main>
<?php
require_once("foot.php");
?>
