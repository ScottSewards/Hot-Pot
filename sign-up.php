<?php
$title = "Sign-up";
require_once("head.php");
if($signed_in) head_to("user-dashboard.php");

if(isset($_POST["sign-up"])) {
  $sign_up_name = htmlspecialchars(addslashes($_POST['name']));
  $sign_up_email = htmlspecialchars(addslashes($_POST['email']));
  $sign_up_password = htmlspecialchars(addslashes($_POST['password']));
  $select_name = mysqli_query($connection, "SELECT name FROM users WHERE name='{$sign_up_name}'");
  $select_email = mysqli_query($connection, "SELECT email FROM users WHERE email='{$sign_up_email}'");
  if(mysqli_num_rows($select_name) == "1") $error = "You cannot use the username {$sign_up_name}.";
  else if(mysqli_num_rows($select_email) == "1") $error = "You cannot use the email {$sign_up_email}.";
  else {
    $password_hash = password_hash($sign_up_password, PASSWORD_DEFAULT);
    $verify_token = rand(0, 999999);
    mysqli_query($connection, "INSERT INTO users (name, email, verify_token, password) VALUES ('{$sign_up_name}', '{$sign_up_email}', '{$verify_token}', '{$password_hash}')");
    $select_user_to_sign_in = mysqli_query($connection, "SELECT * FROM users WHERE email='{$sign_up_email}'");
    $fetch_user_to_sign_in = mysqli_fetch_assoc($select_user_to_sign_in);
    $_SESSION["signed_in"] = true;
    $_SESSION["user"] = $fetch_user_to_sign_in;
    $my_id = $_SESSION["user"]["id"];
    mysqli_query($connection, "INSERT INTO user_sign_ups (user_id, sign_up_date, ip_address) VALUES ('{$my_id}', '{$datetime}', '{$ip_address}')");
    mysqli_query($connection, "INSERT INTO user_sign_ins (user_id, sign_in_date, ip_address) VALUES ('{$my_id}', '{$datetime}', '{$ip_address}')");
    head_to("user-dashboard.php");
  }
}
?>
<main>
  <section>
    <h1>Sign-up</h1>
    <form method='POST' autocomplete='off'>
      <div class='inline'>
        <label for='sign-up-name'>Username</label>
        <input id=sign-up-name type='text' pattern='[a-z\A-Z\0-9]{5}' name='name' placeholder='CharlieChaplin' <?php if(isset($sign_up_name)) echo "value='{$sign_up_name}'"; ?> autocomplete='off' autofocus required>
      </div>
      <div class='inline'>
        <label for='sign-up-email'>Email</label>
        <input id=sign-up-email type='email' name='email' placeholder='charles@chaplin.co.uk' <?php if(isset($sign_up_email)) echo "value='{$sign_up_email}'"; ?> required>
      </div>
      <div class='inline'>
        <label for='sign-up-password'>Password</label>
        <input id='sign-up-password' type='password' name='password' placeholder='CityLights1931' <?php if(isset($sign_up_password)) echo "value='{$sign_up_password}'"; ?> autocomplete='new-password' required>
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
