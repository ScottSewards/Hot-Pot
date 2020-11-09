<?php
$title = "Sign-up";
require "php/top.php";

if(isset($signature) && !isset($_GET["sign"])) header("location: dashboard.php");

if(isset($_POST["sign-up"])) {
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
    header("location: sign-in.php");
  }
}
?>
<main>
  <section>
    <h1>Signature <?php if(isset($_GET['sign'])) echo " for " . $_GET['sign'];?></h1>
    <form action='sign-up.php' method='post'>
      <fieldset>
        <legend>Sign-up</legend>
        <div class='inline'>
          <label for='sign-up-signature'>Signature*</label>
          <input id=sign-up-signature type='text' name='signature' placeholder='CharlieChaplin' required>
        </div>
        <div class='inline'>
          <label for='sign-up-email-address'>Email*</label>
          <input id=sign-up-email-address type='email' name='email-address' placeholder='charleschaplin123@outlook.co.uk' require>
        </div>
        <div class='inline'>
          <label for='sign-up-password'>Password*</label>
          <input id='sign-up-password' type='password' name='password' placeholder='TheGreatDictator1940' required>
          <input type='button' value='Show' name='show-password'>
        </div>
        <input type='submit' name='sign-up' value='Sign-up'>
      </fieldset>
    </form>
  </section>
</main>
<?php
require "php/bottom.php";
?>
