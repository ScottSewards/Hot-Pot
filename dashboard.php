<?php
$title = "Dashboard";
$content = true;
require "php/top.php";

if(!isset($signature)) header("location: signature.php");

if(isset($_POST["send-verification"])) {
  /*
  send_email(
    $email,
    "$signature, Verify Your Signature",
    "<a href='sewards.me/dashboard.php?verify=true'>Click here to verify your email.</a>",
    "Email Verifier",
    "noreply@sewards.me",
    false
  );
  */
} else if(isset($_POST["change-signature"])) {
  $update = htmlspecialchars(addslashes($_POST["signature"]));
  mysqli_query($connection, "UPDATE signatures SET signature='$update' WHERE id='$id'");
  $select = mysqli_query($connection, "SELECT signature FROM signatures WHERE id='$id'");
  $fetch = mysqli_fetch_array($select);
  $_SESSION["signature"] = $fetch["signature"];
  header("location: dashboard.php");
} else if(isset($_POST["change-email"])) {
  $update = htmlspecialchars(addslashes($_POST["email"]));
  mysqli_query($connection, "UPDATE signatures SET email='$update' WHERE id='$id'");
  $select = mysqli_query($connection, "SELECT email FROM signatures WHERE id = '$id'");
  $fetch = mysqli_fetch_array($select);
  $_SESSION["email"] = $fetch["email"];
  header("location: dashboard.php");
} else if(isset($_POST["change-password"])) {
  $oldPassword = htmlspecialchars(addslashes($_POST["old-password"]));
  $newPassword = htmlspecialchars(addslashes($_POST["new-password"]));

  $select = mysqli_query($connection, "SELECT password FROM signatures WHERE id='$id'");
  $fetch = mysqli_fetch_array($select);
  $password = $fetch['password'];

  if(password_verify($oldPassword, $password)) {
    $hash = password_hash($newPassword, PASSWORD_DEFAULT);
    mysqli_query($connection, "UPDATE signatures SET password='$hash' WHERE id='$id'");
    $message = "Password changed.";
  } else $message = "Password was not changed.";
}
?>
<main>
  <section>
    <header>
      <h1>Dashboard</h1>
      <h2>Account</h2>
    </header>
    <div class='hide'>
      <form action='dashboard.php' method='post'>
        <fieldset>
          <legend>Change Signature Banner</legend>
          <div class='inline'>
            <label for='sign-banner'>Banner image*</label>
            <input id='sign-banner' type='file' name='sign-banner' accept='image/jpeg, image/png' required/>
          </div>
          <input type='submit' name='change-sign-banner' value='Upload Image'/>
        </fieldset>
      </form>
    </div>
    <div class='hide'>
      <form action='dashboard.php' method='post'>
        <fieldset>
          <legend>Change Signature Image</legend>
          <div class='inline'>
            <label for='sign-image'>Signature image*</label>
            <input id='sign-image' type='file' name='sign-image' accept='image/jpeg, image/gif, image/png' required/>
          </div>
          <input type='submit' name='change-sign-image' value='Upload Image'/>
        </fieldset>
      </form>
    </div>
    <div>
      <form action='dashboard.php' method='post'>
        <fieldset>
          <legend>Change Signature</legend>
          <div class='inline'>
            <label for='real-name'>Real Name</label>
            <input id='real-name' type='text' name='real-name' placeholder='Scott Sewards'/>
          </div>
          <div class='inline'>
            <label for='signature'>Signature*</label>
            <input id='signature' type='text' name='signature' placeholder='<?php echo $signature ?>' required/>
          </div>
          <input type='submit' name='change-signature' value='Change Signature'/>
        </fieldset>
      </form>
    </div>
    <div>
      <form action='dashboard.php' method='post'>
        <fieldset>
          <legend>Change Email</legend>
          <div class='inline'>
            <label for='email'>Email*</label>
            <input id='email' type='email' name='email' placeholder='<?php echo $email ?>' required/>
          </div>
          <input type='submit' name='change-email' value='Change Email'/>
        </fieldset>
      </form>
    </div>
    <div>
      <form action='dashboard.php' method='post'>
        <fieldset>
          <legend>Change Password</legend>
          <div class='inline'>
            <label for='old-password'>Old Password</label>
            <input id='old-password' type='password' name='old-password' placeholder='TitaniumTitanic2020' required/>
            <input type='button' value='Show' name='show-password'>
          </div>
          <div class='inline'>
            <label for='new-password'>New Password</label>
            <input id='new-password' type='password' name='new-password' placeholder='TitaniumTitanic2020' required/>
            <input type='button' value='Show' name='show-password'>
          </div>
          <input type='submit' name='change-password' value='Change Password'/>
        </fieldset>
      </form>
    </div>
  </section>
</main>
<?php
require "php/bottom.php";
?>
