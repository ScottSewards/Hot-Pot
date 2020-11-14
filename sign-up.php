<?php
$title = "Sign-up";
require_once("head.php");

if(isset($my_id)) redirect("dashboard.php");

if(isset($_POST["sign-up"])) {
  $sign = htmlspecialchars(addslashes($_POST['signature']));
  $email = htmlspecialchars(addslashes($_POST['email-address']));
  $password = htmlspecialchars(addslashes($_POST['password']));
  $select_signature = mysqli_query($connection, "SELECT id FROM signatures WHERE signature='{$sign}'");
  $select_email = mysqli_query($connection, "SELECT id FROM signatures WHERE email='{$email}'");

  if(mysqli_num_rows($select_signature) == "1") echo "You cannot use this signature.";
  else if(mysqli_num_rows($select_email) == "1") echo "You cannot use this email address.";
  else {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($connection, "INSERT INTO signatures (signature, email, password) VALUES ('{$sign}', '{$email}', '{$password_hash}')");
    $select = mysqli_query($connection, "SELECT * FROM signatures WHERE email='{$email}'");
    $fetch = mysqli_fetch_array($select);
    $_SESSION['id'] = $fetch['id'];
    $_SESSION['signature'] = $fetch['signature'];
    $_SESSION['email'] = $fetch['email'];
    redirect("dashboard.php");
  }
}
?>
<main>
  <section>
    <h1>Sign-up</h1>
    <form action='sign-up.php' method='post'>
      <fieldset>
        <legend>Sign-up</legend>
        <div class='inline'>
          <label for='sign-up-signature'>Signature*</label>
          <input id=sign-up-signature type='text' name='signature' placeholder='CharlieChaplin' required/>
        </div>
        <div class='inline'>
          <label for='sign-up-email-address'>Email*</label>
          <input id=sign-up-email-address type='email' name='email-address' placeholder='charles@chaplin.co.uk' require/>
        </div>
        <div class='inline'>
          <label for='sign-up-password'>Password*</label>
          <input id='sign-up-password' type='password' name='password' placeholder='CityLights1931' required/>
          <input type='button' value='Show' name='show-password'/>
        </div>
        <input type='submit' name='sign-up' value='Sign-up'/>
      </fieldset>
    </form>
  </section>
</main>
<?php
require_once("foot.php");
?>
