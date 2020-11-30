<?php
if(isset($my_id)) direct_to("user-dashboard.php");

$title = "Sign-up";
require_once("head.php");

if(isset($_POST["sign-up"])) {
  $created = date("Y-m-d G:i:s");
  $name = htmlspecialchars(addslashes($_POST['name']));
  $email = htmlspecialchars(addslashes($_POST['email']));
  $password = htmlspecialchars(addslashes($_POST['password']));
  $select_name = mysqli_query($connection, "SELECT id FROM users WHERE name='{$name}'");
  $select_email = mysqli_query($connection, "SELECT id FROM signatures WHERE email='{$email}'");
  if(mysqli_num_rows($select_name) == "1") $error = "You cannot use the username {$name}.";
  else if(mysqli_num_rows($select_email) == "1") $error = "You cannot use the email {$email}.";
  else {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($connection, "INSERT INTO users (created, name, email, password) VALUES ('{$created}', '{$name}', '{$email}', '{$password_hash}')");
    $select_user = mysqli_query($connection, "SELECT * FROM users WHERE name='{$name}'");
    $fetch_user = mysqli_fetch_assoc($select_user);
    sign_in($fetch_user);
  }
}
?>
<main>
  <section>
    <h1>Sign-up</h1>
    <form method='POST' autocomplete='off'>
      <div class='inline'>
        <label for='sign-up-name'>Username*</label>
        <input id=sign-up-name type='text' pattern='[a-z\A-Z\0-9]{5}' name='name' placeholder='CharlieChaplin' <?php if(isset($name)) echo "value='{$name}'"; ?> autocomplete='off' autofocus required>
      </div>
      <div class='inline'>
        <label for='sign-up-email'>Email*</label>
        <input id=sign-up-email type='email' name='email' placeholder='charles@chaplin.co.uk' <?php if(isset($email)) echo "value='{$email}'"; ?> required>
      </div>
      <div class='inline'>
        <label for='sign-up-password'>Password*</label>
        <input id='sign-up-password' type='password' name='password' placeholder='CityLights1931' <?php if(isset($password)) echo "value='{$password}'"; ?> autocomplete='new-password' required>
        <input type='button' value='Show' name='show-password'>
      </div>
      <div class='inline'>
        <input id='sign-up' type='submit' name='sign-up' value='Sign-up'>
        <?php if(isset($error)) echo "<output name='sign-up-output'>{$error}</output>"?>
      </div>
    </form>
    <p>If you already have an account, you can <a href='sign-in.php'>sign-in here</a>.</p>
  </section>
</main>
<?php
require_once("foot.php");
?>
