<?php
$title = "Sign-in";
require_once("head.php");

if(isset($my_id)) redirect("dashboard.php");

if(isset($_POST["reset-password"])) {
  SendEmail($email, "Reset Your Password", "<a href='sewards.me/dashboard.php?verify=true'>Click here to reset your password.</a>", "Password Reseter", "admin@hotpot.one", false);
}

if(isset($_POST["submit-sign-in"])) {
  $email = htmlspecialchars(addslashes($_POST["email"]));
  $password = htmlspecialchars(addslashes($_POST["password"]));
  $select = mysqli_query($connection, "SELECT * FROM users WHERE email='{$email}'");
  if(mysqli_num_rows($select) == "1") {
    $fetch = mysqli_fetch_array($select);
    if(password_verify($password, $fetch['password'])) {
      $_SESSION["created"] = $fetch["created"];
      $_SESSION["verified"] = $fetch["verified"];
      $_SESSION["id"] = $fetch["id"];
      $_SESSION["name"] = $fetch["name"];
      $_SESSION["email"] = $fetch["email"];
      $_SESSION["can_email"] = $fetch["can_email"];
      $_SESSION["picture"] = $fetch["picture"];
      $_SESSION["banner"] = $fetch["banner"];
      redirect("dashboard.php");
    } else echo "The email address or passward was incorrect.";
  } else echo "The email address or passward was incorrect.";
}
?>
<main>
  <section>
    <h1>Sign-in</h1>
    <form action='sign-in.php' method='post'>
      <div class='inline'>
        <label for='sign-in-email'>Email*</label>
        <input id='sign-in-email' type='email' name='email' placeholder='orson@welles.com' autocomplete='on' autofocus required/>
      </div>
      <div class='inline'>
        <label for='sign-in-password'>Password*</label>
        <input id='sign-in-password' type='password' name='password' placeholder='CitizenKane1941' autocomplete='on' required/>
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
    </form>
    <p>Don't have a signature? <a href='sign-up.php'>Sign-up here</a>.</p>
  </section>
</main>
<?php
require_once("foot.php");
?>
