<?php
$title = "Signature";
require "php/top.php";

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
} if(isset($_POST["sign-in"])) {
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
} else if (isset($_POST["sign-up"])) {
  $signatureUp = htmlspecialchars(addslashes($_POST['signature']));
  $emailUp = htmlspecialchars(addslashes($_POST['email-address']));
  $passwordUp = htmlspecialchars(addslashes($_POST['password']));
  $emailSelect = mysqli_query($connection, "SELECT id FROM signatures WHERE email='$emailUp'");
  $emailRows = mysqli_num_rows($emailSelect);

  if($emailRows == "1") $message = "Email in use.";
  else {
    $passwordHash = password_hash($passwordUp, PASSWORD_DEFAULT);
    $signatureInsert = mysqli_query($connection, "INSERT INTO signatures (signature, email, password) VALUES ('$signatureUp', '$emailUp', '$passwordHash')");
    $signatureSelect = mysqli_query($connection, "SELECT * FROM signatures WHERE email='$emailUp' AND password='$passwordHash'");
    $message = "Sign-up succeeded.";
  }
} else if(isset($_GET["sign-out"])) {
  session_destroy();
  $message = "Sign-out succeeded.";
}
?>
<main>
  <section>
    <header>
      <h1>Signature <?php if(isset($_GET['sign'])) echo " for " . $_GET['sign'];?></h1>
    <?php
    if(isset($_GET['sign'])) {
      echo "
      </header>
      <p>This webpage does not render Signatures yet.</p>";
    } else {
      echo "
        <h2>Sign-in</h2>
      </header>
      <form action='signature.php' method='post'>
        <fieldset>
          <div>
            <label for='sign-in-email-address'>Email*</label>
            <input id='sign-in-email-address' type='email' name='email-address' placeholder='orsonwells@hotmail.com' required>
          </div>
          <div>
            <label for='sign-in-password'>Password*</label>
            <input id='sign-in-password' type='password' name='password' placeholder='CitizenKane1941' autocomplete='' required>
            <input type='button' value='Show' name='show-password'>
          </div>
          <div>
            <label for='stay-signed-in'>Stay Signed In?</label>
            <input id='stay-signed-in' class='yes-no' type='checkbox' name='stay-signed-in'>
          </div>
          <input type='submit' name='sign-in' value='Sign-in'>
        </fieldset>
      </form>
    </section>
    <section>
      <h2>Sign-up</h2>
      <form action='signature.php' method='post'>
        <fieldset>
          <div>
            <label for='sign-up-signature'>Signature*</label>
            <input id=sign-up-signature type='text' name='signature' placeholder='CharlieChaplin' required>
          </div>
          <div>
            <label for='sign-up-email-address'>Email*</label>
            <input id=sign-up-email-address type='email' name='email-address' placeholder='charleschaplin123@outlook.co.uk' require>
          </div>
          <div>
            <label for='sign-up-password'>Password*</label>
            <input id='sign-up-password' type='password' name='password' placeholder='TheGreatDictator1940' required>
            <input type='button' value='Show' name='show-password'>
          </div>
          <input type='submit' name='sign-up' value='Sign-up'>
        </fieldset>
      </form>
    </section>";
  }
  ?>
</main>
<?php
require "php/bottom.php";
?>
